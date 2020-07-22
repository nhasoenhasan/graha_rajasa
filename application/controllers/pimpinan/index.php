<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Barang');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('pimpinan/v_pimpinan_dashboard');
		$this->load->view('template/v_footer');
	}

	public function barang(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_barang');
		$this->load->view('template/v_footer');
	}

	public function suplier(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_suplier');
		$this->load->view('template/v_footer');
	}

	public function penjualan(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
		$this->data['user']=$this->load->view('menu/v_formcetak_penjualan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('kasir/v_kasir_penjualan');
		$this->load->view('template/v_footer');
	}

	public function barangMasuk(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
		$this->data['user']=$this->load->view('menu/v_formcetak_barangMasuk',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_barang_masuk');
		$this->load->view('template/v_footer');
	}

}