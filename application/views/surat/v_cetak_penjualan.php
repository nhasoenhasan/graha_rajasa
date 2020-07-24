
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
                    <p class="h5 font-weight-bold">Laporan Penjualan</p>
                    <p class="h5 font-weight-bold">Periode: <?php echo $startDate?> - <?php echo "  " . date("d/m/Y");?> </p>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">No Nota</th>
                    <th scope="col" class="text-center">Nama Barang</th>
                    <th scope="col" class="text-center">Harga Satuan</th>
                    <th scope="col" class="text-center">Qty</th>
                    <th scope="col" class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $key+1?></th>
                        <td class="text-center"><?= $value['tanggal']?></td>
                        <td class="text-center"><?= $value['no_order']?></td>
                        <td class="text-center"><?= $value['nama_barang']?></td>
                        <td class="text-center">Rp. <?= $value['harga']?></td>
                        <td class="text-center"><?= $value['jumlah']?></td>
                        <td class="text-center"><?= $value['subtotal']?></td>
                    </tr>
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="col justify-content-center pr-3 text-center" style="left: 40rem; top: 5rem; color: black;">
            <div class="col-5 text-center" style="margin-bottom:6rem">
                <p >Mengetahui</p>
                <p >Pimpinan PT.Graha Rajasa</p>
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
