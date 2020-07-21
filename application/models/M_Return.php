<?php
class M_Return extends CI_Model {

	public function getAll ()
	{
		$query = $this->db->query(
			'SELECT DISTINCT penjualan.no_order,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal,detail_penjualan.keterangan,detail_penjualan.tanggal
			FROM penjualan
			INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
			WHERE detail_penjualan.status=1;
			'
		);
        return $query->result();
	}

	public function getByNota ($id)
	{
		$sql ='SELECT DISTINCT penjualan.no_order,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal,detail_penjualan.keterangan,detail_penjualan.tanggal
			FROM penjualan
			INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
			WHERE detail_penjualan.status=1
			AND penjualan.no_order=?';
			
		$query=$this->db->query($sql, array($id));
        return $query->result();
	}

	public function getByNotaCetak ($id)
	{
		$sql ='SELECT DISTINCT penjualan.no_order,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal,detail_penjualan.keterangan,detail_penjualan.tanggal
			FROM penjualan
			INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
			WHERE detail_penjualan.status=1
			AND penjualan.no_order=?';
			
		$query=$this->db->query($sql, array($id));
        return $query->result_array();
	}

	public function findNota($id)
	{
		$sql='SELECT DISTINCT detail_penjualan.nama_barang,detail_penjualan.id_det_penjualan,detail_penjualan.subtotal,penjualan.id_penjualan
		FROM penjualan
		INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
		WHERE detail_penjualan.status=0 AND penjualan.no_order=?';
		$query = $this->db->query($sql,array($id));
        return $query->result();
	}

	public function update($id,$data){
		$this->db->set('status', 1);
		$this->db->set('keterangan', $data);
		$this->db->where('id_det_penjualan', $id);
		$this->db->update('detail_penjualan');
		return $id;
	}

	//Handle Update Barang Masuk
	public function updateBarangMasuk($total,$id){
		$sql="UPDATE `penjualan` SET `total`=`total`-? WHERE `id_penjualan`=?";
		$query=$this->db->query($sql, array($total,$id));
	  	return $id;
	}

}