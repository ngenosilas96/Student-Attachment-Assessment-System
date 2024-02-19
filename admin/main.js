$(window).ready(function(){
    //tooggling employees link
    $('#dropdown').on('click', function(){
        if($('#dropdown-links').height() == '0'){
            $('#dropdown-links').css('height', '240px');
        }
        else{
            $('#dropdown-links').css('height', '0');
        }
    })

    //showing the page I'm in
    $("#pages a[href]").each(function () {
        if (this.href == window.location.href) {
            if($(this).parent('#dropdown-links').length  == 1){
                $('#dropdown-links').css('height', '240px');
                $(this).css('background', '#fff').css('color', '#000').css('padding-left', '15px');
            }
            else{
                $(this).css('background', '#fff').css('color', '#000').css('padding-left', '15px');
            }
        }
    })


    //toggling navigation bar for mobiles screens
    $('#title .fa-bars').on('click', function(){
        $('.sidebar').toggleClass('toggleclass');
    })

    //Clickacble dashboard boxes
    //total employees
    $('#total-employees').on('click', function(){
        window.location.assign('all-employees.php');
    })
    //total employees
    $('#employees-today').on('click', function(){
        window.location.assign('present.php');
    })
    //total employees
    $('#total-branches').on('click', function(){
        window.location.assign('branches.php');
    })


    //showing new notification
    $('#messages-not').on('click', function () {
        $('#messages-not2').toggle();
    })
    $('#notification').on('click', function () {
        $('#messages').toggle();
    })
    setInterval(function () {
        if ($('#messages:has(a)').length > 0) {
            $('#notification').addClass('notification_active');
        }
    }, 5000);

    //showing new messages
    setInterval(function () {
        if ($('#messages-not2:has(a)').length > 0) {
            $('#messages-not span').show();
        }
    }, 5000);
})