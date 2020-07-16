
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
                <p class="h3 font-weight-normal">PT. GRAHA RAJASA YOGYAKARTA</p>
            </div>
        </div>
        <div class="row justify-content-md-center mt-1">
            <div class="col-md-auto border-dark ">
                <p class="h5 font-weight-bold">Service AC Kendaraan Mobil dan Bus</p>
            </div>
        </div>
        <div class="row justify-content-md-center ">
            <div class="col-md-auto border-dark text-center ">
                <p >Jl.Ringroad Barat No.250, Nogotirto, Kec. Gamping, Kab. Sleman</p>
                <p style="margin-top:-1rem">Daerah Istimewa Yogyakarta</p>
                <p style="margin-top:-1rem">5592</p>
            </div>
        </div>
        <hr style="margin-top:-0.5rem;background-color:black">
        <div class="justify-content-md-left mt-1 mb-4">
            <div class="row justify-content-md-center mt-1">
                <div class="col-md-auto text-center ">
                    <p class="h5 font-weight-bold">Laporan Barang</p>
                    <p class="h5 font-weight-bold">Periode:<?php echo "  " . date("d/m/Y");?></p>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Barang</th>
                    <th scope="col" class="text-center">Stock</th>
                    <th scope="col" class="text-center">Harga Beli</th>
                    <th scope="col" class="text-center">Harga Jual</th>
                    <th scope="col" class="text-center">Suplier</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach ($data as $key=> $value) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $key+1?></th>
                        <td class="text-center"><?= $value['nama_barang']?></td>
                        <td class="text-center"><?= $value['stok']?></td>
                        <td class="text-center">Rp. <?= $value['harga_beli']?></td>
                        <td class="text-center">Rp. <?= $value['harga_jual']?></td>
                        <td class="text-center"><?= $value['nama']?></td>
                    </tr>
                <?php 
                }?>
                <tr>
            </tbody>
        </table>
        <div class="col justify-content-center pr-3 text-center" style=" position: fixed; left: 40rem; bottom: 10rem; color: black;">
            <div class="col-5 text-center" style="margin-bottom:6rem">
                <p >Mengetahui</p>
                <p >Pimpinan PT.Graha Rajasa</p>
            </div>
            <div class="col-5 text-center">
                <hr style="width:14rem">
            </div>
        </div>
    </div>
    <script>
		window.print();
	</script>
</body>
</html>
