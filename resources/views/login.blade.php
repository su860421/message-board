<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登入註冊</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <ul id="myTab" class="nav nav-tabs">
      	<li class="active">
      		<a href="#login" data-toggle="tab">登入</a>
        </li>
        <li>
          <a href="#registered" data-toggle="tab">註冊</a>
        </li>
      </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="login">
            <form class="bs-example bs-example-form" role="form" id="loginadmin">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="email" id="email" style="margin-top:10px;"></br>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="密碼" id="password"  style="margin-top:10px;"></br>
              </div>
              <button type="button" class="btn btn-dark" id="userlogin" style="margin-top:20px;">登入</button>
            </form>
          </div>
          <div class="tab-pane fade" id="registered">
            <form class="bs-example bs-example-form" role="form" id="newadmin">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="姓名" id="name" style="margin-top:10px;"></br>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="email" id="email"  style="margin-top:10px;"></br>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="密碼" id="password"  style="margin-top:10px;"></br>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="再次輸入密碼" id="passwordconfirmation"  style="margin-top:10px;"></br>
              </div>
              <button type="button" class="btn btn-dark" id="newuser" style="margin-top:20px;">註冊</button>
            </form>
          </div>
        </div>
    </div>
  </div>
</body>
</html>
