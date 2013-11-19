<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Form\UserType;
use Acme\DemoBundle\Form\SurveyType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
Use Acme\DemoBundle\Entity\User;
Use Acme\DemoBundle\Entity\Survey;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     */
    public function indexAction()
    {
        $userLink = $this->generateUrl("_demo_flush_user_form");
        $userForm = $this->get('form.factory')->create(new UserType(), null, array('link' => $userLink));

        $surveyLink = $this->generateUrl("_demo_flush_survey_form");
        $randomGifLink = $this->generateUrl("_demo_get_random_gif");
        $surveyForm = $this->get('form.factory')->create(new SurveyType(), null, array('link' => $surveyLink));

        return $this->render('AcmeDemoBundle:Demo:index.html.twig', array(
                'userForm' => $userForm->createView(),
                'surveyForm' => $surveyForm->createView(),
                'randomGif' => $randomGifLink,
        ));
    }

    /**
     * @Route("/flush_user_form", name="_demo_flush_user_form")
     */
    public function flushUserFormAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(new UserType(), $user);
        $form->bind($request);

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');

        if ($form->isValid()) {

            $em->persist($user);
            $em->flush();
            $response->setData(array(
                'result' => true,
                'user_id' => $user->getId(),
                // что бы не подменяли user_id, простая проверка, можно влепить что-то умное
                'user_hash' => md5(md5($user->getId())),
            ));
        } else {
            $response->setData(array(
                'result' => false
            ));
        }

        return $response;
    }

    /**
     * @Route("/flush_survey_form", name="_demo_flush_survey_form")
     */
    public function flushSurveyFormAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $survey = new Survey();
        $form = $this->createForm(new SurveyType(), $survey);
        $form->bind($request);

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');

        if ($_COOKIE["user_hash"] == md5(md5($_COOKIE["user_id"]))) {
            $userId = (int)$_COOKIE["user_id"];
            $user = $em->getRepository('AcmeDemoBundle:User')->find($userId);
            $survey->setUser($user);

            if ($form->isValid()) {
                $em->persist($survey);
                $em->flush();
                $response->setData(array(
                    'result' => true,
                ));
            } else {
                $response->setData(array(
                    'result' => false
                ));
            }

        }
        return $response;
    }

    /**
     * @Route("/get_random_gif", name="_demo_get_random_gif")
     */
    public function getRandomGifAction()
    {
        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');

        $html = file_get_contents('http://www.gifbin.com/random');
        preg_match_all('/<img.*id="gif" >?/', $html, $matches);
        $randomGifUrl = $matches[0][0];

        $response->setData(array(
            'gif' => $randomGifUrl
        ));

        return $response;
    }
}
