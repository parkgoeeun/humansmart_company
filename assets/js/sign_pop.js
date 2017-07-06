/*************************************
 * Open the Sign Layout
 *************************************/
function layer_open() {

    // var temp = $('#layer2');
    var bg = $('#layer2').prev().hasClass('bg');

    if (bg) {
        $('.layer').fadeIn();
    } else {
        $('#layer2').fadeIn();
    }

    if ($('#layer2').outerHeight() < $(document).height()) {
        $('#layer2').css('margin-top', '-' + $('#layer2').outerHeight() / 2 + 'px');
    } else {
        $('#layer2').css('top', '0px');
    }

    if (true) {
        $('#layer2').css('margin-left', '-' + $('#layer2').outerWidth() / 2 + 'px');
    }

    $('#layer2').find('a.cbtn').click(function(e) {

        if (bg) {
            $('.layer').fadeOut();
        } else {
            $('#layer2').fadeOut();
        }

        e.preventDefault();

    });

    $('.layer .bg').click(function(e) {

        $('.layer').fadeOut();
        e.preventDefault();

    });

}
/************************************/

function CheckFormlogin(Join) {

    var check_id = $('.id').val();
    var check_pw = $('.pw').val();

    if ((check_id == "") || (check_pw == "")) {
        alert('아이디 또는 패스워드를 입력 부탁드립니다!');
        return false;
    }

}

function LoginChk() {

    layer_open('layer2');

    return false;

}
/************************************/

function sign_request(url) {
    var xhr = new XMLHttpRequest();
    xhr.open('get', url);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                $("#chatLog").html(xhr.responseText);
            }
        }
    }

    xhr.send(null)
}
