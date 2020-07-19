<?php
class M_Setting extends CI_Model {

	var $table='setting_cetak';
	var $pk='id_setting_cetak';

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

	public function updateSetting($data,$id_barang){
		$this->db->where($this->pk, $id_barang);
		$id = $this->db->update($this->table, $data);
		return $id;
	}

}