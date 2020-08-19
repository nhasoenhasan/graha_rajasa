<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_Home extends CI_Controller {
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
		$this->count['jumlah_barang']=$this->M_Barang->getCountBarang();
		$this->count['jumlah_suplier']=$this->M_Barang->getCountSuplier();
		$this->count['jumlah_barang_masuk']=$this->M_Barang->getCountBarangMasuk();
		$this->count['jumlah_order_barang']=$this->M_Barang->getOrderBarang();
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_dashboard',$this->count);
		$this->load->view('template/v_footer');
	}
}