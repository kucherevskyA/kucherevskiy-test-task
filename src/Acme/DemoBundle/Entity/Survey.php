<?
namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\DemoBundle\Entity\User
 *
 * @ORM\Table(name="survey")
 * @ORM\Entity
 */
class Survey
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $superHero;


    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $movieStar;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $iceCream;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $worldEndTime;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $winner;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToOne(targetEntity="User", inversedBy="survey")
     */
    protected $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set superHero
     *
     * @param string $superHero
     *
     * @return Survey
     */
    public function setSuperHero($superHero)
    {
        $this->superHero = $superHero;

        return $this;
    }

    /**
     * Get superHero
     *
     * @return string 
     */
    public function getSuperHero()
    {
        return $this->superHero;
    }

    /**
     * Set movieStar
     *
     * @param string $movieStar
     *
     * @return Survey
     */
    public function setMovieStar($movieStar)
    {
        $this->movieStar = $movieStar;

        return $this;
    }

    /**
     * Get movieStar
     *
     * @return string 
     */
    public function getMovieStar()
    {
        return $this->movieStar;
    }

    /**
     * Set iceCream
     *
     * @param string $iceCream
     *
     * @return Survey
     */
    public function setIceCream($iceCream)
    {
        $this->iceCream = $iceCream;

        return $this;
    }

    /**
     * Get iceCream
     *
     * @return string 
     */
    public function getIceCream()
    {
        return $this->iceCream;
    }

    /**
     * Set worldEndTime
     *
     * @param string $worldEndTime
     *
     * @return Survey
     */
    public function setWorldEndTime($worldEndTime)
    {
        $this->worldEndTime = $worldEndTime;

        return $this;
    }

    /**
     * Get worldEndTime
     *
     * @return string 
     */
    public function getWorldEndTime()
    {
        return $this->worldEndTime;
    }

    /**
     * Set winner
     *
     * @param string $winner
     *
     * @return Survey
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return string 
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Survey
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
