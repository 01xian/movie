<?php
include("header.php");
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#submit").click(function(){  
            loginSubmit($("#submit"), $('#email').val(), $('#password').val());
        });
    });  
</script>
<div class="registerContainer mt-5 pt-5">
    <div class="card border-success  m-auto " style="max-width: 18rem;">
    <div class="card-body text-success">
    <h5 class="card-title">登入</h5>
    <p class="card-text">
    <form >

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
        <span>還沒有帳號嗎？點我<a href="register.php">註冊</a></span>
    </div>

    <div class=" btn btn-outline-success" id="submit">送出</div>
    </form>
    </p>
    </div>
    </div>
</div>
<?php include("footer.php");?>