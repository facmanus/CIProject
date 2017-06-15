<article id="board_area">
	<header>
		<h1> 게시판수정</h1>
	</header>

	<form class="form-horizontal" method="post" action="" id="write_action">
		<fieldset>
			<legend>게시글수정</legend>
			<div class="control-group">
				<label class="control-label" for="input01">제목</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input01" name="title" value="<?php echo $views->title;?>" onblur="javascript:empty_check(document.title);"/>
					<p class="help-block">게시글의 제목을 써주세요.</p>
				</div>
				</label>
				<label class="control-label" for="input02">내용</label>
				<div class="controls">
					<textarea class="input-xlarge" id="input02" name="contents" rows="5" onblur="javascript:empty_check(document.contents);"><?php echo $views->contents;?></textarea>
					<p class="help-block">게시글의 내용을 써주세요.</p>
				</div>
				</label>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary" id="write_btn">수정</button>
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
