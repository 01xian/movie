function getMoreInfo(callback, query, i, appendClass) 
{
    $.ajax({
        type: "GET",
        url: "ajax/getMoreInfo.php?query="+query+"&page="+i,
        dataType: "json",
        success: function (response) {
            console.log(response);
            callback(response, appendClass);
        },
        error: function (thrownError) {
        console.log(thrownError);
        }
    });

}

function handleData(data, appendClass) 
{
    if (data.result == true) {
        appendClass.append(data.datas);
    } else {
        alert(data.msg);
    }
}

function checkUserEmail (normalCallback, noticeCallback, emailId, emailNotice, btn ) 
{
    $("#email").keyup(function(){
        $.ajax({
            type: "POST",
            url: "ajax/checkUser.php",
            data:{
                'email' : emailId.val()
            },
            datatype:'json',
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response.result);
    
                if (emailId.val() != '') {
    
                    if (response.result == false) {
                        noticeCallback (emailId, emailNotice, btn, response);
    
                    } else {
                        normalCallback (emailId, emailNotice, btn);                   
                    }
                } else {
                    normalCallback (emailId, emailNotice, btn); 
                }
            },
            error: function (thrownError) {
            console.log(thrownError);
            }
        });
    });
}

function emNormalStyle (emailId, emailNotice, btn) 
{
    emailId.removeClass("border-danger");
    emailNotice.html('');
    btn.removeClass('disabled');
}

function emWrongStyle (emailId, emailNotice, btn, response) 
{
    emailId.addClass("border-danger");
    emailNotice.html(response.reason);
    btn.addClass('disabled');
}

function registerSubmit(submit, password, password1, email, name) 
{
    $(submit).click(function(){
        if (password.val() != "" && password1.val() != "" && email.val() != ""  && name.val() != "") {

            if (password.val() != password1.val()) {
                alert('兩次密碼不一樣！')
            
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/addUser.php",
                    data:{
                        'email' : email.val(),
                        'name' : name.val(),
                        'pw' : password.val()
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
}

function loginSubmit(submit, email, password) 
{
    if (email != '' && password != '') {
        $.ajax({
            type:"POST",
            dataType: "json",
            url:"ajax/login.php",
            data:{
                'em' :email,
                'pw' :password
            },
            success: function(response){
                console.log(response);
                if (response.result) {
                    $(location).attr('href', 'index.php');
                } else {
                    alert(response.msg);
                }
            },
            error: function(thrownError){
                console.log(thrownError);
            }
        });
    } else {
        alert ('請填寫email和密碼！');
    }
}

function reviewBtn(review, memberId, name, tmdbId)
{
    if(review.val() != '') {
        $.ajax({
            type: "POST",
            url: "ajax/addReview.php",
            data:{
                'member_id' : memberId.val(),
                'name' : name.val(),
                'review' : review.val(),
                'tmdb_id' : tmdbId.val()
            },
            datatype: 'json',
            success:function(response){
                var response = JSON.parse(response);
                alert(response.msg);
                location.reload();
                if (response.result) {
                    review.val('');
                }
            },
            error:function(thrownError){
                console.log(thrownError);
            }
        });
    } else {
        alert('請填影評');
    }
}

function addFavorite(tmdbId, posterPath, overview, title)
{
    $.ajax({
        type:"POST",
        url:"ajax/addFavorite.php",
        data:{
            'tmdb_id':tmdbId.val(),
            'poster_path':posterPath.val(),
            'overview':overview.text(),
            'title': title.text()
        },
        success:function(response){
            console.log(response);
            if (response) {
                alert(response);
                location.reload();
            }
        },
        error:function(thrownError){
            console.log(thrownError);
        }
    });
}

function revomeFavorite(tmdbId)
{
    $.ajax({
        type:"POST",
        url:"ajax/removeFavorite.php",
        data:{
            'tmdb_id':tmdbId.val(),
        },
        success:function(response){
            console.log(response);
            if (response) {
                alert(response);
                location.reload();
            }
        },
        error:function(thrownError){
            console.log(thrownError);
        }
    });
}