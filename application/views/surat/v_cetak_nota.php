
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
    <?php  $i=1; ?>
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
                            <p class="h5 ">No Order</p>
                        </div>
                        <div class="col" style="width:20rem">
                            <p class="h5 "><?= $no_order?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="h5 ">Tanggal</p>
                        </div>
                        <div class="col">
                            <p class="h5 "><?php echo "  " . date("d/m/Y");?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Barang</th>
                    <th scope="col" class="text-center">Harga Satuan</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $i++?></th>
                        <td class="text-center"><?= $value['name']?></td>
                        <td class="text-center">Rp. <?= $value['price']?></td>
                        <td class="text-center"><?= $value['qty']?></td>
                        <td class="text-center">Rp. <?= $value['subtotal']?></td>
                    </tr>
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="col justify-content-center pr-3 text-center mt-5" style="left: 40rem;color: black;">
            <div class="col-5 text-center" style="margin-bottom:6rem">
                <p class="font-weight-bold" >Total</p>
                <p class="font-weight-bold"><?= $total?></p>
            </div>
        </div>
        <div class="col justify-content-center pr-3 text-center" style=" position: fixed; left: 50rem; bottom: 10rem; color: black;">
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
