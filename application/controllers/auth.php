<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 게시판 메인 컨트롤러
 */
class Auth extends CI_Controller {

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
		$this->load->model('auth_m');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->login();
	}

	public function  _remap($method) {
		$this->load->view('templates/header_v');

		if (method_exists($this, $method)) {
			$this->{"{$method}"}();
		}

		$this->load->view('templates/footer_v');
	}

	public function login()
    {

        //$this->output->enable_profiler(TRUE); //프로파일러호출
        $this->load->library('form_validation');
		$this->load->helper('alert');

		$this->form_validation->set_rules('user_id', '아이디', 'required');
        $this->form_validation->set_rules('password', '비밀번호', 'required');

		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";

        if ($this->form_validation->run() == TRUE) {

        	$auth_data = array ('user_id' => $this->input->post('user_id'),
        						 'password' => $this->input->post('password')
			);
        	$result = $this->auth_m->login($auth_data);

        	if ($result) {
        		$newdata = array (
					'user_id' => $result->user_id,
					'user_name' => $result->user_name,
					'email' => $result->email,
					'logged_in' => TRUE
				);

				/*foreach($newdata as $x => $x_value) {
					echo "Key=" . $x . ", Value=" . $x_value;
					echo "<br>";
				}*/
				$this->session->set_userdata($newdata);
				alert('로그인되었습니다.', '/index.php/board/lists/board/page/1');
				exit;
			} else {
				alert('존재하지 않는 계정입니다. 비밀번호와 아이디를 확인해주세요', '/index.php/auth/login');
			}
        } else {
			//alert('로그인되었습니다.', '/index.php/board/lists/board/page/1');
			$this->load->view('login/login_v');
        }
    }

    public function logout() {

		$this->load->helper('alert');
		$this->session->sess_destroy();

		echo "<meta http-equiv=\"content type\" content=\"text/html;charset=utf-8\">";
		alert('로그아웃되었습니다.', '/index.php/board/lists/board/page/1');
		exit;
	}
}
