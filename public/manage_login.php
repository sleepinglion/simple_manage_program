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
                <form action="manage.php" method="post" class="card" style="margin-top:5em">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="admin_id"><?php echo _('User ID') ?></label>
                        <input id="admin_id" name="admin_id" type="text" required="required" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password"><?php echo _('Password') ?></label>
                        <input id="password" name="password" type="password" required="required" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="<?php echo _('Login') ?>" class="btn btn-lg btn-primary btn-block">
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>