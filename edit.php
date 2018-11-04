<?php 

try {
	session_start();

    require 'config/database.php';

	if(!empty($_SESSION['id'])) {
        
    }

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt_select_content=$pdo->prepare('SELECT * FROM requests WHERE id=:id');
    $stmt_select_content->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);         
    $stmt_select_content->execute();
    $content=$stmt_select_content->fetch(PDO::FETCH_ASSOC);
    
	include 'form.php';
} catch (Exception $e) {
	 echo $e->getMessage();
}

?>
