<?php
include("pub.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="js/jquery.js"></script>

    <title>movie</title>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function() {
        $("#email").keyup(function(){
            $.ajax({
                type: "POST",
                url: "ajax/check_user.php",
                data:{
                    'email' : $(this).val()
                },
                datatype:'json',
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response.result);

                    if ($("#email").val() != '') {

                        if (response.result == false) {

                            $("#email").addClass("border-danger");
                            $("#emailNotice").html(response.reason);
                            $('#submit').addClass('disabled');

                        } else {

                            $("#email").removeClass("border-danger");
                            $("#emailNotice").html('');
                            $('#submit').removeClass('disabled');
                        }
                    } else {
                        $("#email").removeClass("border-danger");
                        $("#emailNotice").html('');
                        $('#submit').removeClass('disabled');

                    }
                },
                error: function (thrownError) {
                console.log(thrownError);
                }

            });
        });

        $("#submit").click(function(){
            if ($("#password").val() != "" && $("#password1").val() != "" && $("#email").val() != ""  && $("#name").val() != "") {

                if ($("#password").val() != $("#password1").val()) {
                    alert('兩次密碼不一樣！')
                
                } else {
                    $.ajax({
                        type: "POST",
                        url: "ajax/add_user.php",
                        data:{
                            'email' : $("#email").val(),
                            'name' : $("#name").val(),
                            'pw' : $("#password").val()
                        },
                        datatype:'json',
                        success: function (response) {
                            var response = JSON.parse(response);
                            if (response.result) {

                                $(location).attr('href', 'movie.php');

                            } else {
                                alert(response.msg);
                            }
                        },
                        error: function (thrownError) {
                        console.log(thrownError);
                        }
                    });
                }

            } else {
                alert('資料不齊全哦！');
            }
        });

    });  
</script>
<?php include("nav.php")?>
<div class="registerContainer mt-5 pt-3">
    <div class="card border-success  m-auto " style="max-width: 18rem;">
    <div class="card-body text-success">
    <h5 class="card-title">註冊</h5>
    <p class="card-text">
    <form >
    <div class="mb-3">
        <label for="name" class="form-label">暱稱</label>
        <input type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label">Email</label>
        <span class="text-danger" id="emailNotice"></span>
        <input type="email" class="form-control" id="email">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label">密碼</label>
        <input type="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
        <label for="Password1" class="form-label">確認密碼</label>
        <span class="text-danger" id="confirmPw"></span>
        <input type="password" class="form-control" id="password1">
    </div>
    <div class=" btn btn-outline-success" id="submit">送出</div>
    </form>
    </p>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 
    
    
</body>
</html>