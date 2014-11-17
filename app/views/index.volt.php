<?php if($this->dispatcher->getControllerName() == 'circlemanage' && $this->dispatcher->getActionName() != 'index'){ ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo $this->getContent(); ?>
<?php }else{?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo $this->tag->getTitle(); ?>
		<?php if (@$controllerName=='session') { header("Location:../"); }?>
			<?php echo $this->tag->stylesheetLink('./static/js/lib/picasa/style/style.css'); ?>
        <?php echo $this->tag->stylesheetLink('./static/js/lib/webuploader/webuploader.css'); ?>
        <?php echo $this->tag->stylesheetLink('./static/style/font-awesome/style.css'); ?>
		<!-- 与login.css冲突 <?php echo $this->tag->stylesheetLink('./static/style/bootstrap.css'); ?> -->
		<!-- <?php echo $this->tag->stylesheetLink('./static/style/skin/metro/app_explorer.css'); ?> -->

        <?php echo $this->tag->javascriptInclude('./static/js/lib/less-1.4.2.min.js'); ?>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your invoices">
        <meta name="author" content="Phalcon Team">
	</head>
        <?php echo $this->getContent(); ?>
</html>
<?php }?>
