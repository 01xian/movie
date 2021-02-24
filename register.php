<?php
include_once("header.php");
include_once("includeFiles.php");
?>
<script type="text/javascript">
    $(document).ready(function() {
        
        checkUserEmail(emNormalStyle, emWrongStyle, $("#email"), $("#emailNotice"), $('#submit'));
        registerSubmit($("#submit"), $("#password"), $("#password1"), $("#email"), $("#name") );
    });  
</script>
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
<?php include("footer.php");?>