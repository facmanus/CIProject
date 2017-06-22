<article id="board_area">
	<header>
		<h1> form test </h1>
	</header>

    <?php echo validation_errors(); ?>

	<form class="form-horizontal" method="post">
		<fieldset>
			<legend>폼 검증</legend>
			<div class="control-group">
				<label class="control-label" for="input01">아이디</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input01" name="username"/>
					<p class="help-block">아이디를 입력하세요</p>
				</div>
				</label>
				<label class="control-label" for="input02">비밀번호</label>
				<div class="controls">
                    <input type="text" class="input-xlarge" id="input02" name="password"/>
                    <p class="help-block">비밀번호를 입력하세요</p>
				</div>
				</label>
                <label class="control-label" for="input02">비밀번호 확인</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="input03" name="passconf"/>
                    <p class="help-block">비밀번호를 한번 더 입력하세요</p>
                </div>
                </label>
                <label class="control-label" for="input02">이메일</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="input04" name="email"/>
                    <p class="help-block">이메일을 입력하세요</p>
                </div>
                </label>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">전송</button>
			</div>

		</fieldset>
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
