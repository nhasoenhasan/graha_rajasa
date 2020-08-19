<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
    #hiden:{
        display:none
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3  ">
        <nav aria-label="breadcrumb" style="margin-left:-0.8rem">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Data Return</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="row ml-1">
            <h1 class="h2">Data Return</h1>
            <form  class="form-inline"   style="margin-left:1rem" action="<?php echo  base_url().'index.php/kasir_return_barang/getCetak'?>" method="post" target="_blank">
                <div class="form-group mx-sm-3 ">
                    <input type="text" class="form-control" id="search_nota" name="search_nota" placeholder="Masukan No Nota">
                </div>
                <button type="button" id="btnSearch" onclick="searchGetByNota()" class="btn btn-primary">
                    <span data-feather="search"></span>
                </button>
                <button type="submit"  class="btn btn-primary ml-2">
                    <span data-feather="printer"></span>
                </button>    
            </form>
        </div>
        <?=
            $user;
        ?>
        <div class="btn-toolbar mb-2 mb-md-0" style="margin-left:-3rem">
            <button type="button" class="btn btn-success mr-1" onclick="get_Penjualan()"  ><span data-feather="refresh-ccw"></span></button>
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
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
                <th scope="col" class="text-center">Alasan</th>
                <th scope="col" class="text-center">Sub Total</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</main>

<!-- Modal Add Barang -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-inline" id="searchform" style="margin-left:-1rem">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" id="no_nota" name="no_nota" placeholder="Masukan No Nota">
            </div>
            <button type="button" id="btnSearch" onclick="searchValidation('find')" class="btn btn-primary mb-2">
                Search
            </button>
        </form>
        <small id="HelpNota" class="form-text text-danger ml-1">
        </small>
        <div id="result">
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addValidation()">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Add Barang -->

