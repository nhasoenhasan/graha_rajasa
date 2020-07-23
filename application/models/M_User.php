<?php
class M_User extends CI_Model {
	var $session_expire	= 7200;
	var $table='user';
	var $pk='id_user';

	public function auth($data)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($data);

		$query = $this->db->get();
        return $query->row();
	}	

	public function getAll(){
		$this->db->select('*');
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result();
	}

	public function addUser($data_user){
		$this->db->insert($this->table,$data_user);
	  	return $this->db->insert_id();
	}

	public function updateUser($data,$id_user){
		$this->db->where($this->pk, $id_user);
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
		$this->db->where('username', $nama);
		$query = $this->db->get();
		return $query->result_array();
	}
}