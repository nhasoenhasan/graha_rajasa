<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kasir extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('cart');
		$this->load->model('M_Kasir');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
    }
    
    public function getDiskon(){
        $data=$this->M_Kasir->getDiskon();
        if ($data) {
            echo json_encode(array("data"=>$data,"status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    
    public function cart(){
       
        $this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
            $qty=htmlspecialchars($this->input->post('qty',TRUE),ENT_QUOTES);
            $id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
			$price=htmlspecialchars($this->input->post('price',TRUE),ENT_QUOTES);
			$nama_barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);
			$nama_barang=htmlspecialchars($this->input->post('nama_barang',TRUE),ENT_QUOTES);

			$data = array(
                'id'      => $id_barang,
                'qty'     => $qty,
                'price'   => $price,
				'name'    => $nama_barang
            );

            $this->cart->insert($data);
			echo json_encode(array("total"=>$this->cart->total(),"status" => TRUE));
		}
    }
    
    //Get Data Chart
    public function getChart(){
		$data=$this->cart->contents();
        echo json_encode(array("total"=>$this->cart->total(),"data"=>(array)$data));
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
        echo json_encode(array("total"=>$this->cart->total(),'status'=>true));
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
        echo json_encode(array("total"=>$this->cart->total(),'status'=>true));
    }
    
    //Delete Chart Item By Row Id
	public function delChart(){
		$id=$this->input->post('row_id');

		$data = array(
            'rowid' => $id, 
            'qty' => 0, 
		);
		
        $this->cart->update($data);
        echo json_encode(array("total"=>$this->cart->total(),'status'=>true));
    }
    
    public function insertCart(){
		$Id=2;
		$invoice = 'TRSC-'.date('s').date('y').date('m').str_pad(3,'0',STR_PAD_LEFT);

		$transaction = array(
			'no_order' =>$invoice,
            'nama_user' => $this->session->userdata('username'),
            'diskon' => $this->input->post('diskonSend'),
            'total' => $this->input->post('totalSend')
		);

		//Insert Transaction
		if($id=$this->M_Kasir->addTransaction($transaction)){

			//Insert Detail Transaction
			$cart = $this->cart->contents();
			$cart_insert=[];

			foreach ($cart as $item){

				$detail_transaction=array(
					'id_penjualan' =>$id,
					'id_barang'=>$item['id'],
					'jumlah'=>$item['qty'],
					'harga'=> $item['price'],
					'subtotal'=> $item['subtotal'],
					'nama_barang'=> $item['name'],
				);
				array_push($cart_insert, $detail_transaction);
			}

			//Insert Detail Transaction
			if($this->M_Kasir->addDetailTransaction($cart_insert)){

                //Update Stock Barang
                foreach ($cart as $item) {
                    $this->M_Kasir->updateBarang($item['id'],$item['qty']);
                }

                //Destroy Cart
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