<script  type="text/javascript">

    var jumlah=0;

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Penjualan()
    });  

    $(document).on('change','#suplier',function() {
        data=this.value

        if (data=='') {
            $('#HelpSuplier').text('*Pilih Barang!');
            $('#suplier').addClass('is-invalid');
        }else{
            data=data.split('|');
            jumlah=parseInt(data[3]);
            $('#jumlah').val(data[3]);
            $('#HelpSuplier').text('');
            $('#suplier').removeClass('is-invalid');
        }

    });

    $(document).on('input','#jumlah',function() {
        data=this.value

        if (data=='') {
            $('#HelpJumlah').text('*Masukan Jumlah');
            $('#jumlah').addClass('is-invalid');
        }else{

            if (parseInt(data) > jumlah) {
                $('#HelpJumlah').text('*jumlah Tidak Ada');
                $('#jumlah').addClass('is-invalid');
            }else{
                $('#HelpJumlah').text('');
                $('#jumlah').removeClass('is-invalid');
            }
        }
    });

    $(document).on('input','#keterangan',function() {
        data=this.value

        if (data=='') {
            $('#HelpKeterangan').text('*Masukan Alasan!');
            $('#keterangan').addClass('is-invalid');
        }else{
            $('#HelpKeterangan').text('');
            $('#keterangan').removeClass('is-invalid');
        }

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

    //Handle Modal Add Barang
    function modaladd(params) {
        $('#HelpNota').text('');
        $('#no_nota').removeClass('is-invalid');
        $('#ModalLabel').text('Tambah Data Return');
        $('#searchform')[0].reset();
        $('#result').html('');
        $('#modalAdd').modal('show')
    }

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function getValidation() {
        var start=$('#startDate').val();
        var end=$('#endDate').val();
        if (start === '' || end === '') {
            $('#startDate').addClass('is-invalid');
            $('#endDate').addClass('is-invalid');
        }else{
            get_PenjualanByDate()
        }
    }

    //Get Data Penjualan
    function get_Penjualan() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/kasir_return_barang/get'?>',
            async : false,
            dataType : 'json',
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
                            '<td class="text-center" style="word-break: break-all;">'+data[i].jumlah_return+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].keterangan+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //Get Data Penjualan By Date
    function get_PenjualanByDate() {
        var start=$('#startDate').val();
        var end=$('#endDate').val();
      $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/kasir_return_barang/getByDate'?>',
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
                            '<td class="text-center" style="word-break: break-all;">'+data[i].jumlah_return+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].keterangan+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //Get Barang By No Nota
    function getByNoNota() {
        var no=$('#search_nota').val();
        $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/kasir_return_barang/getByNota'?>',
            async : false,
            dataType : 'json',
            data: { 
                no_nota: no,
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
                            '<td class="text-center" style="word-break: break-all;">'+data[i].keterangan+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    

    // -------- Form Validation --------------------

    //Input Barang
    $('#no_nota').on('input', function() {
        data=this.value

        if(data!==''){
            // $('#no_nota2').val(data);
            $('#HelpNota').text('');
            $('#no_nota').removeClass('is-invalid');
        }else{
            $('#HelpNota').text('*Masukan No Nota');
            $('#no_nota').addClass('is-invalid');
        }
    });

    //Search Tabel
    $('#search_nota').on('input', function() {
        data=this.value
        if(data!==''){
            // $('#HelpNota').text('');
            $('#search_nota').removeClass('is-invalid');
        }else{
            // $('#HelpNota').text('*Masukan No Nota');
            $('#search_nota').addClass('is-invalid');
        }
    });

    //Validation Form Search
    function searchValidation(params){
       var value= $('#no_nota').val();

       if (value==='') {
            $('#HelpNota').text('*Masukan No Nota!');
            $('#no_nota').addClass('is-invalid');
       }else{
            search_Nota()
       }
    }

    //Validation Search
    function searchGetByNota(){
        var value= $('#search_nota').val();

        if (value==='') {
            $('#search_nota').addClass('is-invalid');
        }else{
            getByNoNota()
        }
    }

    function cetak(){
        var no=$('#search_nota').val();
        $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/kasir_return_barang/getCetak'?>',
            async : false,
            dataType : 'json',
            data: { 
                no_nota: no,
            },
            success : function(data){
                window.open('<?php echo  base_url().'index.php/kasir_return_barang/getCetak'?>',"_blank");

            }
        });
    }

    //Handle Add Barang
    function search_Nota()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/kasir_return_barang/searchNota'?>';
        var formData = new FormData($('#searchform')[0]);
        var html='';
        var select='<option selected value="">Pilih Barang</option>';
        $("#btnSearch").prop('disabled', true);
        $("#btnSearch").html('<div class="spinner-border text-light" role="status">'+
                    '<span class="sr-only">Loading...</span>'+
                '</div>');
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){  
                if (data.status===true) {
                    html+='<form id="addform">'+
                                '<div class="form-group">'+
                                    '<label for="exampleFormControlSelect1">Pilih Barang</label>'+
                                    '<select name="suplier" class="form-control" id="suplier">'+
                                    '</select>'+
                                    '<small id="HelpSuplier" class="form-text text-danger ml-1">'+
                                    '</small>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label for="exampleFormControlTextarea1">Jumlah</label>'+
                                    '<input name="jumlah" id="jumlah"  type="number" class="form-control"  >'+
                                    '<small id="HelpJumlah" class="form-text text-danger ml-1">'+
                                    '</small>'+
                                '</div>'+
                                '<div class="form-group">'+
                                    '<label for="exampleFormControlTextarea1">Alasan</label>'+
                                    '<textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>'+
                                    '<small id="HelpKeterangan" class="form-text text-danger ml-1">'+
                                    '</small>'+
                                '</div>'+
                            '</form>';
                    var i;
                    for(i=0; i<data.data.length; i++){
                        select +='<option value="'+data.data[i].id_det_penjualan+'|'+data.data[i].harga+'|'+data.data[i].id_penjualan+'|'+data.data[i].jumlah+'">'+data.data[i].nama_barang+'</option>';
                    }

                    // $('#result').val(html);
                    $('#result').append(html);
                    $('#suplier').append(select);
                    $("#btnSearch").html('Search');
                    $("#btnSearch").prop('disabled', false);
                }else{
                    $('#result').html('<h5 class="ml-3 text-danger">No Nota Tidak Di Temukan!!</h5>');
                    $("#btnSearch").prop('disabled', false);
                    $("#btnSearch").html('Search');
                }
            }
        })
    }

    //Validation Form Add Return
    function addValidation(){
       var suplier= $('#suplier').val();
       var keterangan= $('#keterangan').val();
       var jumlahInput= $('#jumlah').val();

       if (suplier==='' || keterangan==='' || jumlahInput==='') {
            $('#HelpSuplier').text('*Pilih Barang!');
            $('#suplier').addClass('is-invalid');
            $('#HelpKeterangan').text('*Masukan Alasan!');
            $('#keterangan').addClass('is-invalid');
            $('#HelpJumlah').text('*Masukan Jumlah');
            $('#jumlah').addClass('is-invalid');
       }else{
            if (parseInt(jumlahInput) > jumlah) {
                $('#HelpJumlah').text('*jumlah Tidak Ada');
                $('#jumlah').addClass('is-invalid');
            }else{
                $('#HelpJumlah').text('');
                $('#jumlah').removeClass('is-invalid');
                addReturn()
            }

       }

    }

    //Handle Add Data Return
    function addReturn(){
        var url;
        url = '<?php echo  base_url().'index.php/kasir_return_barang/updatePenjualan'?>';
        var formData = new FormData($('#addform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){  
                if (data.status===true) {
                    $('#modalAdd').modal('hide');
                    get_Penjualan()
                }else{
                    // $('#modalAdd').modal('show')
                }
            }
        })
    }

    

</script>
