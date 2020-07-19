<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class acc_order extends CI_Controller {
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
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_acc_order');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
        $status=$_GET['status'];
		$id_supplier=$_GET['id_supplier'];
		if ($id_supplier!='') {
			$data=$this->M_Order->getAllArray(2,$id_supplier);
			echo json_encode($data);
		}else{
			$data=$this->M_Order->getAll($status,$id_supplier);
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

			$insert = $this->M_Order->updateAccOrder($data);

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
		$data=$this->input->post('supplier',TRUE);
		if($data!=NULL){
			$v=$this->M_Order->getSupplierNama($data);
			$value['supplier']=$v[0]['nama'];
			$value['total']=$this->M_Order->getTotal($data);
			$value['data']=$this->M_Order->getAllArray(2,$data);
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_surat',$value);
		}else{
			echo "Silahkan Pilih Supplier";
		}
	}

	
}