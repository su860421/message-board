<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/2.3.1/js/bootstrap-modal.js"></script>
  </head>
  <body>
    <button type="button" class="btn btn-default" id="reorganize" style="margin-bottom:20px;margin-top:10px;margin-left:10px;">重新整理</button>
    <button type="button" class="btn btn-default pull-right" onclick="location.href='/logout'" style="margin-bottom:20px;margin-top:10px;margin-left:10px;">登出</button>
    <div class="updatems">
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">修改該筆資料</h4>
              </div>
              <form class="bs-example bs-example-form" role="form" id="newmsg">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="" id="modaltitle" style="margin-left:10px;"></br>
                </div>
                <div class="input-group">
                  <textarea type="text" class="form-control input-group-lg" placeholder="" id="modalmsg" style="margin-top:10px;margin-left:10px;"></textarea></br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" id="modify" name="" data-dismiss="modal">修改</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <div class="posts" id="showmsg">

    </div>
    <div style="padding: 10px 10px 10px;">
	     <form class="bs-example bs-example-form" role="form" id="newmsg">
         {{ csrf_field() }}
           <div class="input-group">
             <input type="text" class="form-control" placeholder="標題" id="title" style="margin-top:10px;"></br>
           </div>
           <div class="input-group">
             <textarea type="text" class="form-control" placeholder="內文" id="msg" style="margin-top:10px;"></textarea></br>
           </div>
           <button type="button" class="btn btn-dark" id="submitmsg" style="margin-top:20px;">新增該留言</button>
       </form>
    </div>
    <script src="js/msgboard.js" type='text/javascript'></script>
  </body>
</html>
