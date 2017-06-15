<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 게시판 메인 컨트롤러
 */
class board extends CI_Controller {

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
		$this->load->database();
		$this->load->model('board_m');
	}

	public function index()
	{
		$this->lists();
	}

	public function  _remap($method) {
		$this->load->view('templates/header_v');

		if (method_exists($this, $method)) {
			$this->load->view('templates/board_header_v');
			$this->{"{$method}"}();
		}

		$this->load->view('templates/footer_v');
	}

	public function lists()
	{

		$this->output->enable_profiler(TRUE); //프로파일러호출
		$search_word = $page_url = '';
		$uri_segment = 5;

		//uri를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if (in_array('q', $uri_array)) {
			$search_workd = urldecode($this->url_explode($uri_array, 'q'));

			$page_url = '/q/'.$search_word;
			$uri_segment = 7;
		}


		$this->load->library('pagination');        //페이징라이브러리
		$config['base_url'] = '/index.php/board/lists/board/'.$page_url.'/page/'; //페이지주소
		$config['total_rows'] = $this->board_m->getList($this->uri->segment(3), 'count', '', '', $search_word); //총게시글수
		$config['per_page'] = 5; //페이지당 글 수
		$config['uri_segment'] = $uri_segment; //페이지 번호 위치 세그먼트

		//pagination 초기화
		$this->pagination->initialize($config);
		//page html 생성
		$data['pagination'] = $this->pagination->create_links();

		//db에서 데이타를 가져오기 위한 설정
		$page = $this->uri->segment($uri_segment, 1);    //default 1로 설정

		if ($page > 1) {
			$start = ($page / $config['per_page']) * $config['per_page'];
		} else {
			$start = ($page - 1) * $config['per_page'];
		}
		$limit = $config['per_page'];



		$data['list'] = $this->board_m->getList($this->uri->segment(3), '', $start, $limit, $search_word);

		/*foreach($data['list'] as $key => $value) {
			echo "key : ".$key. ", value : ". $value . "<br>";
		}*/

		$this->load->view('list_v', $data);

	}

	public function view() {
		$data['views'] = $this->board_m->getView($this->uri->segment(3), $this->uri->segment(5)); //게시판 이름, 게시물번호
		$this->load->view('view_v', $data);
	}

	public function write()
	{
		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";
		if ($_POST) {
			$this->load->helper('alert');

			//uri를 배열로 변환
			$uri_array = $this->segment_explode($this->uri->uri_string());

			if (in_array('page', $uri_array)) {
				$pages = urldecode($this->url_explode($uri_array, 'page'));

			} else {
				$pages = 1;
			}

			if (!$this->input->post('title', TRUE) AND !$this->input-post('contents', TRUE)) {
				alert('비정상적인 접근입니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			}

			$write_data = array(
				'title' => $this->input->post('title', TRUE),
				'contents' => $this->input->post('contents', TRUE),
				'table' => $this->uri->segment(3)
			);

			$result = $this->board_m->insert($write_data);

			if ($result) {
				alert('입력되었습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			} else {
				alert('다시 입력해주세요', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			}
		} else {
			$this->load->view('write_v');
		}

	}

	public function edit()
	{
		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";
		if ($_POST) {
			$this->load->helper('alert');

			//uri를 배열로 변환
			$uri_array = $this->segment_explode($this->uri->uri_string());

			if (in_array('page', $uri_array)) {
				$pages = urldecode($this->url_explode($uri_array, 'page'));

			} else {
				$pages = 1;
			}

			if (!$this->input->post('id', TRUE) AND !$this->input->post('title', TRUE) AND !$this->input-post('contents', TRUE)) {
				alert('비정상적인 접근입니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			}

			$modify_data = array(
				'title' => $this->input->post('title', TRUE),
				'contents' => $this->input->post('contents', TRUE),
				'table' => $this->uri->segment(3),
				'id' => $this->uri->segment(5)
			);

			$result = $this->board_m->modify($modify_data);

			if ($result) {
				alert('수정되었습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			} else {
				alert('다시 입력해주세요', '/index.php/board/lists/'.$this->uri->segment(3).'/id'.$this->uri->segment(5).'/page/'.$pages);
				exit;
			}
		} else {

			$data['views'] = $this->board_m->getView($this->uri->segment(3), $this->uri->segment(5)); //게시판 이름, 게시물번호
			$this->load->view('modify_v', $data);
		}

	}

	public function delete()
	{
		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";

		$this->load->helper('alert');

		//uri를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if (in_array('page', $uri_array)) {
			$pages = urldecode($this->url_explode($uri_array, 'page'));

		} else {
			$pages = 1;
		}

		$result = $this->board_m->delete($this->uri->segment(3), $this->uri->segment(5));

		if ($result) {
			alert('삭제되었습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
			exit;
		} else {
			alert('삭제 실패했습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/id/'.$this->uri->segment(5).'/page/'.$pages);
			exit;
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
