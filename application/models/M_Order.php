<?php
class M_Order extends CI_Model {

	var $table='det_order_barang';
	var $pk='id_det_order_brg';


	public function getAll ($status,$nama)
	{
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

	public function getTotal($status,$nama){
		// $status='status';
		$sql="SELECT SUM(subtotal) AS total FROM det_order_barang WHERE status=? AND id_supplier=?";
		$query=$this->db->query($sql, array($status, $nama));
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

	//Update Status Order Acc
	public function aproveOrder($id){
		// $id = $this->db->update('det_order_barang', $data,'id_det_order_brg');
		$this->db->set('status', 1);
		$this->db->where($this->pk, $id);
		$this->db->update($this->table);
		return $id;
	}

	//Delete Order Acc
	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}

	//Delete Order Acc
	public function getSupplierNama($id){
		$this->db->select('nama');
		$this->db->from('supplier');
		$this->db->where('id_supplier',$id);
		$this->db->order_by('id_supplier', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// $sql='SELECT DISTINCT 
	// 	det_order_barang.nama_barang,det_order_barang.nama_supplier,det_order_barang.jumlah,det_order_barang.subtotal,det_order_barang.status,det_order_barang.id_det_order_brg
	// 	FROM order_barang
	// 	INNER JOIN det_order_barang ON order_barang.id_order_barang = det_order_barang.id_order_barang
	// 	WHERE date(order_barang.tanggal_order_brg) BETWEEN ? AND ? ';
		
	// 	$query = $this->db->query(
	// 		'SELECT DISTINCT order_barang.no_struk,det_order_barang.nama_supplier,order_barang.total
	// 		FROM order_barang
	// 		INNER JOIN det_order_barang ON order_barang.id_order_barang = det_order_barang.id_order_barang;
	// 		'
	// 	);

	public function getByDate($start,$end){
		$sql='SELECT DISTINCT 
		det_order_barang.harga_beli,det_order_barang.nama_barang,det_order_barang.nama_supplier,det_order_barang.jumlah,det_order_barang.subtotal,det_order_barang.status,det_order_barang.id_det_order_brg
		FROM order_barang
		INNER JOIN det_order_barang ON order_barang.id_order_barang = det_order_barang.id_order_barang
		WHERE det_order_barang.status=3 and date(order_barang.tanggal_order_brg) BETWEEN ? AND ? ';
		$query = $this->db->query($sql,array($start,$end));
        return $query->result_array();
	}

	public function getByDateJson($start,$end){
		$sql='SELECT DISTINCT 
		det_order_barang.harga_beli,det_order_barang.nama_barang,det_order_barang.nama_supplier,det_order_barang.jumlah,det_order_barang.subtotal,det_order_barang.status,det_order_barang.id_det_order_brg
		FROM order_barang
		INNER JOIN det_order_barang ON order_barang.id_order_barang = det_order_barang.id_order_barang
		WHERE det_order_barang.status=3 and date(order_barang.tanggal_order_brg) BETWEEN ? AND ?';
		$query = $this->db->query($sql,array($start,$end));
        return $query->result();
	}



}