<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 게시판 메인 컨트롤러
 */
class FormVal extends CI_Controller {

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
	}

	public function index()
	{
		$this->forms();
	}

	public function  _remap($method) {
		$this->load->view('templates/header_v');

		if (method_exists($this, $method)) {
			$this->{"{$method}"}();
		}

		$this->load->view('templates/footer_v');
	}

	public function forms()
    {

        $this->output->enable_profiler(TRUE); //프로파일러호출
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_id', '아이디', 'callback_user_id');
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', '비밀번호확인', 'required');
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email');

		$this->form_validation->set_rules('count', '기본값', 'numeric');
		$this->form_validation->set_rules('myselect', '셀렉트값', '');
		$this->form_validation->set_rules('mycheck[]', '체크박스', '');
		$this->form_validation->set_rules('myradio', '라디오버튼', '');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('formVal/forms_v');
        } else {
        }
    }

    public function user_id($id) {

		$this->load->database();

		if ($id) {
			$result = array();
			$sql = "SELECT id FROM users WHERE user_id = '".$id."'";
			$query = $this->db->query($sql);
			$result = $query->row();
			
			if ($result) {
				$this->form_validation->set_message('user_id', $id.'은 중복된 아이디입니다.');
				return FALSE;
			}  else {
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}
}
