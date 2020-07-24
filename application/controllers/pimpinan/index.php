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
		$this->count['jumlah_barang']=$this->M_Barang->getCountBarang();
		$this->count['jumlah_suplier']=$this->M_Barang->getCountSuplier();
		$this->count['jumlah_barang_masuk']=$this->M_Barang->getCountBarangMasuk();
		$this->count['jumlah_order_barang']=$this->M_Barang->getOrderBarang();
		$this->count['jumlah_user']=$this->M_Barang->getCountUser();
		$this->count['jumlah_penjualan']=$this->M_Barang->getCountPenjualan();
		$this->count['jumlah_return']=$this->M_Barang->getCountReturn();
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('pimpinan/v_pimpinan_dashboard',$this->count);
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

	public function returnBarang(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
		$this->data['user']=$this->load->view('menu/v_formcetak_returnBarang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('kasir/v_kasir_return');
		$this->load->view('template/v_footer');
	}

	public function user(){
		$this->data['title']='Pimpinan';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('pimpinan/v_pimpinan_user');
		$this->load->view('template/v_footer');
	}

}