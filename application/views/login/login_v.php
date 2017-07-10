<article id="board_area">
	<header>
		<h1> login </h1>
	</header>

    <?php //echo validation_errors(); ?>
	<?php
	//csrf 방지
	$attributes = array('class' => 'form-horizontal', 'id' => 'auth_login');
	echo form_open('/index.php/auth/login', $attributes);
	?>
		<fieldset>
			<legend>폼 검증</legend>
				<div class="control-group">
					<label class="control-label" for="input01">아이디</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input01" name="user_id" value="<?php echo set_value('user_id');?>"/>
						<p class="help-block"></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input02">비밀번호</label>
					<div class="controls">
                    	<input type="password" class="input-xlarge" id="input02" name="password" value="<?php echo set_value('password');?>"/>
                    	<p class="help-block"><?php echo validation_errors(); ?></p>
					</div>
				</div>
		</fieldset>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">전송</button>
			<button type="button" class="btn" onclic="document.location.reload()">취소</button>
		</div>


	</form>
</article>
<script>
	$(document).ready(function() {
		$("#write_btn").click(function() {
			if($("#input01").val() =='') {
				alert('제목를 입력하세요.');
				$("#input01").focus();
				return false;
			} else if ($("#input02").val() =='') {
				alert('내용를 입력하세요.');
				$("#input02").focus();
				return false;
			} else {
				$("#write_action").submit();
			}
		});
	});

	function empty_check(form) {
		if (keycode == 13) $("#write_btn").click();
	}
</script>
