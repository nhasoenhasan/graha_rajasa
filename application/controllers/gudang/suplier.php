<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class suplier extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Suplier');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_suplier');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Suplier->getAll();
		echo json_encode($data);
	}

	public function post(){
		$id=htmlspecialchars($this->input->post('id_supplier',TRUE),ENT_QUOTES);
		
		if($id==''){
			$this->add();
		}else{
			$this->update();
		}
	}

	public function add(){
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
			$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
			$alamat=htmlspecialchars($this->input->post('alamat',TRUE),ENT_QUOTES);
			$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
			$telp=htmlspecialchars($this->input->post('telp',TRUE),ENT_QUOTES);

			$data = array(
				'nama' => $nama,
				'alamat' => $nama,
				'email' => $email,
				'no_telp' => $telp,
			);

			if($this->M_Suplier->add($data)){
				echo json_encode(array("status" => TRUE));
			}else{
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	public function update(){
		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telp', 'telp', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
			$id=htmlspecialchars($this->input->post('id_supplier',TRUE),ENT_QUOTES);
			$nama=htmlspecialchars($this->input->post('nama',TRUE),ENT_QUOTES);
			$alamat=htmlspecialchars($this->input->post('alamat',TRUE),ENT_QUOTES);
			$email=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
			$telp=htmlspecialchars($this->input->post('telp',TRUE),ENT_QUOTES);

			$data = array(
				'id_supplier' => $id,
				'nama' => $nama,
				'alamat' => $alamat,
				'email' => $email,
				'no_telp' => $telp,
			);

			if($this->M_Suplier->update($data, $id)){
				echo json_encode(array("status" => TRUE));
			}else{
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	
	public function delete(){
		$this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');
		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$id_supplier=htmlspecialchars($this->input->post('id_supplier',TRUE),ENT_QUOTES);
			$insert = $this->M_Suplier->delete($id_supplier);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function cetak(){
		$value['data']=$this->M_Suplier->getCetak();
		$this->load->view('surat/v_cetak_supplier',$value);
	}
}