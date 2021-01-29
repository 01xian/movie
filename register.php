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
    <script src="js/common.js"></script>
    <script src="js/jquery.js"></script>

    <title>movie</title>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function() {
        
        checkUserEmail(emNormalStyle, emWrongStyle, $("#email"), $("#emailNotice"), $('#submit'));
        registerSubmit($("#submit"), $("#password"), $("#password1"), $("#email"), $("#name") );
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