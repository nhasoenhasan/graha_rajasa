<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penjualan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Penjualan');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->data['title']='Admin Kasir';
		$this->data['menu'] = $this->load->view('menu/v_menu_kasir',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('kasir/v_kasir_penjualan');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Penjualan->getAll();
		echo json_encode($data);
	}
}