<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class return_barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Return');
		$this->load->model('M_Setting');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->data['title']='Admin Kasir';
		$this->data['menu'] = $this->load->view('menu/v_menu_kasir',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('kasir/v_kasir_return');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Return->getAll();
		echo json_encode($data);
	}

	public function getByNota()
	{
		$no_nota=$_GET['no_nota'];
		$data=$this->M_Return->getByNota($no_nota);
		echo json_encode($data);
	}

	public function getCetak(){
		$no_nota=$this->input->post('no_nota',TRUE);

		if ($no_nota=='') {
			echo 'Masukan No Nota!!';
		}else{
			$value['data']=$this->M_Return->getByNotaCetak($no_nota);

			if (count($value['data'])==0) {
				echo "No Order Tidak Di Temukan!";
			}else{
				$value['cetak']=$this->M_Setting->getCetak();
				$this->load->view('surat/v_cetak_nota_return',$value);
			}
		}
	}

	public function searchNota(){
		$no_order=$this->input->post('no_nota',TRUE);

		if ($data=$this->M_Return->findNota($no_order)) {
			echo json_encode(array("data"=>$data,"status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	//Update status In Penjualan To Return
	public function updatePenjualan(){
		$post=$this->input->post('suplier',TRUE);

		$post=explode( '|', $post);

		$no_order=$post[0];
		$subtotal=$post[1];
		$id_penjualan=$post[2];

		$keterangan=$this->input->post('keterangan',TRUE);

		//Update Status Order Menjadi Return
		if ($data=$this->M_Return->update($no_order,$keterangan)) {

			//Reduce Total 
			$this->M_Return->updateBarangMasuk($subtotal,$id_penjualan);

			echo json_encode(array("status" => TRUE));

		}else{
			echo json_encode(array("status" => FALSE));
		}
	}


}