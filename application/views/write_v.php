<article id="board_area">
	<header>
		<h1> 게시판조회</h1>
	</header>

	<?php
	//csrf 방지
	$attributes = array('class' => 'form-horizontal', 'id' => 'write_action');
	//echo form_open('', $attributes);
	echo form_open_multipart('', $attributes);
	?>
		<fieldset>
			<legend>게시글쓰기</legend>
			<div class="control-group">
				<label class="control-label" for="input01">제목</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input01" name="title" <?php echo set_value('title');?> onblur="javascript:empty_check(document.title);"/>
					<p class="help-block">게시글의 제목을 써주세요.</p>
				</div>
				</label>
				<label class="control-label" for="input02">내용</label>
				<div class="controls">
					<textarea class="input-xlarge" id="input02" name="contents" rows="5" <?php echo set_value('contents');?> onblur="javascript:empty_check(document.contents);"></textarea>
					<p class="help-block">게시글의 내용을 써주세요.</p>
				</div>
				</label>
				<label class="control-label" for="input03">파일</label>
				<div class="controls">
					<input type="file" class="input-xlarge" id="input03" name="userfile" <?php echo set_value('userfile');?> />
					<p class="help-block">파일을 선택해주세요.</p>
				</div>
				</label>
				<div class="controls">
					<?php
					if (@$error) {
						echo "<p>".$error."</p>";
					}
					?>
					<p></p><?php echo validation_errors(); ?></p>
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
				<button class="btn" onclick="document.location.reload()">취소</button>
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
