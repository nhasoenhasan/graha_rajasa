<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan_acc_order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Order');
		$this->load->model('M_Setting');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	
	public function index()
	{
		$this->data['title']='Pimpinan';
		$this->data['user']=$this->load->view('menu/v_formcetak_accOrder',$this->data,TRUE);
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('pimpinan/v_pimpinan_acc_order');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
        $status=$_GET['status'];
		$id_supplier=$_GET['id_supplier'];
		if ($id_supplier!='') {
			$data=$this->M_Order->getAllArray($status,$id_supplier);
			echo json_encode($data);
		}else{
			$data=$this->M_Order->getAll(0,$id_supplier);
			echo json_encode($data);
		}
    }
    
	public function update(){

		$this->form_validation->set_rules('data', 'data', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$data=htmlspecialchars($this->input->post('data',TRUE),ENT_QUOTES);

			$insert = $this->M_Order->aproveOrder($data);

			echo json_encode(array("status" => TRUE));
		}
	}

	public function delete(){
		$this->form_validation->set_rules('id_det_order_brg', 'id_det_order_brg', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$order=htmlspecialchars($this->input->post('id_det_order_brg',TRUE),ENT_QUOTES);

			$insert = $this->M_Order->delete($order);

			echo json_encode(array("status" => TRUE));
		}
	}

	public function cetak(){
		$data=$this->input->post('no_order',TRUE);
		if($data!=NULL){
			$v=$this->M_Order->getSupplierNama($data);
			$value['supplier']=$v[0]['nama'];
			$value['total']=$this->M_Order->getTotal(3,$data);
			$value['data']=$this->M_Order->getAllArray(3,$data);
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_surat',$value);
		}else{
			echo "Silahkan Pilih Supplier";
		}
	}

	public function cetakByDate(){
		$startDate=strtotime($this->input->post('startDate'));
		$endDate=strtotime($this->input->post('endDate'));

		if ($startDate == FALSE || $endDate == FALSE ){
			
			echo "<h1>Masukan Range Tanggal!!</h1>";
			
		}else{
			$startDate = date('Y-m-d',$startDate);
			$endDate = date('Y-m-d',$endDate);
			
			$result=$this->M_Order->getByDate($startDate,$endDate);

			$total=0;
			//Total
			if (count($result)!=0) {
				
				$temp=[];
				foreach ($result as $key => $value) {

					array_push($temp, (int)$value['harga_beli']);
					
				}

				$total=array_sum($temp);
			}
			
			$value['startDate']=date('d-m-Y',strtotime($this->input->post('startDate')));
			$value['endDate']=date('d-m-Y',strtotime($this->input->post('endDate')));
			$value['total']=$total;
			$value['data']=$result;
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_cetak_orderacc_bydate',$value);
		}
	}

	public function getByDate()
	{
		$start=strtotime($_GET['startDate']);
		$end=strtotime($_GET['endDate']);

		$start = date('Y-m-d',$start);
		$end = date('Y-m-d',$end);
		
		$data=$this->M_Order->getByDateJson($start,$end);
		echo json_encode($data);
	}
	
}