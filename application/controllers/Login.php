<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
		$this->load->model('M_User');
    }

	public function index()
	{
		$this->load->view('v_login');
    }

    public function auth(){
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => $password
		);
        $user=$this->M_User->auth($data);

		if(!empty($user)){
	 		$begin = date('d-m-Y');
          	$end = date('Y-m-d', strtotime('+1 weeks'));
			$data_session = array(
				'id_user' => $user->id_user,
				'username' => $user->username,
				'level' => $user->level,
				'tgl_sekarang' => $begin,
				'tgl_batas' => $end ,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url( "index.php/".$user->level."/index"));
		}else{
            $this->session->set_flashdata('message','Password/Username Salah!!'); 
			redirect(base_url());
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
    


}