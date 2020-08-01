<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penjualan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Penjualan');
		$this->load->model('M_Setting');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->data['title']='Admin Kasir';
		$this->data['user']='';
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

	public function getByDate()
	{
		$start=strtotime($_GET['startDate']);
		$end=strtotime($_GET['endDate']);

		$start = date('Y-m-d',$start);
		$end = date('Y-m-d',$end);
		
		$data=$this->M_Penjualan->getByDateJson($start,$end);
		echo json_encode($data);
	}

	public function cetakPenjualan(){
		$startDate=strtotime($this->input->post('startDate'));
		$endDate=strtotime($this->input->post('endDate'));

		if ($startDate == FALSE || $endDate == FALSE ){
			
			echo "<h1>Masukan Range Tanggal!!</h1>";
			
		}else{
			$startDate = date('Y-m-d',$startDate);
			$endDate = date('Y-m-d',$endDate);
			
			$result=$this->M_Penjualan->getByDate($startDate,$endDate);

			$total=0;
			//Total
			if (count($result)!=0) {
				
				$temp=[];
				foreach ($result as $key => $value) {

					array_push($temp, (int)$value['subtotal']);
					
				}

				$total=array_sum($temp);
			}
			
			$value['startDate']=date('d-m-Y',strtotime($this->input->post('startDate')));
			$value['endDate']=date('d-m-Y',strtotime($this->input->post('endDate')));
			$value['data']=$result;
			$value['total']=$total;
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_cetak_penjualan',$value);
		}
	}

}