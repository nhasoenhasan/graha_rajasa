<?php
class M_Detail_Order extends CI_Model {

	var $table='det_order_barang';
	var $pk='id_det_order_barang';

	// public function getAll ()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from($this->table);
	// 	$this->db->join('supplier s','s.id_supplier=barang.id_supplier');
	// 	$this->db->order_by($this->pk, 'DESC');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function addTransaction($data){
        $this->db->insert_batch($this->table,$data);
		// $this->db->insert($this->table,$data);
	  	return $this->db->insert_id();
	}

}