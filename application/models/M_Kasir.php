<?php
class M_Kasir extends CI_Model {

	var $table='det_order_barang';
	var $pk='id_det_order_brg';

	public function getDiskon(){
		$this->db->select('name,value');
		$this->db->from('promo');
		$this->db->where('name','diskon');
		$this->db->order_by('id_promo', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

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
		$status='status';
		$sql="SELECT SUM(subtotal) AS total FROM det_order_barang WHERE status=? AND id_supplier=?";
		$query=$this->db->query($sql, array(2, $nama));
		// $query=$this->db->query('SELECT SUM(subtotal) AS total FROM det_order_barang WHERE status=? AND nama_supplier=?');
		return $query->result_array();
	}

	public function addTransaction($data){
		$this->db->insert('penjualan',$data);
	  	return $this->db->insert_id();
	}

	public function addDetailTransaction($data){
        $this->db->insert_batch('detail_penjualan',$data);
	  	return $this->db->insert_id();
	}

	//Handle Update Table Barang
	public function updateBarang($id_barang,$stok){
		//Reduce Stok Barang
		$sql="UPDATE `barang` SET `stok`=stok-? WHERE id_barang=?";
		$query=$this->db->query($sql, array($stok, $id_barang));
		return $id_barang;
	}
	
}