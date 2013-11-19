$(function () {
    $("#user-save-button").on("click", function () {
        if ($.cookie("form_type") == "user") {
            // easy_hack, стоило бы добавить проверку на серваке
            if (!$("#user_firstName").val() || !$("#user_secondName").val() || !$("#user_email").val()) {
                //можно было запилить что-то вроде i18n или Flash-Messages
                alert('fill all inputs');
                return false;
            }
            $.ajax($("form[name='user']").prop("action"), {
                method: "POST",
                dataType: "json",
                data: $("form[name='user']").serialize(),
                success: function (data) {
                    if (data.result == true) {
                        $.cookie("user_id", data.user_id);
                        $.cookie("user_hash", data.user_hash);
                        $.cookie("form_type", "survey");

                        $("form[name='user']").hide();
                        $("form[name='survey']").show();
                        // easy_hack, можно убрать disabled
                        $("#user-save-button").prop("disabled", true);
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