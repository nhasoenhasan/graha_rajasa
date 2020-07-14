<?php
class M_Order extends CI_Model {

	var $table='det_order_barang';
	var $pk='id_det_order_brg';


	public function getAll ($status,$nama)
	{
		
		// $query = $this->db->query(
		// 	'SELECT DISTINCT order_barang.no_struk,det_order_barang.nama_supplier,order_barang.total
		// 	FROM order_barang
		// 	INNER JOIN det_order_barang ON order_barang.id_order_barang = det_order_barang.id_order_barang;
		// 	'
		// );
		if($nama===''){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('status >=',$status);
			$this->db->order_by($this->pk, 'DESC');
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('status >=',$status);
			$this->db->where('id_supplier',$nama);
			$this->db->order_by($this->pk, 'DESC');
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function getOrder ($status)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('status',$status);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllArray ($status,$nama)
	{
		if($nama===''){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('status ',$status);
			$this->db->order_by($this->pk, 'DESC');
			$query = $this->db->get();
			return $query->result_array();
		}else{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('status ',$status);
			$this->db->where('id_supplier',$nama);
			$this->db->order_by($this->pk, 'DESC');
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	public function getTotal($nama){
		$sql="SELECT SUM(subtotal) AS total FROM det_order_barang WHERE status=? AND nama_supplier=?";
		$query=$this->db->query($sql, array(2, $nama));
		// $query=$this->db->query('SELECT SUM(subtotal) AS total FROM det_order_barang WHERE status=? AND nama_supplier=?');
		return $query->result_array();
	}

	public function addTransaction($data){
		$this->db->insert('order_barang',$data);
	  	return $this->db->insert_id();
	}

	//Update Status Order Acc
	public function updateAccOrder($id){
		// $id = $this->db->update('det_order_barang', $data,'id_det_order_brg');
		$this->db->set('status', 2);
		$this->db->where($this->pk, $id);
		$this->db->update($this->table);
		return $id;
	}

	//Delete Order Acc
	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}

}