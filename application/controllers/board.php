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
		$this->load->model('board_m');
		$this->load->helper(array('alert','form','date','url'));
	}

	public function index()
	{
		$this->lists();
		// $this->load->view('upload_form', array('error' => ' ' ));
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
		$data['comment_list'] = $this->board_m->getCommentsList('comments', $this->uri->segment(5)); //게시판 이름, 게시물번호
		$this->load->view('view_v', $data);
	}

	public function write()
	{
		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";

		if ($this->session->userdata('logged_in') == TRUE) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', '제목', 'required');
			$this->form_validation->set_rules('contents', '내용', 'required');

			if ($this->form_validation->run() == TRUE) {

				//uri를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				if (in_array('page', $uri_array)) {
					$pages = urldecode($this->url_explode($uri_array, 'page'));

				} else {
					$pages = 1;
				}

				/*if (!$this->input->post('title', TRUE) AND !$this->input-post('contents', TRUE)) {
                    alert('비정상적인 접근입니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
                    exit;
                }*/

				//우선 게시글 저장
				$write_data = array(
					'user_id' => $this->session->userdata('user_id'),
					'user_name' => $this->session->userdata('user_name'),
					'title' => $this->input->post('title', TRUE),
					'contents' => $this->input->post('contents', TRUE),
					'table' => $this->uri->segment(3)
				);

				$bid = $this->board_m->insert($write_data);

				if (!$bid) {
					alert('다시 입력해주세요', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
					exit;
				}

				//파일이 없는 경우에도 배열이 생성되기 때문에 적합하지 않음. 파일이 있다면...
				//if ($_FILES) {
				if ($_FILES["userfile"]["name"] !='') {
//
//					foreach ($_FILES["userfile"] as $key => $value) {
//						echo "key==".$key." value==".$value."<br>";
//					}

					$config['upload_path'] = 'upload';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '10240';
					$config['max_width'] = '1024';
					$config['max_height'] = '768';
					$config['encrypt_name'] = TRUE;	//파일명암호화
					$config['remove_spaces'] = TRUE;	//공백제거

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload()){
						//업로드에 에러발생시 게시글 삭제
						$this->board_m->delete($this->uri->segment(3), $bid);
						$data['error'] = $this->upload->display_errors();
						$this->load->view('write_v', $data);
					} else {

						//썸네일 생성
						/*						$config['image_library'] = 'gd2';
                                                $config['source_image'] = $upload_data['full_path'];
                                                $config['create_thumb'] = TRUE;
                                                $config['width'] = 300;
                                                $config['height'] = 300;

                                                $this->load-library('image_lib', $config);
                                                $this->image_lib->resize();*/

						//파일업로드된 데이타
						$upload_data = $this->upload->data();

						$file_data = array(
							'bid' => $bid,
							'file_name' => $upload_data['file_name'],
							'file_type' => $upload_data['file_type'],
							'orig_name' => $upload_data['orig_name'],
							'file_ext' => $upload_data['file_ext'],
							'file_size' => $upload_data['file_size'],
							'image_width' => $upload_data['image_width'],
							'image_height' => $upload_data['image_height'],
							'image_type' => $upload_data['image_type'],
							'image_size_str' => $upload_data['image_size_str'],
							'thumb_name' => str_replace('.'.$upload_data['file_ext'], '' , $upload_data['orig_name']).'_thumbs.'.$upload_data['file_ext']
						);

						$result = $this->board_m->insert_image($file_data);

						if ($result) {
							//alert('입력되었습니다.', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
							redirect('board/lists/' . $this->uri->segment(3) . '/page/' . $pages); exit;
						} else {
							$this->board_m->delete($this->uri->segment(3), $bid);
							alert('다시 입력해주세요', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
							exit;
						}

					}

				} else {
					redirect('board/lists/' . $this->uri->segment(3) . '/page/' . $pages); exit;
				}
			} else {
				$this->load->view('write_v');
			}
		} else {
			alert('로그인이 필요합니다.', '/index.php/auth/login');
			exit;
		}

	}

	public function edit()
	{

		//uri를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if (in_array('page', $uri_array)) {
			$pages = urldecode($this->url_explode($uri_array, 'page'));

		} else {
			$pages = 1;
		}

		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";

		if ($this->session->userdata('logged_in') == TRUE) {

			//본인확인
			$writer_id = $this->board_m->writer_check($this->uri->segment(3), $this->uri->segment(5));

			if ($writer_id->user_id != $this->session->userdata("user_name")) {
				alert('자신의 글만 수정가능합니다.', '/index.php/board/lists/' . $this->uri->segment(3) . '/id/' . $this->uri->segment(5) . '/page/' . $pages);
				exit;
			}

			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', '제목', 'required');
			$this->form_validation->set_rules('contents', '내용', 'required');

			if ($this->form_validation->run() == TRUE) {

				if (!$this->input->post('title', TRUE) AND !$this->input - post('contents', TRUE)) {
					alert('비정상적인 접근입니다.', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
					exit;
				}

				$edit_data = array(
					'id' => $this->uri->segment(5),
					'user_id' => $this->session->userdata('user_id'),
					'user_name' => $this->session->userdata('user_name'),
					'title' => $this->input->post('title', TRUE),
					'contents' => $this->input->post('contents', TRUE),
					'table' => $this->uri->segment(3)
				);

				$result = $this->board_m->modify($edit_data);

				if ($result) {
					alert('입력되었습니다.', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
					exit;
				} else {
					alert('다시 입력해주세요', '/index.php/board/lists/' . $this->uri->segment(3) . '/page/' . $pages);
					exit;
				}
			} else {
				$data['views'] = $this->board_m->getView($this->uri->segment(3), $this->uri->segment(5)); //게시판 이름, 게시물번호
				$this->load->view('modify_v', $data);
			}
		} else {
			alert('로그인이 필요합니다.', '/index.php/auth/login');
			exit;
		}
	}

	public function delete() {

		//uri를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if (in_array('page', $uri_array)) {
			$pages = urldecode($this->url_explode($uri_array, 'page'));

		} else {
			$pages = 1;
		}

		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";

		if ($this->session->userdata('logged_in') == TRUE) {

			//본인확인
			$writer_id = $this->board_m->writer_check($this->uri->segment(3), $this->uri->segment(5));

			if ($writer_id->user_id != $this->session->userdata("user_id")) {
				alert('자신의 글만 삭제가능합니다.', '/index.php/board/lists/' . $this->uri->segment(3) . '/id/' . $this->uri->segment(5) . '/page/' . $pages);
				exit;
			}

			$result = $this->board_m->delete($this->uri->segment(3), $this->uri->segment(5));

			if ($result) {
				alert('삭제되었습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
				exit;
			} else {
				alert('삭제 실패했습니다.', '/index.php/board/lists/'.$this->uri->segment(3).'/id/'.$this->uri->segment(5).'/page/'.$pages);
				exit;
			}
		} else {
			alert('로그인이 필요합니다.', '/index.php/auth/login');
			exit;
		}

	}

/*	public function edit()
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

	}*/

/*	public function delete()
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
	}*/

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
