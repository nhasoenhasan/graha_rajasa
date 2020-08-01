
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
    <?php  $i=0;  ?>
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
        <div class="justify-content-md-left mt-2 mb-4">
            <div class="row justify-content-md-left mt-1">
                <div class="col-md-auto text-left ">
                    <div class="row">
                        <div class="col" style="width:5rem">
                            <p class="h5 ">No Return</p>
                        </div>
                        <div class="col" style="width:20rem">
                            <p class="h5 "><?= $data[0]['no_order']?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="h5 ">Tanggal</p>
                        </div>
                        <div class="col">
                            <p class="h5 "><?php echo "  " . date("d-m-Y");?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Tanggal Return</th>
                    <th scope="col" class="text-center">Nama Barang</th>
                    <th scope="col" class="text-center">Harga Satuan</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Alasan</th>
                    <th scope="col" class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $key+1?></th>
                        <td class="text-center"><?= substr($value['tanggal'],8,2)?>-<?= substr($value['tanggal'],5,2)?>-<?= substr($value['tanggal'],0,4)?></td>
                        <td class="text-left"><?= $value['nama_barang']?></td>
                        <td class="text-right">Rp. <?= $value['harga']?></td>
                        <td class="text-right"><?= $value['jumlah']?></td>
                        <td class="text-center"><?= $value['keterangan']?></td>
                        <td class="text-right">Rp. <?= $value['subtotal']?></td>
                    </tr>
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="row justify-content-end pl-5 ml-5 ">
            <div class="col-3  text-right">
                <p class="font-weight-bold">Total</p>
            </div>
            <div class="col-3 mr-1  text-right ">
                <p class="font-weight-bold">Rp. <?= $total?></p>
            </div>
        </div>
        <div class="col justify-content-center pr-3 text-center" style=" left: 40rem; top: 5rem; color: black;">
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
