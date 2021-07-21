$('.btn-login').click(function (e){

    e.preventDefault();

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();
     $.ajax({
        url: 'scripts/auth.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success (data){
            if(data.auth === true){
                document.location.href = 'home.php';
            }else{
                $('.error').text(data.error).show(300);
            }

        }
    });

});


$('.btn-reg').click(function (e){

    e.preventDefault();

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val(),
        confirm_password = $('input[name="confirm_password"]').val(),
        email = $('input[name="email"]').val(),
        $username = $('input[name="username"]').val();

    $.ajax({
        url: 'scripts/reg.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
            confirm_password: confirm_password,
            email: email,
            username: $username
        },
        success (data){
            if(data.reg === true){
                document.location.href = 'home.php';
            }else{
                $('.error').text(data.error).show(300);
            }

        }
    });

});