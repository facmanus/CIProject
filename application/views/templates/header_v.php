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

<script>

	// This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			testAPI();
		} else {
			// The person is not logged into your app or we are unable to tell.
			//document.getElementById('status').innerHTML = 'Please log ' +
			//	'into this app.';
		}
	}

	// This function is called when someone finishes with the Login
	// Button.  See the onlogin handler attached to it in the sample
	// code below.
	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	// Here we run a very simple test of the Graph API after login is
	// successful.  See statusChangeCallback() for when this call is made.
	function testAPI() {
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', function(response) {
			console.log('Successful login for: ' + response.name);
			document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.name + '!';
		});
	}

	window.fbAsyncInit = function() { //이 이하의 함수는 sdk를 모두 읽어들인 후에 실행됨.
		FB.init({
			appId            : '839457696217884',
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v2.10'
		});

		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});

		FB.AppEvents.logPageView();
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		/*js.src = "//connect.facebook.net/en_US/sdk.js";*/
		js.src = "//connect.facebook.net/ko_KR/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

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
			<div
				class="fb-like"
				data-share="true"
				data-width="450"
				data-show-faces="true">
			</div>
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
					echo form_open('auth/login', $attributes);
					?>
					<div class="form-group">
<!--						<label for="user_id" class="sr-only">userid</label>-->
						<input type="text" name="user_id" id="user_id" class="form-control" placeholder="enter Id">
						<label for="password" class="sr-only">password</label>
						<input type="text" name="password" id="password" class="form-control" placeholder="password">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
					<!--facebook-->
					<button type="button" class="btn btn-primary">페이스북로그인</button>

<!--						<div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>-->
						<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
						</fb:login-button>-->
<?php
}
?>
				</li>
				<li><a href="/">Board</a></li>
				<li><div id="status"></div></li><!--facebook 확인-->
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

