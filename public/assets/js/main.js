$(function () {
    $('#btn_submit').click(function () {
        $('#btn_submit').attr("disabled", "disabled");
        $('#btn_submit').text('生成中');
        $.post("/api/create?c=0", { target: $('#input_url').val() },
            function (data, textStatus, jqXHR) {
                if (!data.ok) {
                    $('#btn_submit').removeAttr("disabled");
                    $('#btn_submit').text('生成短链接');
                    alert(data.msg);
                } else {
                    $('#btn_div').html('<div class="alert alert-success" style="width:90%;" role="alert">'+
                    '<h4 class="alert-heading">生成成功</h4>' +
                    '<p class="m-t-8">你的短链接是: <code>' + data.data + '</code></p>' +
                    '</div>'
                    );
                }
            },
            "json"
        );
    });
});
