<?php 

try {
	session_start();

    require 'config/database.php';

	if(!empty($_SESSION['id'])) {
        
    }

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt_select=$pdo->prepare('SELECT * FROM requests WHERE id=:id');
    $stmt_select->bindParam(':id',$phone,PDO::PARAM_INT);         
    $stmt_select->execute();
    $content=$stmt_select->fetch(PDO::FETCH_ASSOC);

	include 'form.php';
} catch (Exception $e) {
	 echo $e->getMessage();
}

?>
