<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->data['title']='Admin Gudang';
		// $this->data['c'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('dashboard/v_dashboard');
		$this->load->view('template/v_footer');
	}
}