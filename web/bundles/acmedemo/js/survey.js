$(function () {
    $("#survey-save-button").on("click", function () {
        if ($.cookie("form_type") == "survey") {
            // easy_hack, стоило бы добавить проверку на серваке
            if (!$("#survey_iceCream").val() || !$("#survey_superHero").val() || !$("#survey_movieStar").val() || !$("#survey_worldEndTime").val() || !$("#survey_winner").val()) {
                // можно было запилить что-то вроде i18n или Flash-Messages
                alert('fill all inputs');
                return false;
            }
            $.ajax($("form[name='survey']").prop("action"), {
                method: "POST",
                dataType: "json",
                data: $("form[name='survey']").serialize(),
                success: function (data) {
                    if (data.result == true) {
                        $.removeCookie("user_id");
                        $.removeCookie("user_hash");
                        $.removeCookie("form_type");

                        // easy_hack, можно убрать disabled
                        $("#survey-save-button").prop("disabled", true);
                        $("form[name='survey']").hide();
                        $("#finish").show();

                        $.cookie("stop_timer", 1);
                        console.log(data.result)
                    } else {
                        alert('there are some problems, try later');
                    }
                },
                error: function () {
                    alert('fail')
                }
            });
        }
    });
})