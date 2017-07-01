<article id="board_area">
	<header>
		<h1> 게시판조회</h1>
	</header>
	<table cellspacing="0" cellpadding="0" class="table table-striped">
		<thead>
		<tr>
			<th scope="col"><?php echo $views->title ?></th>
			<th scope="col">작성자 : <?php echo $views->user_name; ?></th>
			<th scope="col">조회수 : <?php echo $views->hits; ?></th>
			<th scope="col">작성일 : <?php echo $views->reg_date; ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th colspan="4">
				<?php echo $views->contents ?>
				<?php if ($images) { ?>
				<div id="image_area">
					<img src="/upload/<?php echo $images->file_name ?>" />
				</div>
				<?php } ?>
			</th>
		</tr>
		</tbody>
		<tfoot>
		<tr>
			<th colspan="4">
				<a href="/index.php/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a>
				<a href="/index.php/board/edit/<?php echo $this->uri->segment(3);?>/id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a>
				<a href="/index.php/board/delete/<?php echo $this->uri->segment(3);?>/id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a>
				<a href="/index.php/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a>
			</td>
		</tr>
		</tfoot>
	</table>

	<form class="form-horizontal" method="post" action="" name="com_add">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="input01">댓글</label>
				<div class="controls">
					<textarea class="input-xlarge" id="input01" name="contents" rows="3"></textarea>
					<input class="btn btn-primary" type="button"  id="comment_add" value="작성">
					<p class="help_block"></p>
				</div>
			</div>
		</fieldset>
	</form>
	<div id="comment_area">
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<tbody>
			<?php
			foreach($comment_list as $lt) {
			?>
			<tr id="row_num_<?php echo $lt->id;?>">
				<th scope="row">
					<?php echo $lt->user_id;?>
				</th>
				<td><?php echo $lt->contents;?></td>
				<td><time datetime="<?php echo mdate('%Y-%M-%j', human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
				<td><a href="#" class="comment_delete" vals="<?php echo $lt->id;?>"><i class="icon-trash">삭제</i></a></td>
			</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</article>
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

	$(".comment_delete").click(function() {
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
				    alert('삭제되었습니다.')
				}
			}
		});
	});
});

</script>
