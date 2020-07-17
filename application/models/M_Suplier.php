<?php
class M_Suplier extends CI_Model {

	var $table='supplier';
	var $pk='id_supplier';

	public function getAll ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getCetak ()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by($this->pk, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($data){
		$this->db->insert($this->table,$data);
	  	return $this->db->insert_id();
	}

	public function update($data,$id){
		$this->db->where($this->pk, $id);
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
		$this->db->where('nama', $nama);
		$query = $this->db->get();
		return $query->result_array();
	}
}