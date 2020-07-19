<?php
class M_Penjualan extends CI_Model {

	public function getAll ()
	{
		$query = $this->db->query(
			'SELECT DISTINCT penjualan.no_order,penjualan.tanggal,detail_penjualan.nama_barang,detail_penjualan.harga,detail_penjualan.jumlah,penjualan.diskon,detail_penjualan.subtotal
            FROM penjualan
            INNER JOIN detail_penjualan ON penjualan.id_penjualan = detail_penjualan.id_penjualan;
			'
		);
        return $query->result();
	}

}