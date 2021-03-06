<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active"  href="<?php echo  base_url().'index.php/gudang/index'?>">
            <span data-feather="home"></span>
            Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Master Data</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/barang'?>">
            <span  data-feather="file"></span>
            Data Barang
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/suplier'?>">
            <span data-feather="shopping-cart"></span>
            Data Suplier
            </a>
        </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Transaksi</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/barang_masuk'?>">
            <span data-feather="file-text"></span>
                Barang Masuk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/order'?>">
            <span data-feather="file-text"></span>
            Order Barang
            </a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/acc_order'?>">
            <span data-feather="file-text"></span>
            Order Acc
            </a>
        </li>
        </ul>
    </div>
</nav>