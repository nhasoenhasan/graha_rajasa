
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cetak</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            color: black;
            text-align: center;
        }
    </style>
</head>
<body  >
    <?php  $i=0; ?>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-auto border-dark ">
                <p class="h3 font-weight-normal"><?= $cetak[0]['nama_perusahaan']?></p>
            </div>
        </div>
        <div class="row justify-content-md-center mt-1">
            <div class="col-md-auto border-dark ">
                <p class="h5 font-weight-bold"><?= $cetak[0]['tag_line']?></p>
            </div>
        </div>
        <div class="row justify-content-md-center ">
            <div class="col-md-auto border-dark text-center ">
                <p class="text-center" ><?= $cetak[0]['alamat']?></p>
            </div>
        </div>
        <hr style="margin-top:-0.5rem;background-color:black">
        <div class="justify-content-md-left mt-1 mb-4">
            <div class="row justify-content-md-center mt-1">
                <div class="col-md-auto text-center ">
                    <p class="h5 font-weight-bold">Laporan Barang Masuk</p>
                    <p class="h5 font-weight-bold">Periode: <?php echo $startDate?> - <?php echo $endDate ?> </p>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">No Nota</th>
                    <th scope="col" class="text-left">Nama Barang</th>
                    <th scope="col" class="text-right">Harga Beli</th>
                    <th scope="col" class="text-right">Harga Jual</th>
                    <th scope="col" class="text-center">Supplier</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Sub Total</th>
                    <th scope="col" class="text-center">Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $key+1?></th>
                        <td class="text-center"><?= $value['no_struk']?></td>
                        <td class="text-left"><?= $value['nama_barang']?></td>
                        <td class="text-right">Rp.<?= $value['harga_beli']?></td>
                        <td class="text-right">Rp.<?= $value['harga_jual']?></td>
                        <td class="text-center"><?= $value['nama_supplier']?></td>
                        <td class="text-center"><?= $value['jumlah']?></td>
                        <td class="text-right"><?= $value['subtotal']?></td>
                        <td class="text-center"><?= substr($value['tanggal_masuk'],8,2)?>-<?= substr($value['tanggal_masuk'],5,2)?>-<?= substr($value['tanggal_masuk'],0,4)?></td>
                    </tr>
                    <!-- substr($value['tanggal_masuk'],0,4) Year-->
                    <!-- substr($value['tanggal_masuk'],5,2) Bulan -->
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="row justify-content-end pr-5 mr-5 ">
            <div class="col-3  text-center">
                <p class="font-weight-bold">Total</p>
            </div>
            <div class="col-3 mr-1  text-center ">
                <p class="font-weight-bold">Rp. <?= $total?></p>
            </div>
        </div>
        <div class="col justify-content-center pr-3 text-center" style="left: 40rem; top: 5rem; color: black;">
            <div class="col-5 text-center" style="margin-bottom:6rem">
                <p >Yogyakarta, <?php echo "  " . date("d-m-Y");?></p>
                <p ><?= $cetak[0]['mengetahui']?></p>
            </div>
            <div class="col-5 text-center">
               <p><?= $cetak[0]['tdd_gudang']?></p>
            </div>
        </div>
    </div>
    <script>
		window.print();
	</script>
</body>
</html>
