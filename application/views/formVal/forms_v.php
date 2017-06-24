<article id="board_area">
	<header>
		<h1> form test </h1>
	</header>

    <?php //echo validation_errors(); ?>
	<?php
	if (form_error('user_id')) {
		$error_userid = form_error('user_id');
	} else {
		$error_userid = form_error('check_userid');
	}
	?>
	<form class="form-horizontal" method="post">
		<fieldset>
			<legend>폼 검증</legend>
			<div class="control-group">
				<div class="control-group">
					<label class="control-label" for="input01">아이디</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input01" name="user_id" value="<?php echo set_value('user_id');?>"/>
						<p class="help-block"><?php echo (!$error_userid ?'아이디를 입력하세요':$error_userid);?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input02">비밀번호</label>
					<div class="controls">
                    	<input type="text" class="input-xlarge" id="input02" name="password" value="<?php echo set_value('password');?>"/>
                    	<p class="help-block"><?php echo(!form_error('password')?'비밀번호를 입력하세요':form_error('password'));?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input03">비밀번호 확인</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input03" name="passconf" value="<?php echo set_value('passconf');?>"/>
						<p class="help-block">비밀번호를 한번 더 입력하세요</p>
					</div>
				</div>
				<div class="control-group">
                	<label class="control-label" for="input04">이메일</label>
                	<div class="controls">
                    	<input type="text" class="input-xlarge" id="input04" name="email" value="<?php echo set_value('email');?>"/>
                    	<p class="help-block">이메일을 입력하세요</p>
                	</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input05">기본값 설정</label>
					<div class="controls">
						<input type="text"  id="input05" name="count" value="<?php echo set_value('count', '0');?>"/>
						<p class="help-block">기본값 출력</깁></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input06">셀렉트값 복원</label>
					<div class="controls">
						<select name="myselect" id="input06">
							<option value="one" <?php echo set_select('myselect', 'one', TRUE); ?>>One</option>
							<option value="two" <?php echo set_select('myselect', 'two'); ?>>Two</option>
							<option value="three" <?php echo set_select('myselect', 'three'); ?>>Three</option>
						</select>
						<p class="help-block">셀렉트하세요.</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input07">체크박스</label>
					<div class="controls">
						1번 <input type="checkbox"  id="input07" name="mycheck[]" value="1" <?php echo set_checkbox('mycheck[]', '1', TRUE); ?> />
						2번 <input type="checkbox"  id="input08" name="mycheck[]" value="2" <?php echo set_checkbox('mycheck[]', '2'); ?> />
						<p class="help-block">체크박스를 선택하세요</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input09">라디오</label>
					<div class="controls">
						1번 <input type="radio"  id="input09" name="myradio" value="1" <?php echo set_radio('myradio', '1', TRUE); ?> />
						2번 <input type="radio"  id="input10" name="myradio" value="2" <?php echo set_radio('myradio', '2'); ?> />
						<p class="help-block">라디오버튼을 선택하세요</p>
					</div>
				</div>
			</div>
		</fieldset>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">전송</button>
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
