<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3  ">
        <nav aria-label="breadcrumb" style="margin-left:-0.8rem">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Data Penjualan</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="row ml-1">
            <h1 class="h2">Data Penjualan</h1>
        </div>
        <?=  $user; ?>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
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
        <tbody id="show_data">
        </tbody>
    </table>
</main>

<script  type="text/javascript">

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Penjualan()
    });  

    //Handle Date Range
    $(function() {
      var $startDate = $('.start-date');
      var $endDate = $('.end-date');

      $startDate.datepicker({
        autoHide: true,
      });
      $endDate.datepicker({
        autoHide: true,
        startDate: $startDate.datepicker('getDate'),
      });

      $startDate.on('change', function () {
        $endDate.datepicker('setStartDate', $startDate.datepicker('getDate'));
      });
    });
    //End Handle Date Range


    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Penjualan() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/kasir/penjualan/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    // console.log(data[i].tanggal.slice(0,9),'<<');
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].tanggal.slice(0,10)+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].no_order+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].nama_barang+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp. '+data[i].harga+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].jumlah+'</td>'+
                            // '<td class="text-center" style="word-break: break-all;">'+data[i].diskon+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    $('#startDate').on('input', function() {
        data=this.value
        if (data !== '') {
            $('#startDate').removeClass('is-invalid');
            // $('#endDate').addClass('is-invalid');
        }
    });

    $('#endDate').on('input', function() {
        data=this.value
        if (data !== '') {
            $('#endDate').removeClass('is-invalid');
            // $('#endDate').addClass('is-invalid');
        }
    });

    //Get Data Barang
    function getValidation() {
        var start=$('#startDate').val();
        var end=$('#endDate').val();
        if (start === '' || end === '') {
            $('#startDate').addClass('is-invalid');
            $('#endDate').addClass('is-invalid');
        }else{
            getByDate()
        }
    }

    function getByDate(){
        var start=$('#startDate').val();
        var end=$('#endDate').val();
        $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/kasir/penjualan/getByDate'?>',
            async : false,
            dataType : 'json',
            data:{
                startDate:start,
                endDate:end
            },
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].tanggal.slice(0,10)+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].no_order+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].nama_barang+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp. '+data[i].harga+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].jumlah+'</td>'+
                            // '<td class="text-center" style="word-break: break-all;">'+data[i].diskon+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    

</script>
