<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setting extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Setting');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	
	public function index()
	{
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_pimpinan',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_setting_cetak');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Setting->getAll();
		echo json_encode($data);
	}

	public function update(){

		$id_setting_cetak=htmlspecialchars($this->input->post('id_setting_cetak',TRUE),ENT_QUOTES);
		$tdd_pimpinan=htmlspecialchars($this->input->post('tdd_pimpinan',TRUE),ENT_QUOTES);
		$nama_perusahaan=htmlspecialchars($this->input->post('nama_perusahaan',TRUE),ENT_QUOTES);
		$alamat=htmlspecialchars($this->input->post('alamat',TRUE),ENT_QUOTES);
		$tag_line=htmlspecialchars($this->input->post('tag_line',TRUE),ENT_QUOTES);
		$tdd_gudang=htmlspecialchars($this->input->post('tdd_gudang',TRUE),ENT_QUOTES);
		$mengetahui=htmlspecialchars($this->input->post('mengetahui',TRUE),ENT_QUOTES);
	
		$data = array(
			'nama_perusahaan' => $nama_perusahaan,
			'alamat' => $alamat,
			'tag_line' => $tag_line,
			'tdd_gudang' => $tdd_gudang,
			'tdd_pimpinan' => $tdd_pimpinan,
			'mengetahui' => $mengetahui,
		);

		if($this->M_Setting->updateSetting($data,$id_setting_cetak)){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function post(){
		$this->form_validation->set_rules('id_setting_cetak', 'id_setting_cetak', 'required');
		$this->form_validation->set_rules('tdd_pimpinan', 'tdd_pimpinan', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama_perusahaan', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('tag_line', 'tag_line', 'required');
		$this->form_validation->set_rules('tdd_gudang', 'tdd_gudang', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$this->update();
		}
	}

}