
<?php

try {
    require 'config/database.php';
   
    $stmt_insert=$pdo->prepare('UPDATE requests SET area_name=:area_name,school_name=:school_name,student=:student,address=:address,manager=:manager,phone=:phone,email=:email,date=:date,vehicle=:vehicle,comment=:comment,updated_at=NOW() WHERE id=:id');
	$stmt_insert->bindParam(':area_name',$_POST['area_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':school_name',$_POST['school_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':student',$_POST['student'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':address',$_POST['address'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':manager',$_POST['manager'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt_insert->bindParam(':date',$desired_date,PDO::PARAM_STR);
	$stmt_insert->bindParam(':vehicle',$_POST['vehicle'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':comment',$_POST['comment'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt_insert->execute();
    
} catch (Exception $e) {
    echo $e->getMessage();
}

