<?php 

try {
	session_start();

	require 'config/database.php';
	

	$stmt_vehicle_select=$pdo->prepare('SELECT * FROM vehicles WHERE enable=1');
    $stmt_vehicle_select->execute();
	$vehicle_list=$stmt_vehicle_select->fetchAll(PDO::FETCH_ASSOC);	

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
	$list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

	include 'form.php';
} catch (Exception $e) {
	 echo $e->getMessage();
}

?>
