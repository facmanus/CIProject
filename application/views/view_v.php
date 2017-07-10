<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-1 col-md-10 col-md-offset-1 main">
			<!--<h1 class="page-header">Dashboard</h1>-->

			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-7 col-sm-7 col-md-7">
						<h2 class="sub-header">게시판</h2>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 pull-right" style="margin-top:25px">
							<a href="/index.php/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary" role="button">목록</a>
							<a href="/index.php/board/edit/<?php echo $this->uri->segment(3);?>/id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a>
							<a href="/index.php/board/delete/<?php echo $this->uri->segment(3);?>/id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a>
							<a href="/index.php/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a>
					</div>
				</div>
			</div>
			<hr>
			<div class="blog-main">

				<div class="blog-post">
					<h2 class="blog-post-title"><?php echo $views->title ?></h2>
					<p class="blog-post-meta"><?php echo $views->reg_date; ?> by <a href="#"><?php echo $views->user_name; ?></a></p>
					<?php if ($images) { ?>
						<div id="image_area">
							<img src="/upload/<?php echo $images->file_name ?>" class="img-responsive" alt="Responsive image"/>
						</div>
					<?php } ?>

					<p><?php echo $views->contents ?></p>
				</div><!-- /.blog-post -->

				<nav>
					<ul class="pager">
						<li><a href="#">Previous</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</nav>
			</div>
			<hr>
			<div class="container-fluid">
				<form action="" method="post"  name="com_add" role="form">
					<legend class="sr-only">댓글</legend>

					<label for="input01"></label>
					<textarea id="input01" name="contents" class="form-control" rows="3"></textarea>
					<div style="margin-top:5px;float:right;">
						<button class="btn btn-default text-right" id="comment_add" >쓰기</button>
						<button class="input-btn btn text-right">취소</button>
					</div>
				</form>
			</div>
			<hr>
			<?php
			foreach($comment_list as $lt) {
			?>
			<div class="container-fluid" id="row_num_<?php echo $lt->id;?>">
				<ul class="list-unstyled">
					<li>
						<p>
							<a href=""><?php echo $lt->user_id;?></a>&nbsp;&nbsp;&nbsp;<span class="text-muted"><time datetime="<?php echo mdate('%Y-%M-%j', human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></span>
							<button type="button" id="comment_delete" vals="<?php echo $lt->id;?>" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</p>
					</li>
					<li><?php echo $lt->contents;?></li>
				</ul>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript" >

$(function() {
	$("#comment_add").click(function() {
		$.ajax({
			url : "/index.php/ajax_board/write",
			method : "POST",
			data : {
				"contents" : encodeURIComponent($("#input01").val()),
				"csrf_token" : $.cookie('csrf_cookie_name'),
				"bid" : "<?php echo $this->uri->segment(5);?>"
			},
			dataType: "html",
			complete:function(xhr, textStatus) {
				if (xhr.responseText == 1000) {
					alert('댓글을 입력하세요.')
				} else if (xhr.responseText == 2000) {
					alert('다시 입력하세요.')
				} else if (xhr.responseText == 9000) {
					alert('로그인이 필요합니다.')
				} else {
				    console.log(xhr.responseText);
					$("#comment_area").html(xhr.responseText);
					$("#input01").val("");
				}
			}
		});
	});

	$("#comment_delete").click(function() {
		console.log($(this).attr("vals"));
		$.ajax({
			url : "/index.php/ajax_board/delete",
			method : "POST",
			data : {
				"csrf_token" : $.cookie('csrf_cookie_name'),
				"id" : $(this).attr("vals")
			},
			dataType: "html",
			complete:function(xhr, textStatus) {
				if (xhr.responseText == 8000) {
					alert('자신의 글만 삭제가능합니다.')
				} else if (xhr.responseText == 2000) {
					alert('다시 시도하세요.')
				} else if (xhr.responseText == 9000) {
					alert('로그인이 필요합니다.')
				} else {
					$("#row_num_"+xhr.responseText).remove();
				    alert('삭제되었습니다.');
				}
			}
		});
	});
});

</script>
