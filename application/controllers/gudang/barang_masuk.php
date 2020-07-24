<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_masuk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Barang_Masuk');
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
		$this->data['user']=' <div class="btn-toolbar mb-2 mb-md-0">
		<button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
		</div>';
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_barang_masuk');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Barang_Masuk->getAll();
		echo json_encode($data);
	}

	public function getOrder()
	{
		$status=$_GET['status'];
		$data=$this->M_Order->getOrder($status);
		echo json_encode($data);
	}


	//Handle Cek Apakah Harga Berbeda
	public function cekAverage($id,$stock,$beli){
		$data=$this->M_Barang_Masuk->checkAverage($id);

		$old_beli=$data[0]['harga_beli'];
		$old_stok=$data[0]['stok'];

		//Compare
		if($beli==$old_beli){
			return $beli;
		}else{
			//Count Average
			$total=($old_stok*$old_beli)+$stock*$beli;
			$average=$total/($stock+$old_stok);

			return round($average,3);
		}
	}

	public function post(){


		$this->form_validation->set_rules('no_struk', 'no_struk', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('id_det_order_brg', 'id_det_order_brg', 'required');
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
		$this->form_validation->set_rules('nama_supplier', 'nama_supplier', 'required');
		$this->form_validation->set_rules('suplier', 'suplier', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		$this->form_validation->set_rules('beli', 'beli', 'required');
		$this->form_validation->set_rules('jual', 'jual', 'required');
		$id=htmlspecialchars($this->input->post('no_struk',TRUE),ENT_QUOTES);

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{
			$data=$this->M_Barang_Masuk->checkStruk($id);
			if($data){
				//Insert New Detail Barang Masuk
				$this->addDetBarangMasuk();
			}else{
				//Insert New Barang Masuk & Detail
				$this->addBarangMasuk();
			}
		}
	}

	//Add Barang Masuk
	public function addBarangMasuk(){
		// var_dump($_POST);
		// die();
		$no_struk=htmlspecialchars($this->input->post('no_struk',TRUE),ENT_QUOTES);
		$id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
		$id_det_order_brg=htmlspecialchars($this->input->post('id_det_order_brg',TRUE),ENT_QUOTES);
		$barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);
		$nama_supplier=htmlspecialchars($this->input->post('nama_supplier',TRUE),ENT_QUOTES);
		$id_suplier=htmlspecialchars($this->input->post('suplier',TRUE),ENT_QUOTES);
		$jumlah=htmlspecialchars($this->input->post('jumlah',TRUE),ENT_QUOTES);
		$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
		$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);

		//Check is Need Average?
		$beli=$this->cekAverage($id_barang,$jumlah,$beli);
		// echo '=='.$beli;
		// die();
		
		$data = array(
			'no_struk' => $no_struk,
			'nama_user' => $this->session->userdata('username'),
			'nama_supplier' => $nama_supplier,
			'total' => $beli*$jumlah
		);

		if($id_insert=$this->M_Barang_Masuk->addBarangMasuk($data)){
			//Data Insert
			$detail_data=array(
				'id_barang_masuk' =>$id_insert,
				'jumlah' =>$jumlah,
				'harga_beli' =>$beli,
				'harga_jual' =>$jual,
				'nama_barang' =>$barang,
				'subtotal' =>$beli*$jumlah,
				'id_barang' =>$id_barang,
				'id_supplier' =>$id_suplier
			);

			//Check Insert
			if ($this->M_Barang_Masuk->addDetBarangMasuk($detail_data)) {

				//Update Tabel Barang Masuk
				if($this->M_Barang_Masuk->updateBarang($jumlah,$beli,$jual,$id_suplier,$barang,$id_barang)){
					
					//Update Detail Order
					if ($cek=$this->M_Barang_Masuk->updateDetOrder($id_det_order_brg)) {
						 
						echo json_encode(array("status" => TRUE));
					}else{
						echo json_encode(array("status" => FALSE));
					}
					
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}else{
				echo json_encode(array("status" => FALSE));
			}

		}else{
			echo json_encode(array("status" => FALSE));
		}
	}


	//Add Barang Masuk
	public function addDetBarangMasuk(){
		
		$id_barang_masuk=htmlspecialchars($this->input->post('id_barang_masuk',TRUE),ENT_QUOTES);
		$no_struk=htmlspecialchars($this->input->post('no_struk',TRUE),ENT_QUOTES);
		$id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
		$id_det_order_brg=htmlspecialchars($this->input->post('id_det_order_brg',TRUE),ENT_QUOTES);
		$barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);
		$nama_supplier=htmlspecialchars($this->input->post('nama_supplier',TRUE),ENT_QUOTES);
		$id_suplier=htmlspecialchars($this->input->post('suplier',TRUE),ENT_QUOTES);
		$jumlah=htmlspecialchars($this->input->post('jumlah',TRUE),ENT_QUOTES);
		$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
		$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);
		
		$sub_total=$beli*$jumlah;
		//Update Total Barang Masuk
		if($id_insert=$this->M_Barang_Masuk->updateBarangMasuk($sub_total,$no_struk)){

			//Change Array To String
			$id_insert=$id_insert[0]['id_barang_masuk'];

			//Data Insert Detail Barang Masuk
			$detail_data=array(
				'id_barang_masuk' =>$id_insert,
				'jumlah' =>$jumlah,
				'harga_beli' =>$beli,
				'harga_jual' =>$jual,
				'nama_barang' =>$barang,
				'subtotal' =>$beli*$jumlah,
				'id_barang' =>$id_barang,
				'id_supplier' =>$id_suplier
			);

			//Insert Detail Barang Masuk
			if ($this->M_Barang_Masuk->addDetBarangMasuk($detail_data)) {

				//Update Tabel Barang Masuk
				if($this->M_Barang_Masuk->updateBarang($jumlah,$beli,$jual,$id_suplier,$barang,$id_barang)){
					
					//Update Detail Order
					if ($cek=$this->M_Barang_Masuk->updateDetOrder($id_det_order_brg)) {
						 
						echo json_encode(array("status" => TRUE));
					}else{
						echo json_encode(array("status" => FALSE));
					}
					
				}else{
					echo json_encode(array("status" => FALSE));
				}
			}else{
				echo json_encode(array("status" => FALSE));
			}

		}else{
			echo json_encode(array("status" => FALSE));
		}
	}


	//Handle Update Barang Masuk
	public function updateDetBarangMasuk(){
		$this->form_validation->set_rules('old_harga_beli', 'old_harga_beli', 'required');
		$this->form_validation->set_rules('old_jumlah', 'old_jumlah', 'required');

		$this->form_validation->set_rules('id_det_barang_masuk', 'id_det_barang_masuk', 'required');
		$this->form_validation->set_rules('id_barang_masuk', 'id_barang_masuk', 'required');
		$this->form_validation->set_rules('id_det_order_brg', 'id_det_order_brg', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
		$this->form_validation->set_rules('nama_supplier', 'nama_supplier', 'required');
		$this->form_validation->set_rules('no_struk', 'no_struk', 'required');
		$this->form_validation->set_rules('barang_edit', 'barang_edit', 'required');
		$this->form_validation->set_rules('suplier_edit', 'suplier_edit', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		$this->form_validation->set_rules('beli', 'beli', 'required');
		$this->form_validation->set_rules('jual', 'jual', 'required');

		//Check Validation
		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else{

			$old_harga_beli=htmlspecialchars($this->input->post('old_harga_beli',TRUE),ENT_QUOTES);
			$old_jumlah=htmlspecialchars($this->input->post('old_jumlah',TRUE),ENT_QUOTES);
			
			$id_det_barang_masuk=htmlspecialchars($this->input->post('id_det_barang_masuk',TRUE),ENT_QUOTES);
			$id_barang_masuk=htmlspecialchars($this->input->post('id_barang_masuk',TRUE),ENT_QUOTES);
			$id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
			$id_det_order_brg=htmlspecialchars($this->input->post('id_det_order_brg',TRUE),ENT_QUOTES);
			$barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);
			$nama_supplier=htmlspecialchars($this->input->post('nama_supplier',TRUE),ENT_QUOTES);
			$no_struk=htmlspecialchars($this->input->post('no_struk',TRUE),ENT_QUOTES);
			$id_suplier=htmlspecialchars($this->input->post('suplier_edit',TRUE),ENT_QUOTES);
			$jumlah=htmlspecialchars($this->input->post('jumlah',TRUE),ENT_QUOTES);
			$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
			$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);
			
			$sub_total=$beli*$jumlah;
			$old_sub_total=$old_harga_beli*$old_jumlah;
			//Update Total Barang Masuk
			if($id_insert=$this->M_Barang_Masuk->updateTotBarangMasuk($old_sub_total,$sub_total,$no_struk)){

				//Change Array To String
				$id_insert=$id_insert[0]['id_barang_masuk'];

				//Data Insert Detail Barang Masuk
				$detail_data=array(
					'id_barang_masuk' =>$id_insert,
					'jumlah' =>$jumlah,
					'harga_beli' =>$beli,
					'harga_jual' =>$jual,
					'nama_barang' =>$barang,
					'subtotal' =>$beli*$jumlah,
					'id_barang' =>$id_barang,
					'id_supplier' =>$id_suplier
				);

				//Insert Detail Barang Masuk
				if ($this->M_Barang_Masuk->updateDetBarangMasuk($detail_data,$id_det_barang_masuk)) {

					//Update Stock Tabel Barang Masuk
					if($this->M_Barang_Masuk->updateBarang2($old_jumlah,$jumlah,$beli,$jual,$id_suplier,$barang,$id_barang)){
						
						echo json_encode(array("status" => TRUE));
						
					}else{
						echo json_encode(array("status" => FALSE));
					}
				}else{
					echo json_encode(array("status" => FALSE));
				}

			}else{
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	public function getByDate()
	{
		$start=strtotime($_GET['startDate']);
		$end=strtotime($_GET['endDate']);

		$start = date('Y-m-d',$start);
		$end = date('Y-m-d',$end);

		$data=$this->M_Barang_Masuk->getByDateJson($start,$end);
		echo json_encode($data);
	}

	public function cetakBarangMasuk(){
		$startDate=strtotime($this->input->post('startDate'));
		$endDate=strtotime($this->input->post('endDate'));

		if ($startDate == FALSE || $endDate == FALSE ){
			
			echo "<h1>Masukan Range Tanggal!!</h1>";
			
		}else{
			$startDate = date('Y-m-d',$startDate);
			$endDate = date('Y-m-d',$endDate);
			
			$result=$this->M_Barang_Masuk->getByDate($startDate,$endDate);
			
			$value['startDate']=date('d/m/Y',strtotime($this->input->post('startDate')));
			$value['endDate']=date('d/m/Y',strtotime($this->input->post('endDate')));
			$value['data']=$result;
			$value['cetak']=$this->M_Setting->getCetak();
			$this->load->view('surat/v_cetak_barangMasuk',$value);
		}
	}

}