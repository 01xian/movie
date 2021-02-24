function getMoreInfo(callback, query, i, appendClass) 
{
    $.ajax({
        type: "GET",
        url: "ajax/getMoreInfo.php?query="+query+"&page="+i,
        dataType: "json",
        success: function (response) {
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
    if (review.val() != '') {
        $.ajax({
            type: "POST",
            url: "ajax/addReview.php",
            data:{
                'member_id' : memberId.val(),
                'name' : name.val(),
                'review' : review.val(),
                'tmdb_id' : tmdbId
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
            'tmdb_id':tmdbId,
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
            'tmdb_id':tmdbId,
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

function showFavoriteMovie()
{
    $.ajax({
        url:"ajax/favorite.php",
        success:function(response){
            $("#favouriteMovie").html(response);
        }
    });
}

function checkQuery(query)
{
    if(query) {
        $("#banner").removeClass("index mt-5 m-auto");
        $("#banner").addClass("banner");
    }
}

function searchResult(valueToSearch)
{
    if (valueToSearch) {
        $.ajax({
            type:"POST",
            url:"ajax/search.php",
            data:{
                'valueToSearch':valueToSearch
            },
            success:function(response){
                $(".searchResult").html(response);

            }
        });
    }
  
}
function checkwriter(id)
{
    $.ajax({
        type:"POST",
        data:{
            'id':id
        },
        url:"ajax/checkWriter.php",
        datatype:"json",
        success:function(response){
            response = JSON.parse(response);
            console.log(response['member_id']);
            $(".writer").html(response['writer']);
            $("#name").val( response['name']);
            $("#member_id").val(response['member_id']);


        },
        error:function(error){
            console.log(error);
        }
    });

}

function showReview(id)
{
    $.ajax({
        type:"POST",
        url:"ajax/showReview.php",
        data:{
            'id':id
        },
        success:function(response){
            $(".showReview").html(response);

        },
        error:function(error){
            console.log(error);
        }
    });
   
}
function showContent(valueToSearch, title='', content='')
{
    if (valueToSearch) {
        searchResult(valueToSearch);
        $("#getMoreInfo").removeAttr( "style" );
    } else if (title !='') {
        $.ajax({
            type:"POST",
            data:{
                "title":title,
                "content":content
            },
            url:"ajax/movieTop.php",
            success:function(response){
                $('#searchOrContent').html(response);
            },
            error:function(error){
                console.log(error);
            }
        });
    }
}

function moviepageIntro(id, movieIntr, addFavorite, tmdbId, posterPath, overview, title, removeFavorite)
{
    $.ajax({
        type:"POST",
        url:"ajax/movieIntro.php",
        data:{
            'id':id
        },
        success: function(response){
            movieIntr.html(response);
            addFavorite.click(function(){
            addFavorite(tmdbId, posterPath, overview, title);
            });

            removeFavorite.click(function(){
                revomeFavorite(tmdbId);
            });
        }
    });

}
function navCheckLogin()
{
    $.ajax({
        "url":"ajax/navCheckLogin.php",
        success:function(response){
          $(".navbar-nav").append(response);
        },
        error:function(error){
          console.log(error);
        }
      });
}


