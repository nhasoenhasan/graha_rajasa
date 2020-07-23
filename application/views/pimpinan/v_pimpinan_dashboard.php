<style>
    #card-custom{
        width: 14rem
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
        </div>
    </div>
    <div class="row ml-4">
        <div class="card bg-light mb-3" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_order_barang[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Acc Order</h5>
                <a href="<?php echo  base_url().'index.php/gudang/barang'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
        <div class="card bg-light mb-3 ml-5" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_barang[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Barang</h5>
                <a href="<?php echo  base_url().'index.php/gudang/suplier'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
        <div class="card bg-light mb-3 ml-5" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_suplier[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Suplier</h5>
                <a href="<?php echo  base_url().'index.php/gudang/barang_masuk'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
        <div class="card bg-light mb-3 ml-5" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_user[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data User</h5>
                <a href="<?php echo  base_url().'index.php/gudang/order'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
    </div>
    <div class="row ml-4">
        <div class="card bg-light mb-3" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_penjualan[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Penjualan</h5>
                <a href="<?php echo  base_url().'index.php/gudang/barang'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
        <div class="card bg-light mb-3 ml-5" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_barang_masuk[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Barang Masuk</h5>
                <a href="<?php echo  base_url().'index.php/gudang/suplier'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
        <div class="card bg-light mb-3 ml-5" id="card-custom">
            <div class="card-body bg-dark">
                <h5 class="card-title text-white"><?= $jumlah_return[0]['jumlah'] ?></h5>
                <h5 class="card-title text-white">Data Return Barang</h5>
                <a href="<?php echo  base_url().'index.php/gudang/barang_masuk'?>" class="card-text text-white">Lihat Detail<span class="fas ml-3 fa-arrow-circle-right"></span></a>
            </div>
        </div>
    </div>
</main>
<script>
    feather.replace()
</script>