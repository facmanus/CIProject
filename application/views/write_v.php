<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-1 col-md-10 col-md-offset-1 main">
			<!--<h1 class="page-header">Dashboard</h1>-->

			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-7 col-sm-7 col-md-7">
						<h2 class="sub-header">게시판</h2>
					</div>
					<div class="col-xs-1 col-xs-offset-4 col-sm-1 col-sm-offset-4 col-md-1 col-md-offset-4 pull-right" style="margin-top:25px">
						<a href="/index.php/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary" role="button">목록</a>
					</div>
				</div>
			</div>
			<hr>
			<div class="blog-main">

				<div class="blog-post">
					<?php
					//csrf 방지
					$attributes = array('class' => 'form', 'id' => 'write_action');
					//echo form_open('', $attributes);
					echo form_open_multipart('/index.php/board/write/board', $attributes);
					?>
						<legend class="sr-only">제목</legend>

						<div class="form-group">
							<label for="input01"></label>
							<input type="text" class="form-control" id="input01" name="title" <?php echo set_value('title');?> onblur="javascript:empty_check(document.title);" placeholder="제목을 입력하세요"/>
							<p class="help-block sr-only" >게시글의 제목을 써주세요.</p>
						</div>
						<div class="form-group">
							<label for="input02"></label>
							<textarea id="input02" class="form-control" name="contents" rows="5" <?php echo set_value('contents');?> onblur="javascript:empty_check(document.contents);" placeholder="내용을 입력하세요"></textarea>
							<p class="help-block sr-only">게시글의 내용을 써주세요.</p>
						</div>
						<div class="form-group">
							<label for="input03"></label>
							<input type="file"  id="input03" name="userfile" <?php echo set_value('userfile');?> />
							<p class="help-block sr-only">파일을 선택해주세요.</p>
						</div>

						<div>
						<!--<div class="alert alert-danger" role="alert">-->
							<?php
							if (@$error) {
								echo "<p>".$error."</p>";
							}
							?>
							<p><span style="color:red"><?php echo validation_errors(); ?></span></p>
						</div>
						<hr>
						<div style="margin-top:5px;float:right;">
							<button class="btn btn-default text-right" id="write_btn" >쓰기</button>
							<button class="input-btn btn text-right" onclick="document.location.reload()">취소</button>
						</div>
					</form>
				</div><!-- /.blog-post -->
			</div>
	</div>
</div>
<script type="text/javascript" >
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
//			}
		});
	});

	function empty_check(form) {
		if (keycode == 13) $("#write_btn").click();
	}
</script>
