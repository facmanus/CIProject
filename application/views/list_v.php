<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-1 col-md-10 col-md-offset-1 main">
			<!--<h1 class="page-header">Dashboard</h1>-->

			<div class="container-fluid">
				<div class="row" style="margin-bottom:5px">
					<div class="col-xs-10 col-sm-10 col-md-10">
						<h2 class="sub-header">게시판</h2>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 pull-right">
						<div class="btn-group" role="group" style="margin-top:20px">
							<a href="/index.php/board/write/board" class="btn btn-success">쓰기</a>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col">#</th>
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
				</table>
				<div class="container-fluid">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 pull-left">
<!--							<ul class="pagination">
								<li>
									<a href="#" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li>
									<a href="#" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							</ul>-->
							<?php echo $pagination;?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6" style="margin-top:20px;">
						<form class="form-inline">
							<div class="form-group">
								<label class="sr-only" for="search">search</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search_word" id="q" onkeypress="board_search_enter(document.q);">
									<div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true" id="search_btn"></span></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

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
