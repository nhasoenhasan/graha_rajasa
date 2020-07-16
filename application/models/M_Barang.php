<?php
class M_Barang extends CI_Model {

	var $table='barang';
	var $pk='id_barang';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('supplier s','s.id_supplier=barang.id_supplier');
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getCetak ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('supplier s','s.id_supplier=barang.id_supplier');
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function addBarang($data_barang){
		$this->db->insert($this->table,$data_barang);
	  	return $this->db->insert_id();
	}

	public function updateBarang($data,$id_barang){
		$this->db->where($this->pk, $id_barang);
		$id = $this->db->update($this->table, $data);
		return $id;
	}

	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}

	public function isSameName($nama){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('nama_barang', $nama);
		$query = $this->db->get();
		return $query->result_array();
	}

}