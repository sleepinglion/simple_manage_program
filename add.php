<?php 

try {
	session_start();

    require 'config/database.php';

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
	$list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

	include 'form.php';
} catch (Exception $e) {
	 echo $e->getMessage();
}

?>
