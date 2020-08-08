<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Barang');
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
		$this->load->view('gudang/v_gudang_barang');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Barang->getAll();
		echo json_encode($data);
	}

	public function isSame($nama){
		//Check Nama Barang Sama?
		$barang=htmlspecialchars($this->input->post('barang',TRUE),ENT_QUOTES);
		$same=$this->M_Barang->isSameName($barang);

		if (count($same)==0) {
			//Nama Barang Belum Ada
			return TRUE;
		}else{
			//Nama Barang Sudah Ada
			return FALSE;
		}
	}

	public function post(){
		$id=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
		
		if($id==''){
			$this->add();
		}else{
			$this->update();
		}
	}

	public function add(){
		$this->form_validation->set_rules('barang', 'barang', 'required');
		$this->form_validation->set_rules('suplier', 'suplier', 'required');
		$this->form_validation->set_rules('stok', 'stok', 'required');
		$this->form_validation->set_rules('beli', 'beli', 'required');
		$this->form_validation->set_rules('jual', 'jual', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
			$barang=htmlspecialchars($this->input->post('barang',TRUE),ENT_QUOTES);

			if ($this->isSame($barang)==FALSE) {
				echo json_encode(array("message"=>'exist',"status" => FALSE));
			}else{
				$suplier=htmlspecialchars($this->input->post('suplier',TRUE),ENT_QUOTES);
				$stok=htmlspecialchars($this->input->post('stok',TRUE),ENT_QUOTES);
				$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
				$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);
				$deskripsi=htmlspecialchars($this->input->post('deskripsi',TRUE),ENT_QUOTES);

				$data_barang = array(
					'id_supplier' => $suplier,
					'nama_barang' => $barang,
					'stok' => $stok,
					// 'stok_terjual' => $stok,
					'harga_beli' => $beli,
					'harga_jual' => $jual,
					'deskripsi' => $deskripsi,
				);

				if($this->M_Barang->addBarang($data_barang)){
					echo json_encode(array("status" => TRUE));
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}

		}
	}

	public function update(){
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('suplier', 'suplier', 'required');
		$this->form_validation->set_rules('barang', 'barang', 'required');
		$this->form_validation->set_rules('stok', 'stok', 'required');
		$this->form_validation->set_rules('beli', 'beli', 'required');
		$this->form_validation->set_rules('jual', 'jual', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("tes"=>$data,"status" => FALSE));
		}else{
			$barang=htmlspecialchars($this->input->post('barang',TRUE),ENT_QUOTES);
			$nama_barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);
			$id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
			$suplier=htmlspecialchars($this->input->post('suplier',TRUE),ENT_QUOTES);
			$stok=htmlspecialchars($this->input->post('stok',TRUE),ENT_QUOTES);
			$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
			$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);
			$deskripsi=htmlspecialchars($this->input->post('deskripsi',TRUE),ENT_QUOTES);
			
			if ($nama_barang!=$barang) {
				if ($this->isSame($barang)==FALSE) {
					echo json_encode(array("message"=>'exist',"status" => FALSE));
				}else{
		
					$data_barang = array(
						'id_barang'=>$id_barang,
						'id_supplier' => $suplier,
						'nama_barang' => $barang,
						'stok' => $stok,
						// 'stok_terjual' => $stok,
						// 'stok_sisa' => $stok,
						'harga_beli' => $beli,
						'harga_jual' => $jual,
						'deskripsi' => $deskripsi,
					);
		
					if($this->M_Barang->updateBarang($data_barang,$id_barang)){
						echo json_encode(array("status" => TRUE));
					}else{
						echo json_encode(array("status" => FALSE));
					}
				}
			}else{
				$data_barang = array(
					'id_barang'=>$id_barang,
					'id_supplier' => $suplier,
					'nama_barang' => $barang,
					'stok' => $stok,
					// 'stok_terjual' => $stok,
					// 'stok_sisa' => $stok,
					'harga_beli' => $beli,
					'harga_jual' => $jual,
					'deskripsi' => $deskripsi,
				);
	
				if($this->M_Barang->updateBarang($data_barang,$id_barang)){
					echo json_encode(array("status" => TRUE));
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}
		}
	}

	public function delete(){

		$this->form_validation->set_rules('id_barang', 'barang', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);

			$insert = $this->M_Barang->delete($barang);

			echo json_encode(array("status" => TRUE));
		}
	}

	public function cetak(){
		$startDate=strtotime($this->input->post('startDate'));
		$endDate=strtotime($this->input->post('endDate'));

		if ($startDate == FALSE || $endDate == FALSE ){
			
			echo "<h1>Masukan Range Tanggal!!</h1>";
			
		}else{
			$startDate = date('Y-m-d',$startDate);
			$endDate = date('Y-m-d',$endDate);
			
			// $result=$this->M_Penjualan->getByDate($startDate,$endDate);
			$value['data']=$this->M_Barang->getByDate($startDate,$endDate);
			
			$value['startDate']=date('d-m-Y',strtotime($this->input->post('startDate')));
			$value['endDate']=date('d-m-Y',strtotime($this->input->post('endDate')));
			// $value['data']=$result;
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_cetak_barang',$value);
		}
	}

	public function getByDate()
	{
		$start=strtotime($_GET['startDate']);
		$end=strtotime($_GET['endDate']);

		$start = date('Y-m-d',$start);
		$end = date('Y-m-d',$end);
		
		$data=$this->M_Barang->getByDateJson($start,$end);
		echo json_encode($data);
	}
	
}