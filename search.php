<?php 

try {
    session_start();

    require 'config/database.php';

    if(isset($_GET['school_name'])) {
        $school_name=filter_var($_GET['school_name'],FILTER_SANITIZE_STRING);
    }

    if(isset($_GET['manager'])) {
        $manager=filter_var($_GET['manager'],FILTER_SANITIZE_STRING);
    }

    if(isset($_GET['phone'])) {
        $phone=filter_var($_GET['phone'],FILTER_SANITIZE_STRING);
    }
    
    if(!empty($school_name) and !empty($manager) and !empty($phone)) {
        $stmt_select_count=$pdo->prepare('SELECT count(*) FROM requests WHERE school_name LIKE concat("%",:school_name,"%") AND manager LIKE concat("%",:manager,"%") AND phone LIKE concat("%",:phone,"%")');
        $stmt_select_count->bindParam(':school_name',$school_name,PDO::PARAM_STR);
        $stmt_select_count->bindParam(':manager',$manager,PDO::PARAM_STR); 
        $stmt_select_count->bindParam(':phone',$phone,PDO::PARAM_STR);         
        $stmt_select_count->execute();
        $count=$stmt_select_count->fetchColumn();
        
        if($count) {
            $stmt_select=$pdo->prepare('SELECT id FROM requests WHERE school_name LIKE concat("%",:school_name,"%") AND manager LIKE concat("%",:manager,"%") AND phone LIKE concat("%",:phone,"%")');
            $stmt_select->bindParam(':school_name',$school_name,PDO::PARAM_STR);
            $stmt_select->bindParam(':manager',$manager,PDO::PARAM_STR); 
            $stmt_select->bindParam(':phone',$phone,PDO::PARAM_STR);         
            $stmt_select->execute();
            $id=$stmt_select->fetchColumn();

            $_SESSION['id']=$id;
            header('Location: edit.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>폐교과서 수거</title>
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
                <form action="search.php" style="margin-top:5em">
                    <div class="form-group">
                        <label for="school_name">학교명</label>
                        <input id="school_name" name="school_name" class="form-control form-control-lg"<?php if(!empty($school_name)): ?> value="<?php echo $school_name ?>"<?php endif ?>>
                    </div>                
                    <div class="form-group">
                        <label for="manager">담당자</label>
                        <input id="manager" name="manager" class="form-control form-control-lg"<?php if(!empty($manager)): ?> value="<?php echo $manager ?>"<?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label for="phone">전화번호</label>
                        <input id="phone" name="phone" class="form-control form-control-lg"<?php if(!empty($phone)): ?> value="<?php echo $phone ?>"<?php endif ?>>
                    </div>
                    <div class="form-group">                    
                        <input type="submit" value="검색" class="btn btn-secondary btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
<?php 
} catch (Exception $e) {
    echo $e->getLine();
	echo $e->getMessage();
}

?>
