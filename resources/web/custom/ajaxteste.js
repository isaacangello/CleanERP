


$("#btn_sigin_id").click(function (e) {
    e.preventDefault();
    var form = $("#sign_in");
    //console.log(form)
    var form_data = form.serialize();
    //var url = "http://localhost:8000/get_ajax_login/";
    console.log(form_data)
    $.ajax({
        url: url,
        type:'POST',
        data: form_data,
        dataType: 'JSON',
        success: function (data, textStatus, jqXHR) {
            if(data["status"] == "success"){
                $('.result').text(' ')
                $('.result').prepend('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">\n' +
                    '                    <div class="info-box-4 hover-expand-effect">\n' +
                    '                        <div class="icon">\n' +
                    '                            <i class="material-icons col-light-green">select_check_box</i>\n' +
                    '                        </div>\n' +
                    '                        <div class="content">\n' +
                '                            <div class="text">'+data["message"]+'</div>\n' +
                    '                            <div class="number">OK.</div>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n');
                //$('#sign_in')[0].reset();

            }else if(data['status'] == "error"){
                $('.result').text(' ')
                $('.result').prepend('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">\n' +
                    '                    <div class="info-box-4 hover-expand-effect">\n' +
                    '                        <div class="icon">\n' +
                    '                            <i class="material-icons col-light-green">disabled_by_default</i>\n' +
                    '                        </div>\n' +
                    '                        <div class="content">\n' +
                '                            <div class="text">'+data["message"]+'</div>\n' +
                    '                            <div class="number">ERROR.</div>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n');
                $('#sign_in')[0].reset();

            }
            setTimeout(function () {
                $("#result").hide()
                if (data['redirect'] != ''){
                    //window.location.href = data['redirect'];
                }
            },3000);

        }
    })

})


