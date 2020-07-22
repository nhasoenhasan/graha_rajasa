<?php
class M_Penjualan extends CI_Model {

	public function getAll ()
	{
		$query = $this->db->query(
			'SELECT DISTINCT penjualan.no_order,penjualan.tanggal,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal
			FROM penjualan
			INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
			WHERE detail_penjualan.status=0;
			'
		);
        return $query->result();
	}

	public function getByDate($start,$end){
		$sql='SELECT DISTINCT penjualan.no_order,penjualan.tanggal,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal
		FROM penjualan
		INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
		WHERE detail_penjualan.status=0
		and date(penjualan.tanggal) BETWEEN ? AND ?
		GROUP BY DATE(penjualan.tanggal);
		';
		$query = $this->db->query($sql,array($start,$end));
        return $query->result_array();
	}

	public function getByDateJson($start,$end){
		$sql='SELECT DISTINCT penjualan.no_order,penjualan.tanggal,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal
		FROM penjualan
		INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan
		WHERE detail_penjualan.status=0
		and date(penjualan.tanggal) BETWEEN ? AND ?
		GROUP BY DATE(penjualan.tanggal);
		';
		$query = $this->db->query($sql,array($start,$end));
        return $query->result();
	}

}