<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" >
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo  base_url().'index.php/kasir_home'?>">
            <span class="fas fa-cash-register fa-2x mr-1" style="color:#007bff"></span>
                Kasir <span class="sr-only">(current)</span>
            </a>
        </li>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Transaksi</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/kasir_penjualan'?>">
            <span data-feather="file"></span>
                Penjualan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/kasir_return_barang'?>">
            <span data-feather="file"></span>
                Return Barang
            </a>
        </li>
    </div>
</nav>