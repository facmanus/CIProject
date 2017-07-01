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
<div id="main">
	<header id="header" data-role="header" data-position="fixed">
		<blockquote>
			<h6>CIProject</h6>
			<p>
<?php
	if ($this->session->userdata('logged_in') == TRUE) {
?>
	<?php echo $this->session->userdata('user_name'); ?> 님 환영합니다. <a href="/index.php/auth/logout" class="btn">로그아웃</a>
<?php
	} else {
?>
		<a href="/index.php/auth/login" class="btn">로그인</a>
<?php
	}
?>
			</p>
		</blockquote>
	</header>
