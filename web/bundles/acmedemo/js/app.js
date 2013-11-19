// Тестовое задание
//
// Антон Кучеревский
//
// главный js файл
//
// (!) коммент easy_hack означает, что в этом месте можно легко обойти систему.

$(function() {
    $( "#user_birthday" ).datepicker();
    $( "#survey_worldEndTime" ).datepicker();
});

$(function () {

    $("#finish").hide();

    $.ajax($("input[name='random-gif']").val()),{
        method: "GET",
        dataType: "json",
        success: function (data) {
            $("#rand-gif").html(data.gif)
        },
        error: function(data){
            $("#rand-gif").html(data.gif)
        }
    }

    if ($.cookie("form_type") != "user" && $.cookie("form_type") != "survey") {
        $.cookie('form_type', 'user', 1);
    }

    if ($.cookie('form_type') == 'user') {
        $("form[name='survey']").hide();
    } else {
        $("form[name='user']").hide();
    }
    var leftTime = 0;
    var timerTime = 360000;

    var refreshId = setInterval(function () {
        var date = new Date();
        var now = date.getTime();
        if ($.cookie("user_visit_timestamp") > 0) {
            //todo
        } else {
            $.cookie('user_visit_timestamp', now);
        }
        // easy_hack - подменять куки еще не разучились
        // на серваке есть детская проверка
        // возможно есть смысл привязывать куки и сессии одновременно
        leftTime = (timerTime - (now - $.cookie("user_visit_timestamp"))) / 1000;
        if (leftTime < timerTime / 1000 && leftTime > 0) {
            $("#time").text(leftTime.toFixed(1));
        } else {
            $("#time").text("0.0");
        }
        if (leftTime < 0) {
            clearInterval(refreshId);
            alert('your time is gone!')
            $.removeCookie('user_visit_timestamp');
            // easy_hack изменять html тоже умеют многие
            $("#user-save-button").prop("disabled", true);
            $("#survey-save-button").prop("disabled", true);
        }
        if ($.cookie('stop_timer') == 1){
            clearInterval(refreshId);
            $.removeCookie('stop_timer');
            $.removeCookie('user_visit_timestamp');
        }
    }, 100);
})
