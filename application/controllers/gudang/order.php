<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('cart');
		$this->load->model('M_Order');
		if(empty($this->session->userdata('username'))){
			redirect(base_url());
		}
	}
	
	public function index()
	{
		$this->data['title']='Admin Gudang';
		$this->data['menu'] = $this->load->view('menu/v_menu_gudang',$this->data,TRUE);
        $this->load->view('template/v_header',$this->data);
		$this->load->view('gudang/v_gudang_order');
		$this->load->view('template/v_footer');
	}

	public function get()
	{
		$data=$this->M_Order->getAll();
		echo json_encode($data);
    }
    
    public function cart(){
        $this->form_validation->set_rules('id_barang', 'id_barang', 'required');
		$this->form_validation->set_rules('barang', 'barang', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('beli', 'beli', 'required');
		$this->form_validation->set_rules('jual', 'jual', 'required');
		$this->form_validation->set_rules('suplier', 'suplier', 'required');

		if ($this->form_validation->run() == FALSE)
		{	
			echo json_encode(array("status" => FALSE));
		}else
		{
            $id_barang=htmlspecialchars($this->input->post('id_barang',TRUE),ENT_QUOTES);
            $qty=htmlspecialchars($this->input->post('qty',TRUE),ENT_QUOTES);
			$beli=htmlspecialchars($this->input->post('beli',TRUE),ENT_QUOTES);
			$jual=htmlspecialchars($this->input->post('jual',TRUE),ENT_QUOTES);
            $barang=htmlspecialchars($this->input->post('barang',TRUE),ENT_QUOTES);
			$supplier=htmlspecialchars($this->input->post('supplier_name',TRUE),ENT_QUOTES);
			$id_supplier=htmlspecialchars($this->input->post('suplier',TRUE),ENT_QUOTES);

			$data = array(
                'id'      => $id_barang,
                'qty'     => $qty,
                'price'   => $beli,
				'name'    => $barang,
				'options' => array('supplier' => $supplier,'id_supplier'=>$id_supplier,'harga_jual'=>$jual,'harga_beli'=>$beli)
            );

            $this->cart->insert($data);
			echo json_encode(array("total"=>$this->cart->total_items(),"status" => TRUE));
		}
	}
	
}