<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function alert($msg='이동합니다', $url='') {
	$CI =& get_instance(); //원본의CodeIgniter 객체를 사용한다는것을 의미
	echo "<meta http-equiv=\"content type\" content=\"text/html;charset=".$CI->config->item('charset')."\">";
	echo "
		<script>
			alert('".$msg."');
			location.replace('".$url."');
		</script>
	";
	exit;
}

function alert_close($msg) {
	$CI =& get_instance(); //원본의CodeIgniter 객체를 사용한다는것을 의미
	echo "<meta http-equiv=\"content type\" content=\"text/html;charset=".$CI->config->item('charset')."\">";
	echo "
		<script>
			alert('".$msg."');
			window.close();
		</script>
	";
	exit;
}

function alert_only($msg, $exit=TRUE) {
	$CI =& get_instance(); //원본의CodeIgniter 객체를 사용한다는것을 의미
	echo "<meta http-equiv=\"content type\" content=\"text/html;charset=".$CI->config->item('charset')."\">";
	echo "
		<script>
			alert('".$msg."');
		</script>
	";
	if ($exit) exit;
}

function replace($url='/') {
	echo "<script>";
			if ($url) echo "window.location.replace('".$url."');";
	echo "</script>";
	exit;
}


