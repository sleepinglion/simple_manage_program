
<?php

try {
    require 'config/database.php';

    $stmt_select=$pdo->prepare('SELECT * FROM requests WHERE length(comment)>2 AND (comment is not null OR comment!="")');
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

    foreach($list as $value) {
        $stmt_insert=$pdo->prepare('INSERT INTO request_contents(request_id,content) VALUES(:request_id,:content)');
        $stmt_insert->bindParam(':request_id',$value['id'],PDO::PARAM_INT);
        $stmt_insert->bindParam(':content',$value['comment'],PDO::PARAM_STR);        
        $stmt_insert->execute();
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
