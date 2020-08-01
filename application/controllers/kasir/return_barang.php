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
		$this->data['user']='';
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

	public function getCetak(){
		$no_nota=$this->input->post('search_nota',TRUE);


		if ($no_nota=='') {
			echo 'Masukan No Nota!!';
		}else{
			$result=$this->M_Return->getByNotaCetak($no_nota);

			if (count($result)==0) {
				echo "No Order Tidak Di Temukan!";
			}else{


				$total=0;
				//Total
				if (count($result)!=0) {
					
					$temp=[];
					foreach ($result as $key => $value) {

						array_push($temp, (int)$value['subtotal']);
						
					}

					$total=array_sum($temp);
				}

				$value['total']=$total;
				$value['data']=$result;
				$value['cetak']=$this->M_Setting->getCetak();
				$this->load->view('surat/v_cetak_nota_return',$value);
			}
		}
	}

	public function getCetakByDate(){
		$startDate=strtotime($this->input->post('startDate'));
		$endDate=strtotime($this->input->post('endDate'));

		if ($startDate == FALSE || $endDate == FALSE ){
			
			echo "<h1>Masukan Range Tanggal!!</h1>";
			
		}else{
			$startDate = date('Y-m-d',$startDate);
			$endDate = date('Y-m-d',$endDate);
			
			// $result=$this->M_Penjualan->getByDate($startDate,$endDate);
			$result=$this->M_Return->getByDate($startDate,$endDate);

			$total=0;
			//Total
			if (count($result)!=0) {
				
				$temp=[];
				foreach ($result as $key => $value) {

					array_push($temp, (int)$value['subtotal']);
					
				}

				$total=array_sum($temp);
			}
			
			$value['total']=$total;
			$value['data']=$result;
			$value['startDate']=date('d-m-Y',strtotime($this->input->post('startDate')));
			$value['endDate']=date('d-m-Y',strtotime($this->input->post('endDate')));
			// $value['data']=$result;
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_cetak_return_periode',$value);
		}
	}

	public function getByDate()
	{
		$start=strtotime($_GET['startDate']);
		$end=strtotime($_GET['endDate']);

		$start = date('Y-m-d',$start);
		$end = date('Y-m-d',$end);
		
		$data=$this->M_Return->getByDateJson($start,$end);
		echo json_encode($data);
	}




}