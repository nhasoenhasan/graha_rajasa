<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active"  href="<?php echo  base_url().'index.php/pimpinan/index'?>">
            <span data-feather="home"></span>
            Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Order Data</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <li class="nav-item">
            <a class="nav-link"  href="<?php echo  base_url().'index.php/pimpinan/acc_order'?>">
                <span  data-feather="file"></span>
                Acc Order
            </a>
        </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Data & Laporan</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/barang'?>">
                <span data-feather="file-text"></span>
                    Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/suplier'?>">
                <span data-feather="file-text"></span>
                    Suplier
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/user'?>">
                <span data-feather="file-text"></span>
                    User
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/penjualan'?>">
                <span data-feather="file-text"></span>
                    Penjualan
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/barangMasuk'?>">
                <span data-feather="file-text"></span>
                    Barang Masuk
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="<?php echo  base_url().'index.php/pimpinan/index/returnBarang'?>">
                <span data-feather="file-text"></span>
                    Return Barang
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
        <span>Pengaturan</span>
        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url().'index.php/gudang/setting'?>">
                <span data-feather="file-text"></span>
                    Cetak
                </a>
            </li>
        </ul>
    </div>
</nav>