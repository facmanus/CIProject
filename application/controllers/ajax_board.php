<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 게시판 메인 컨트롤러
 */
class Ajax_board extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('board_m');
		$this->load->helper('alert');
	}

	public function write()
	{
		if ($this->session->userdata('logged_in') == TRUE) {

			$table = "comments"; //$this->input->post('table', TRUE);
			$bid = $this->input->post('id', TRUE);
			$contents = $this->input->post('contents', TRUE);

			if ($contents != '') {
				$write_data = array(
					'bid' => $bid,
					'user_id' => $this->session->userdata('user_id'),
					'user_name' => $this->session->userdata('user_name'),
					'contents' => $contents,
					'table' => $table
				);

				$result = $this->board_m->insert_comment($write_data);

				if ($result) {
					$data['comment_list'] = $this->board_m->getCommentsList($table, $bid);
?>
					<table cellspacing="0" cellpadding="0" class="table table-striped">
						<tbody>
<?php
					foreach($data['comment_list'] as $lt) {
?>
						<tr>
							<th scope="row">
								<?php echo $lt->user_id;?>
							</th>
							<td><?php echo $lt->contents;?></td>
							<td><time datetime="<?php echo mdate('%Y-%M-%j', human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
						</tr>
<?php
                    }
?>
						</tbody>
					</table>
<?php
				} else {
					echo "2000"; //입력실패
				}
			} else {
				echo "1000"; //내용체크
			}
		} else {
			echo "9000";	//로그인
		}

	}

	public function delete() {

		if ($this->session->userdata('logged_in') == TRUE) {

			//본인확인
			$table = "comments";
			$id = $this->input->post('id', TRUE);

			$writer_id = $this->board_m->writer_check($table, $id);

			if ($writer_id->user_id != $this->session->userdata("user_id")) {
				echo "8000";
			} else {

				$result = $this->board_m->delete($table, $id);

				if ($result) {
					echo $id;
				} else {
					echo "2000";
				}
			}
		} else {
			echo "9000";
		}
	}

	/**
	 * url 중 key 값을 구분하여 값을 가져오도록
	 *
	 * @param Array $url : segment_explode 한 url 값
	 * @param String $key : 가져오려는 값의 key
	 * @return String $url[$k] : 리턴값
	 */
	function url_explode($url, $key) {
		$cnt = count($url);
		for ($i=0; $cnt> $i; $i++) {
			if ($url[$i] == $key) {
				$k = $i+1;
				return $url[$k];
			}
		}
	}

	/**
	 * HTTP의 URL을 "/" Delimeter로 사용하여 배열로 바꿔 리턴한다.
	 * @param string 대상이 되는 문자열
	 * @return string[]
	 */
	function segment_explode($seg) {
		$len = strlen($seg);
		if (substr($seg, 0,1) == '/') { //앞이 /인 경우 제외
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if (substr($seg, -1) == '/') {
			$seg = substr($seg, 0, $len-1); //끝이 /인 경우 제외
		}

		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}

}
