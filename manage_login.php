<!DOCTYPE html>
<html lang="ko">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>폐교과서 수거 관리자 로그인</title>
  <link href="./assets/images/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
  <link href="./assets/stylesheets/bootstrap.min.css" media="all" type="text/css" rel="stylesheet" />
  <link href="./assets/stylesheets/index.css" media="all" type="text/css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Sleeping-Lion" />
  	<!--[if IE]>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	<![endif]-->
  </head>
  <body>
  	<!-- header -->
    <div class="container">        
        <div class="row">
            <div class="col-12">
                <form action="manage.php" method="post" class="card" style="margin-top:5em">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="admin_id">아이디</label>
                        <input id="admin_id" name="admin_id" type="text" required="required" class="form-control form-control-lg">                                        
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input id="password" name="password" type="password" required="required" class="form-control form-control-lg">                                        
                    </div>
                    <div class="form-group">
                        <input type="submit" value="로그인" class="btn btn-lg btn-primary btn-block">
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>