
<?php

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

    $student=filter_var($_POST['student'],FILTER_VALIDATE_INT);
    if(empty($student)) {
        $student=0;
    }

    $vehicle_id=filter_var($_POST['vehicle'],FILTER_VALIDATE_INT);
    $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);

    $dateObj=new DateTime($_POST['desired_date'],$config['timezone']);
    $desired_date=$dateObj->format('Y-m-d');

    $currentDateObj=new DateTime('now',$config['timezone']);
	$current_time=$currentDateObj->format('Y-m-d H:i:s');
   
    $stmt_update=$pdo->prepare('UPDATE requests SET vehicle_id=:vehicle_id,area_name=:area_name,school_name=:school_name,student=:student,address=:address,manager=:manager,phone=:phone,date=:date,comment=:comment,updated_at=:updated_at WHERE id=:id');
	$stmt_update->bindParam(':vehicle_id',$vehicle_id,PDO::PARAM_INT);
	$stmt_update->bindParam(':area_name',$_POST['area_name'],PDO::PARAM_STR);
	$stmt_update->bindParam(':school_name',$_POST['school_name'],PDO::PARAM_STR);
	$stmt_update->bindParam(':student',$_POST['student'],PDO::PARAM_STR);
	$stmt_update->bindParam(':address',$_POST['address'],PDO::PARAM_STR);
	$stmt_update->bindParam(':manager',$_POST['manager'],PDO::PARAM_STR);
	$stmt_update->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
	//$stmt_insert->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt_update->bindParam(':date',$desired_date,PDO::PARAM_STR);
	$stmt_update->bindParam(':comment',$_POST['comment'],PDO::PARAM_STR);
	$stmt_update->bindParam(':updated_at',$current_time,PDO::PARAM_STR);	
	$stmt_update->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt_update->execute();
    
    $stmt_update_content=$pdo->prepare('UPDATE request_contents SET content=:content WHERE request_id=:id');
	$stmt_update_content->bindParam(':content',$content,PDO::PARAM_STR);
	$stmt_update_content->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt_update_content->execute();
	
	unset($_SESSION['id']);
    ?>
    <script>
    alert ("수정되었습니다");
    location.href='index.php';
    </script>
        
    <?php 
} catch (Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}

