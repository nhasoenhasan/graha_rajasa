
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
<body onload="popup_print()" >
    <?php  $i=0; ?>
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-auto border-dark ">
                <p class="h5">Data Acc Order Barang</p>
            </div>
        </div>
        <div class="row justify-content-md-center mt-1">
            <div class="col-md-auto border-dark ">
                <p class="h3 font-weight-bold"><?= $cetak[0]['nama_perusahaan']?></p>
            </div>
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-auto border-dark ">
                <p>No Surat : XX/xx/xx/xx</p>
            </div>
        </div>
        <hr>
        <div class="justify-content-md-left mt-1 mb-4">
            <div class="col-md-auto row">
                <div class="col col-2">
                    <p>Tanggal Order</p>
                </div>
                <div class="col">
                    <p>: <?php echo "  " . date("Y/m/d");?></p>
                </div>
            </div>
            <div class="col-md-auto row">
                <div class="col col-2">
                    <p>Kepada Supplier</p>
                </div>
                <div class="col">
                    <p>:<?= $supplier?></p>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Nama Barang</th>
                <th scope="col" class="text-center">Jumlah</th>
                <th scope="col" class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $key+1?></th>
                        <td class="text-center"><?= $value['nama_barang']?></td>
                        <td class="text-center"><?= $value['jumlah']?></td>
                        <td class="text-center">Rp. <?= $value['subtotal']?></td>
                    </tr>
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="row justify-content-end pr-3 ">
            <div class="col-3  text-center">
                <p class="font-weight-bold">Total</p>
            </div>
            <div class="col-3 mr-2  text-center ">
                <p class="font-weight-bold">Rp. <?= $total[0]['total']?></p>
            </div>
        </div>
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
