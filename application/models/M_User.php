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
}