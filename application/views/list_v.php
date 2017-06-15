<article id="board_area">
	<header>
		<h1> 게시판목록</h1>
	</header>
	<table cellspacing="0" cellpadding="0" class="table table-striped">
		<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">제목</th>
			<th scope="col">작성자</th>
			<th scope="col">조회수</th>
			<th scope="col">작성일</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($list as $lt) { ?>
			<tr>
				<th scope="row">
					<?php echo $lt->id;?>
				</th>
				<td><a rel="external" href="/index.php/board/view/<?php echo $this->uri->segment(3);?>/id/<?php echo $lt->id;?>/page/<?php echo $this->uri->segment(5);?>"><?php echo $lt->title;?></a></td>
				<td><?php echo $lt->user_name;?></td>
				<td><?php echo $lt->hits;?></td>
				<td><time datetime="<?php echo mdate('%Y-%M-%j', human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
			</tr>
		<?php }	?>
		</tbody>
		<tfoot>
		<tr>
			<th colspan="4"><?php echo $pagination;?></th>
			<td><a href="/index.php/board/write/board" class="btn btn-success">쓰기</a></td>
		</tr>
		</tfoot>
	</table>
	<div>
		<form id="frmSearch" method="post">
			<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);"/><input type="button" value="검색" id="search_btn"/>
		</form>
	</div>
</article>
<script>
	$(document).ready(function() {
	    $("#search_btn").click(function() {
	        if($("#q").val() =='') {
	            alert('검색어를 입력하세요.');
				return false;
			} else {
	            var act = "/index.php/board/lists/board/q/"+$("#q").val();
	            $("#frmSearch").attr('action', act).submit();
			}
		});
	});

	function board_search_enter(form) {
	    var keycode = window.event.keyCode;
	    if (keycode == 13) $("#search_btn").click();
	}
</script>
