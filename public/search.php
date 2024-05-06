<?php 

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

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
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo _('Simple Manage') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Sleeping-Lion">
	<link href="<?php echo IMAGE_DIRECTORY?>favicon.ico" type="image/x-icon" rel="shortcut icon">
	<link href="<?php echo BOOTSTRAP_CSS_DIRECTORY?>bootstrap.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo CSS_DIRECTORY?>index.css" media="all" type="text/css" rel="stylesheet">
</head>
  <body>
  	<!-- header -->
    <div class="container">     
        <div class="row">
            <div class="col-12">
                <form action="search.php" style="margin-top:5em">
                    <div class="form-group">
                        <label for="school_name"><?php ecvho _('School Name') ?></label>
                        <input id="school_name" name="school_name" class="form-control form-control-lg"<?php if(!empty($school_name)): ?> value="<?php echo $school_name ?>"<?php endif ?>>
                    </div>                
                    <div class="form-group">
                        <label for="manager"><?php echo _('Manager') ?></label>
                        <input id="manager" name="manager" class="form-control form-control-lg"<?php if(!empty($manager)): ?> value="<?php echo $manager ?>"<?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label for="phone"><?php echo _('Phone') ?></label>
                        <input id="phone" name="phone" class="form-control form-control-lg"<?php if(!empty($phone)): ?> value="<?php echo $phone ?>"<?php endif ?>>
                    </div>
                    <div class="form-group">                    
                        <input type="submit" value="<?php echo _('Search') ?>" class="btn btn-secondary btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
<?php 
} catch (Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}

?>
