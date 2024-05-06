<!DOCTYPE html>
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo _('Simple Manage') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Sleeping-Lion">
	<link href="<?php echo ASSET_DIRECTORY ?>images/favicon.ico" type="image/x-icon" rel="shortcut icon">
	<link href="<?php echo BOOTSTRAP_CSS_DIRECTORY?>bootstrap.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo ASSET_DIRECTORY ?>css/index.css" media="all" type="text/css" rel="stylesheet">
</head>
<body id="sl_error_page">
	<div class="container">
      <div class="row">
        <?php include __DIR__ . DIRECTORY_SEPARATOR .'ad.php' ?>
		<div class="col-12">
			<article class="bg-danger">
				<h3 class="text-danger"><?php echo _('Error') ?></h3>
				<?php if (DEBUG==1): ?>
					<p><?php echo $e->getCode() ?> : <?php echo $e->getMessage() ?><p>
						<?php else: ?>
						<p><?php echo _('Sorry Error') ?></p>
						<?php endif ?>
						<a href="<?php echo WEB_ROOT_DIRECTORY ?>index.php" class="btn btn-primary"><?php echo _('Confirm') ?></a>
					</article>
	  </div>
				</div>
	</div>
</body>
</html>
