<?php

namespace SleepingLion\SimpleManagerForm;

try {
    require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
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
                <div class="jumbotron hero-unit text-center">
                    <?php echo _('Select Request OR Search') ?>
                </div>
            </div>
            <div class="col-6 text-center">
                <a href="add.php" class="btn btn-lg btn-primary btn-block"><?php echo _('Request') ?></a>
            </div>
            <div class="col-6 text-center">
                <a href="search.php" class="btn btn-lg btn-secondary btn-block"><?php echo _('Search, Edit') ?></a>
            </div>
        </div>
    </div>
  </body>
</html>
<?php

} catch (\Exception $e) {
    include __DIR__ . DIRECTORY_SEPARATOR . 'error.php';
}
?>