$.ajax({ //---------------------------------------------------初始新增
        url: "/showallmsg",
        type: "get",
        dataType: "json",
    })
    .done(function(data) {
        for (var i = 0; i < data.length; i++) {
            // 丟給 render function
            addPost(data[i]);
        }
    })
    .fail(function(err) {
        alert("错誤");
    })

function addPost(returnmsg) {
    var item = '' +
        '<div class="panel panel-default" id=' + returnmsg.id + '>' +
        '<div class="panel-heading">' +
        '<h3 class="panel-title" id="show' + returnmsg.id + '">' + ' 帳號 : ' + returnmsg.email + ' , 姓名 : ' + returnmsg.name + ' , 更新時間 ：' + returnmsg.updated_at + '<br><br>' +
        ' 標題 : ' + returnmsg.title +
        '</h3>' +
        '<button type="button" class="btn btn-success pull-right" style="margin-top:-45px;" onclick="updat(' + returnmsg.id + ');">' + '編輯' + '</button>' +
        '<button type="button" class="btn btn-danger pull-right"style="margin-right:80px;margin-top:-45px;" onclick="del(' + returnmsg.id + ');">' + '刪除' + '</button>' +
        '</div>' +
        '<div class="panel-body">' +
        '<p id="msg' + returnmsg.id + '">' + returnmsg.msg + '</p>'
    '</div>' +
    '</div>';
    $('.posts').append(item);
}

$(document).ready(function() { //------------------------------------------------------------重新整理
    function addPost(returnmsg) {
        var item = '' +
            '<div class="panel panel-default" id=' + returnmsg.id + ')>' +
            '<div class="panel-heading">' +
            '<h3 class="panel-title" id="show' + returnmsg.id + '">' + ' 帳號 : ' + returnmsg.email + ' , 姓名 : ' + returnmsg.name + ' , 更新時間 ：' + returnmsg.updated_at + '<br><br>' +
            ' 標題 : ' + returnmsg.title +
            '</h3>' +
            '<button type="button" class="btn btn-success pull-right" style="margin-top:-45px;" id="updatemsg" onclick="updat(' + returnmsg.id + ');">' + '編輯' + '</button>' +
            '<button type="button" class="btn btn-danger pull-right"style="margin-right:80px;margin-top:-45px;" onclick="del(' + returnmsg.id + ');">' + '刪除' + '</button>' +
            '</div>' +
            '<div class="panel-body">' +
            '<p id="msg' + returnmsg.id + '">' + returnmsg.msg + '</p>'
        '</div>' +
        '</div>';
        $('.posts').append(item);
        $("#reorganize").attr('disabled', '');
        setTimeout('$("#reorganize").removeAttr("disabled");', 100);
    }
    $("#reorganize").click(function() {
        $.ajax({
                url: "/showallmsg",
                type: "get",
                dataType: "json",
            })
            .done(function(data) {
                $("#showmsg").empty();
                for (var i = 0; i < data.length; i++) {
                    // 丟給 render function
                    addPost(data[i]);
                }
            })
            .fail(function(err) {
                alert("错誤");
            })


    })
});

function del(item) { //--------------------------------------------------刪除
    $.ajax({
            url: "/deletemsg",
            type: "post",
            dataType: "json",
            data: {
                id: item
            }
        })
        .done(function(item) {
            if (!item.id) {
                alert(item.msg);
            } else {
                var el = document.getElementById(item.id);
                //console.log(item);
                el.remove();
            }
        })
        .fail(function(err) {
            alert("错誤");
        })
}

function updat(item) { //---------------------------------------------浮動視窗
    $.ajax({
            url: "/updat",
            type: "post",
            dataType: "json",
            data: {
                id: item
            }
        })
        .done(function(update) {
            if (!update.id) {
                alert(update.msg);
            } else {
                document.getElementById('modify').name = update.id;
                document.getElementById('modalmsg').placeholder = update.msg;
                document.getElementById('modaltitle').placeholder = update.title;
                $('#myModal').modal('show')
            }
        })
        .fail(function(err) {
            alert("错誤");
        })
}
$(document).ready(function() {
    $("#modify").click(function() { //----------------------------------------------------------修改
        var id = $(this).attr("name");
        $.ajax({
                type: "PUT", //傳送方式
                url: '/updatemsg', //傳送目的地
                dataType: "json", //資料格式
                data: { //傳送資料
                    id: id,
                    title: $("#modaltitle").val(),
                    msg: $("#modalmsg").val()
                }
            })
            .done(function(returnmsg) {
                if (!returnmsg.id) {
                    alert(returnmsg.msg);
                } else {
                  $("#modifymsg").find(":text,textarea").each(function() {//修改後文字還在上面尚未解決
                    $(this).val("");
                  });
                    var el = returnmsg.id;
                    document.getElementById('show' + el).innerHTML = ' 帳號 :' + returnmsg.email + ' , 姓名 : ' + returnmsg.name + ' , 更新時間 ：' + returnmsg.updated_at + '<br><br>' + ' 標題 : ' + returnmsg.title;
                    document.getElementById('msg' + el).innerHTML = returnmsg.msg;
                }
            })
            .fail(function(err) {
                alert("错誤");
            })

    })
});

$.ajaxSetup({
    headers: { //csrf防護
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $("#submitmsg").click(function() {
        $.ajax({
            type: "POST", //傳送方式
            url: '/newmsg', //傳送目的地
            dataType: "json", //資料格式
            data: { //傳送資料
                title: $("#title").val(),
                msg: $("#msg").val()
            },
            success: function(data) {
                if (data.name) {
                    // document.getElementById("newmsg").reset();
                    // $("#newmsg")[0].reset();
                    $("input").val("");
                    $("textarea").val("");
                    var item = '' +
                        '<div class="panel panel-default" id=' + data.id + '>' +
                        '<div class="panel-heading">' +
                        '<h3 class="panel-title" id="show' + data.id + '">' + ' 帳號 : ' + data.email + ' , 姓名 : ' + data.name + ' , 更新時間 ：' + data.time + '<br><br>' +
                        ' 標題 : ' + data.title +
                        '</h3>' +
                        '<button type="button" class="btn btn-success pull-right" style="margin-top:-45px;" onclick="updat(' + data.id + ');">' + '編輯' + '</button>' +
                        '<button type="button" class="btn btn-danger pull-right"style="margin-right:80px;margin-top:-45px;" onclick="del(' + data.id + ');">' + '刪除' + '</button>' +
                        '</div>' +
                        '<div class="panel-body">' +
                        '<p id="msg' + data.id + '">' + data.msg + '</p>' +
                        '</div>' +
                        '</div>';
                    $('.posts').append(item);

                } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                    $("#newmsg")[0].reset(); //重設 ID 為 demo 的 form (表單)
                    $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                }
            },
            error: function(jqXHR) {
                $("#newmsg")[0].reset(); //重設 ID 為 demo 的 form (表單)
                $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
            }

        })
    })
});
