
<?php

try {
    require 'config/database.php';

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
   
    $stmt_insert=$pdo->prepare('INSERT INTO requests(vehicle_id,area_name,school_name,student,address,manager,phone,date,created_at,updated_at) VALUES(:vehicle_id,:area_name,:school_name,:student,:address,:manager,:phone,:date,:created_at,:updated_at)');
	$stmt_insert->bindParam(':vehicle_id',$vehicle_id,PDO::PARAM_INT);
	$stmt_insert->bindParam(':area_name',$_POST['area_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':school_name',$_POST['school_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':student',$student,PDO::PARAM_INT);
	$stmt_insert->bindParam(':address',$_POST['address'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':manager',$_POST['manager'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
	// $stmt_insert->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt_insert->bindParam(':date',$desired_date,PDO::PARAM_STR);
    $stmt_insert->bindParam(':created_at',$current_time,PDO::PARAM_STR);
	$stmt_insert->bindParam(':updated_at',$current_time,PDO::PARAM_STR);
    $stmt_insert->execute();

    $id=$pdo->lastInsertId();

    if(!empty($content)) {
        $stmt_insert_content=$pdo->prepare('INSERT INTO request_contents(request_id,content) VALUES(:request_id,:content)');
        $stmt_insert_content->bindParam(':request_id',$id,PDO::PARAM_INT);
	    $stmt_insert_content->bindParam(':content',$content,PDO::PARAM_STR);
        $stmt_insert_content->execute();
    }

    $sendmail=false;

    if($mail_send) {
        include 'sendmail.php';
    }
?>
<script>
alert ("접수되었습니다");
location.href='index.php';
</script>
    
<?php
} catch (Exception $e) {
    echo $e->getMessage();
}

