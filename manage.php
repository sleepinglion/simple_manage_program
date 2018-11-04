<?php 

try {
	session_start();

    if(empty($_SESSION['admin'])) {
        if(isset($_POST['admin_id']) and isset($_POST['password'])) {
            if($_POST['admin_id']=='admin' and $_POST['password']=='a12345') {
                $_SESSION['admin']=true;
            } else {
                $_SESSION['message']='아이디 또는 비밀번호가 맞지않습니다';
                include 'manage_login.php';
                exit;
            }
        } else {
            include 'manage_login.php';
            exit;
        }
    }

    require 'config/database.php';
    require ('Pager/Pager.php');

    $stmt_select=$pdo->prepare('SELECT count(*) FROM requests');
    $stmt_select->execute();
    $total=$stmt_select->fetchColumn();

    $pager_options = array(
        'mode'       => 'Sliding',   // Sliding or Jumping mode. See below.
        'perPage'    => 10,   // Total rows to show per page
        'delta'      => 4,   // See below
        'totalItems' => $total,
    );    

    $pager = Pager::factory($pager_options);
 


    list($from, $to) = $pager->getOffsetByPageId();
    
    $from = $from - 1;

    $perPage = $pager_options['perPage'];    
     

             

    $stmt_select=$pdo->prepare('SELECT cd.*,date(cd.reg_time) as reg_time FROM requests as cd LIMIT '.$from.' , '.$perPage);
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>폐교과서 수거</title>
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
                <table class="table table-striped table-hover">
                    <thead class="thead-default">
                        <tr>
                            <th>지역명</th>
                            <th>학교명</th>
                            <th>학생수</th>
                            <th>주소</th>
                            <th>담당자</th>
                            <th>전화번호</th>
                            <th>수거요청일</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $value): ?>
                        <tr>
                            <td><?php echo $value['area_name'] ?></td>
                            <td><?php echo $value['school_name'] ?></td>
                            <td><?php echo $value['student'] ?></td>
                            <td><?php echo $value['address'] ?></td>                        
                            <td><?php echo $value['manager'] ?></td>
                            <td><?php echo $value['phone'] ?></td>
                            <td><?php echo $value['date'] ?></td>
                            <td><?php echo $value['reg_time'] ?></td>                                                                       
                        </tr>                    
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="text-center">
                <?php echo $pager->links; ?>
                </div>                
            </div>
        </div>
    </div>
    
    </body>
</html>




<?php
} catch (Exception $e) {
    echo $e->getMessage();
}

?>