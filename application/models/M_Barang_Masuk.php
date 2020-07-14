<?php
class M_Barang_Masuk extends CI_Model {

	var $barang_masuk='barang_masuk';
	var $id_barang_masuk='id_barang_masuk';
	var $det_barang_masuk='det_barang_masuk';
	var $id_det_barang_masuk='id_det_barang_masuk';

	public function getAll ()
	{
		$query = $this->db->query(
			'SELECT DISTINCT barang_masuk.id_barang_masuk,det_barang_masuk.id_supplier,det_barang_masuk.id_barang,det_barang_masuk.harga_beli,det_barang_masuk.id_det_barang_masuk,barang_masuk.no_struk,barang_masuk.nama_supplier,barang_masuk.tanggal_masuk,det_barang_masuk.jumlah,det_barang_masuk.nama_barang,det_barang_masuk.subtotal
			FROM barang_masuk
			INNER JOIN det_barang_masuk ON barang_masuk.id_barang_masuk = det_barang_masuk.id_barang_masuk'
		);
		return $query->result();
	}

	//Handle Check Struk Is?
	public function checkStruk($id){
		$this->db->select('*');
		$this->db->from($this->barang_masuk);
		$this->db->where('no_struk',$id);
		$query = $this->db->get();
		return $query->result();
	}

	//Handle Add Barang Masuk
	public function addBarangMasuk($data_barang){
		$this->db->insert($this->barang_masuk,$data_barang);
	  	return $this->db->insert_id();
	}

	//Handle Update Barang Masuk
	public function updateBarangMasuk($total,$id){
		$sql="UPDATE `barang_masuk` SET `total`=`total`+? WHERE `no_struk`=?";
		$sql2="SELECT id_barang_masuk FROM barang_masuk";
		$query=$this->db->query($sql, array($total,$id));
		$query2=$this->db->query($sql2);
	  	return $query2->result_array();
	}

	//Handle Add Detail Barang Masuk
	public function addDetBarangMasuk($data_barang){
		$this->db->insert($this->det_barang_masuk,$data_barang);
		return $this->db->insert_id();
	}

	//Handle Update Table Barang
	public function updateBarang($stok,$beli,$jual,$id,$nama,$id_barang){
		$sql="UPDATE `barang` SET `stok`=stok+?,`harga_beli`=?,`harga_jual`=?,`id_supplier`=?,`nama_barang`=? WHERE id_barang=?";
		$query=$this->db->query($sql, array($stok, $beli,$jual,$id,$nama,$id_barang));
		return $id_barang;;
	}

	public function updateDetOrder($id){
		$this->db->set('status', 3);
		$this->db->where('id_det_order_brg', $id);
		$this->db->update('det_order_barang');
		return $id;
	}

	public function getIdSupplier($suplier){
		$this->db->select('id_supplier');
		$this->db->from('supplier');
		$this->db->where('nama',$suplier);
		$query = $this->db->get();
		return $query->result_array();
	}
	// public function updateBarang($data,$id_barang){
	// 	$this->db->where($this->pk, $id_barang);
	// 	$id = $this->db->update($this->table, $data);
	// 	return $id;
	// }

	// public function delete($id){
	// 	$id = $this->db->where($this->pk,$id)->delete($this->table);
	// 	return $id;
	// }

}