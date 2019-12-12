<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/2.3.1/js/bootstrap-modal.js"></script>
  </head>
  <body>
    <div class="alert alert-success text-center">
      <button type="button" class="btn btn-default pull-left" id="reorganize" style="margin-bottom:20px;margin-top:-7px;margin-left:10px;">重新整理</button>
      <strong>請盡快進入信箱驗證開通更多功能!</strong>
      <button type="button" class="btn btn-default pull-right" onclick="location.href='/logout'" style="margin-bottom:20px;margin-top:-7px;margin-left:10px;">登出</button>
    </div>
    <div class="posts" id="showmsg">

    </div>
    <script src="js/msgboard.js" type='text/javascript'></script>
  </body>
</html>
