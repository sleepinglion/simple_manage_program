<?php 

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
	

	$stmt_vehicle_select=$pdo->prepare('SELECT * FROM vehicles WHERE enable=1');
    $stmt_vehicle_select->execute();
	$vehicle_list=$stmt_vehicle_select->fetchAll(PDO::FETCH_ASSOC);	

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
	$list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

    include __DIR__ . DIRECTORY_SEPARATOR . 'form.php';
} catch (Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}
