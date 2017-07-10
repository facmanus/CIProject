<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="apple-mobile-web-app-capable" content="yse"/>
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CIProject</title>
	<!--[if lt IE 9]>
	<script src="http://html5schiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--<script type="text/javascript" src="/include/js/httpRequest.js"></script>-->
	<script type="text/javascript" src="/include/js/cookie.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">CIProject</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="menu">
			<!--			<ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>-->

			<ul class="nav navbar-nav navbar-right">
				<li>
<?php
if ($this->session->userdata('logged_in') == TRUE) {
?>
					<p class="navbar-text"><?php echo $this->session->userdata('user_name'); ?> 님 환영합니다.</p>
					<button type="button" class="btn btn-default navbar-btn" id="btn_signout" >Sign out</button>
<?php
} else {
?>
					<?php
					//csrf 방지
					$attributes = array('class' => 'navbar-form navbar-right', 'id' => 'auth_login', 'role' => 'login');
					echo form_open('/index.php/auth/login', $attributes);
					?>
					<div class="form-group">
<!--						<label for="user_id" class="sr-only">userid</label>-->
						<input type="text" name="user_id" id="user_id" class="form-control" placeholder="enter Id">
						<label for="password" class="sr-only">password</label>
						<input type="text" name="password" id="password" class="form-control" placeholder="password">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
<?php
}
?>
				</li>
				<li><a href="/">Board</a></li>
				<!--				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>-->
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>

