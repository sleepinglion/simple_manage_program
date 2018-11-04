
<?php

try {
    require 'config/database.php';

    $student=filter_var($_POST['student'],FILTER_VALIDATE_INT);
    if(empty($student)) {
        $student=0;
    }

    $dateObj=new DateTime($_POST['desired_date'],$config['timezone']);
    $desired_date=$dateObj->format('Y-m-d');

    $currentDateObj=new DateTime('now',$config['timezone']);    
	$current_time=$currentDateObj->format('Y-m-d H:i:s');
   
    $stmt_insert=$pdo->prepare('INSERT INTO requests(area_name,school_name,student,address,manager,phone,date,vehicle,comment,created_at,updated_at) VALUES(:area_name,:school_name,:student,:address,:manager,:phone,:date,:vehicle,:comment,:created_at,:updated_at)');
	$stmt_insert->bindParam(':area_name',$_POST['area_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':school_name',$_POST['school_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':student',$student,PDO::PARAM_INT);
	$stmt_insert->bindParam(':address',$_POST['address'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':manager',$_POST['manager'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
	// $stmt_insert->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt_insert->bindParam(':date',$desired_date,PDO::PARAM_STR);
	$stmt_insert->bindParam(':vehicle',$_POST['vehicle'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':comment',$_POST['comment'],PDO::PARAM_STR);
    $stmt_insert->bindParam(':created_at',$current_time,PDO::PARAM_STR);
	$stmt_insert->bindParam(':updated_at',$current_time,PDO::PARAM_STR);
    $stmt_insert->execute();

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

