function getMoreInfo(callback, query, i, appendClass) {
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

function handleData(data, appendClass) {
    if (data.result == true) {
        appendClass.append(data.datas);
    } else {
        alert(data.msg);
    }
}