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

        $this->form_validation->set_rules('username', '아이디', 'required');
        $this->form_validation->set_rules('password', '비밀번호', 'required');
        $this->form_validation->set_rules('passconf', '비밀번호확인', 'required');
        $this->form_validation->set_rules('email', '이메일', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('formVal/forms_v');
        } else {
        }
    }
}
