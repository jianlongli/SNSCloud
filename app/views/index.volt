<?php if($this->dispatcher->getControllerName() == 'circlemanage' && $this->dispatcher->getActionName() != 'index'){ ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{ content() }}
<?php }else{?>
<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
		<?php if (@$controllerName=='session') { header("Location:../"); }?>
			{{ stylesheet_link('./static/js/lib/picasa/style/style.css') }}
        {{ stylesheet_link('./static/js/lib/webuploader/webuploader.css') }}
        {{ stylesheet_link('./static/style/font-awesome/style.css') }}
		<!-- 与login.css冲突 {{ stylesheet_link('./static/style/bootstrap.css') }} -->
		<!-- {{ stylesheet_link('./static/style/skin/metro/app_explorer.css') }} -->

        {{ javascript_include('./static/js/lib/less-1.4.2.min.js') }}

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your invoices">
        <meta name="author" content="Phalcon Team">
	</head>
        {{ content() }}
</html>
<?php }?>
