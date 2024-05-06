<?php 

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

    if(empty($_SESSION['admin'])) {
        if(isset($_POST['admin_id']) and isset($_POST['password'])) {
            if($_POST['admin_id']=='admin' and $_POST['password']=='a12345') {
                $_SESSION['admin']=true;
            } else {
                $_SESSION['message']='아이디 또는 비밀번호가 맞지않습니다';
                include __DIR__ . DIRECTORY_SEPARATOR . 'manage_login.php';
                exit;
            }
        } else {
            include __DIR__ . DIRECTORY_SEPARATOR . 'manage_login.php';
            exit;
        }
    }

    require ('Pager/Pager.php');

    $stmt_select=$pdo->prepare('SELECT count(*) FROM requests');
    $stmt_select->execute();
    $total=$stmt_select->fetchColumn();

    $pager_options = array(
        'mode'       => 'Sliding',   // Sliding or Jumping mode. See below.
        'perPage'    => 10,   // Total rows to show per page
        'delta'      => 4,   // See below
        'totalItems' => $total,
    );    

    $pager = Pager::factory($pager_options);
 


    list($from, $to) = $pager->getOffsetByPageId();
    
    $from = $from - 1;

    $perPage = $pager_options['perPage'];

    $stmt_select=$pdo->prepare('SELECT cd.*,date(cd.created_at) as created_at FROM requests as cd ORDER BY id DESC LIMIT '.$from.' , '.$perPage);
    $stmt_select->execute();
    $list=$stmt_select->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo _('Simple Manage') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="author" content="Sleeping-Lion">
	<link href="<?php echo IMAGE_DIRECTORY?>favicon.ico" type="image/x-icon" rel="shortcut icon">
	<link href="<?php echo BOOTSTRAP_CSS_DIRECTORY?>bootstrap.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo CSS_DIRECTORY?>index.css" media="all" type="text/css" rel="stylesheet">
</head>
  <body>
  	<!-- header -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead class="thead-default">
                        <tr>
                            <th><?php echo _('School Name') ?></th>
                            <th><?php echo _('Address') ?></th>
                            <th><?php echo _('Manager') ?></th>
                            <th><?php echo _('Phone') ?></th>
                            <th><?php echo _('Date') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $value): ?>
                        <tr>
                            <td><?php echo $value['school_name'] ?></td>
                            <td><?php echo $value['address'] ?></td>
                            <td><?php echo $value['manager'] ?></td>
                            <td><?php echo $value['phone'] ?></td>
                            <td><?php echo $value['date'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="text-center">
                <?php echo $pager->links; ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

<?php
} catch (Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}

?>