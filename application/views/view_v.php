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
			<th colspan="4"><?php echo $views->contents ?></th>
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
	<div>
		<form id="frmSearch" method="post">
			<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);"/><input type="button" value="검색" id="search_btn"/>
		</form>
	</div>
</article>
