<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class detail_order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('cart');
		$this->load->model('M_Order');
		$this->load->model('M_Detail_Order');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	
	public function index()
	{
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_detail_order');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Order->getAll();
		echo json_encode($data);
    }
	
	//Get Data Chart
    public function getChart(){
		$data=$this->cart->contents();
        echo json_encode((array)$data);
    }

	//Add Chart Qty By Row Id
    public function addChart(){
		$id=$this->input->post('row_id');
		$qty=$this->input->post('qty');

		$data = array(
            'rowid' => $id, 
            'qty' => $qty+=1, 
		);
		
        $this->cart->update($data);
        echo json_encode(array('status'=>true));
	}
	
	//Sub Qty Chart By Row Id
	public function subChart(){
		$id=$this->input->post('row_id');
		$qty=$this->input->post('qty');

		$data = array(
            'rowid' => $id, 
            'qty' => $qty-=1, 
		);
		
        $this->cart->update($data);
        echo json_encode(array('status'=>true));
	}

	//Delete Chart Item By Row Id
	public function delChart(){
		$id=$this->input->post('row_id');

		$data = array(
            'rowid' => $id, 
            'qty' => 0, 
		);
		
        $this->cart->update($data);
        echo json_encode(array('status'=>true));
	}

	//Handle Check Chart Is Empty
	public function isChart(){
		if($this->cart->total_items()==0){
			echo json_encode(array("status" => FALSE));
		}else{
			$this->insertChart();
		}
	}

	//Delete Chart Item By Row Id
	public function insertChart(){
		$Id=2;
		$invoice = 'ORDER-'.date('s').date('y').date('m').str_pad(3,'0',STR_PAD_LEFT);

		$transaction = array(
			'no_struk' => $invoice,
			'nama_user' => $this->session->userdata('username'),
			'total' => $this->cart->total()
		);

		//Check Is Insert Transaction ?
		if($id=$this->M_Order->addTransaction($transaction)){

			//Insert Detail Transaction
			$cart = $this->cart->contents();
			$cart_insert=[];

			foreach ($cart as $item){

				$detail_transaction=array(
					'id_order_barang' =>$id,
					'id_barang'=>$item['id'],
					'id_supplier'=>$item['options']['id_supplier'],
					'jumlah'=> $item['qty'],
					'subtotal'=> $item['subtotal'],
					'status'=> 0,//0=menunggu, 1=acc, 2=di pesan 3=selesai
					'nama_barang'=>$item['name'],
					'nama_supplier'=>$item['options']['supplier'],
					'harga_jual'=>$item['options']['harga_jual'],
					'harga_beli'=>$item['options']['harga_beli']
				);
				array_push($cart_insert, $detail_transaction);
			}

			//Insert Detail Transaction
			if($this->M_Detail_Order->addTransaction($cart_insert)){
				$this->cart->destroy();
				echo json_encode(array("status" => TRUE));
			}else{
				echo json_encode(array("status" => FALSE));
			}
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

}