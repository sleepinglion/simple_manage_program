<?php 

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

	if(empty($_SESSION['id'])) {
?>
        <script>
        alert ("<?php echo _('') ?>");
        location.href='search.php';
        </script>
<?php
        exit;
    }

	$stmt_select=$pdo->prepare('SELECT `date` FROM requests GROUP BY `date` HAVING count(*)>=30');
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt_select_content=$pdo->prepare('SELECT * FROM requests WHERE id=:id');
    $stmt_select_content->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt_select_content->execute();
    $content=$stmt_select_content->fetch(PDO::FETCH_ASSOC);
    
    include __DIR__ . DIRECTORY_SEPARATOR . 'form.php';
} catch (Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}
