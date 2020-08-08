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
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Data Barang Masuk</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
        <div class="row ml-1">
            <h1 class="h2">Data Barang Masuk</h1>
        </div>
        <?=  $user; ?>
       
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Nota</th>
            <th scope="col" class="text-center">Nama Barang</th>
            <th scope="col" class="text-center">Harga Beli</th>
            <th scope="col" class="text-center">Harga Jual</th>
            <th scope="col" class="text-center">Supplier</th>
            <th scope="col" class="text-center">Jumlah</th>
            <th scope="col" class="text-center">Sub Total</th>
            <th scope="col" class="text-center">Tanggal Masuk</th>
            <th scope="col" class="text-center">Action</th>
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
      <form id="addform" >
        <input name="keterangan" type="hidden" value="Add" class="form-control " id="keterangan">
        <input name="id_barang" type="hidden" class="form-control " id="id_barang">
        <input name="id_det_order_brg" type="hidden" class="form-control " id="id_det_order_brg">
        <input name="nama_barang" id="nama_barang" type="hidden" class="form-control ">
        <input name="nama_supplier" id="nama_supplier" type="hidden" class="form-control ">
        <div class="form-group">
            <label for="exampleInputEmail1" class="ml-1">No Struk</label>
            <input name="no_struk" type="text"  class="form-control " id="no_struk" placeholder="No Struk">
            <small id="HelpNoStruk" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group" id="modal_update_barang_masuk" >
            <label for="exampleInputEmail1">Pilih Barang Yang Di Order</label>
            <select name="barang" id="barang" class="form-control" >
            </select>
            <small id="HelpBarang" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Suplier</label>
            <select name="suplier" class="form-control" id="suplier">
            </select>
            <small id="HelpSuplier" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" id="jumlah" placeholder="Masukan Jumlah">
            <small id="HelpJumlah" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Beli</label>
            <input name="beli" type="number" class="form-control" id="beli"  placeholder="Masuikan Harga Beli">
            <small id="HelpBeli" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Jual</label>
            <input name="jual" type="number" class="form-control" id="jual" placeholder="Masuikan Harga Jual">
            <small id="HelpJual" class="form-text text-danger ml-1">
            </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validation('Add')">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Add Barang -->

<!-- Modal Update Barang -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Edit Barang Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="editform">
        <input name="keterangan" type="hidden" value="Edit" class="form-control " id="keteranganEdit">
        <input name="old_harga_beli" id="old_harga_beli" placeholder="old_harga_beli" type="hidden" class="form-control " >
        <input name="old_jumlah" id="old_jumlah" placeholder="old Jumlah" type="hidden" class="form-control " >
        <input name="id_det_barang_masuk" type="hidden" class="form-control " id="id_det_barang_masuk_edit">
        <input name="id_barang_masuk" type="hidden" class="form-control " id="id_barang_masuk_edit">
        <input name="id_barang" type="hidden" class="form-control " id="id_barang_edit">
        <input name="id_det_order_brg" type="hidden" class="form-control " id="id_det_order_brg_edit">
        <input name="nama_barang" id="nama_barang_edit" type="hidden" class="form-control ">
        <input name="nama_supplier" id="nama_supplier_edit" type="hidden" class="form-control ">
        <div class="form-group">
            <label for="exampleInputEmail1">No Struk</label>
            <input name="no_struk" type="text" class="form-control" id="no_struk_edit" placeholder="No Struk">
            <small id="HelpEditStruk" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group" id="modal_update_barang_masuk" >
            <label for="exampleInputEmail1">Nama Barang</label>
            <input name="barang_edit" readonly type="text" class="form-control" id="barang_edit" placeholder="Nama Barang">
            <small id="HelpEditBarang" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Suplier</label>
            <select name="suplier_edit" class="form-control" id="suplier_edit">
            </select>
            <small id="HelpEditSuplier" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" id="jumlah_edit" placeholder="Masukan Jumlah">
            <small id="HelpEditJumlah" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Beli</label>
            <input name="beli" type="number" class="form-control" id="beli_edit"  placeholder="Masuikan Harga Beli">
            <small id="HelpEditBeli" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Jual</label>
            <input name="jual" type="number" class="form-control" id="jual_edit" placeholder="Masuikan Harga Jual">
            <small id="HelpEditJual" class="form-text text-danger ml-1">
            </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validation('Edit')">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Update Barang -->

<!-- Modal Delete Barang -->
<div class="modal fade bd-example-modal-sm" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content ">
        <div class="modal-header justify-content-center">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Barang</h5>
        </div>
        <div class="modal-body mx-auto">
            <form id="deleteform">
                <input type="hidden" name="id_barang" value="">
                <img src="<?php echo base_url(); ?>assets/images/trash-2.svg" alt="Trash">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="delete_Barang()">Delete</button>
        </div>
    </div>
  </div>
</div>
<!-- End Modal Delete Barang -->

<script  type="text/javascript">

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Order_Barang()
        get_Suplier()
        get_Barang_Masuk()
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
        clearForm()
        $('#ModalLabel').text('Tambah Barang Masuk');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        $('#editform')[0].reset();
        clearForm()
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="beli"]').val(id[0]);
        $('[name="jual"]').val(id[10]);
        $('[name="old_harga_beli"]').val(id[0]);
        $('[name="id_barang"]').val(id[1]);
        $('[name="id_det_barang_masuk"]').val(id[2]);
        $('[name="id_det_order_brg"]').val(id[2]);
        $('[name="suplier_edit"]').val(id[3]+'|'+id[6]);
        $('[name="jumlah"]').val(id[4]);
        $('[name="old_jumlah"]').val(id[4]);
        $('[name="nama_barang"]').val(id[5]);
        $('#barang_edit').val(id[5]);
        $('[name="nama_supplier"]').val(id[6]);
        $('[name="no_struk"]').val(id[7]);
        $('[name="id_barang_masuk"]').val(id[9]);
        $('#modalEdit').modal('show')
    });

    //On Change Select Pilih Data Order Barang
    $('#barang').on('change', function() {
        data=this.value
        var cek;
        data=data.split('=');   
        cek=''+data[0]+'|'+data[8]+'';
        
        //Membuat Persen 
        var hargabeli=Math.round((parseInt(data[6])*(10/100))+parseInt(data[6]));

        $('[name="id_supplier"]').val(data[0]);
        $('[name="id_barang"]').val(data[1]);
        $('[name="id_det_order_brg"]').val(data[2]);
        $('[name="jumlah"]').val(data[5]);
        $('[name="nama_barang"]').val(data[3].replace(/_/g, ' '));
        $('[name="nama_supplier"]').val(data[8].replace(/_/g, ' '));
        $('[name="jual"]').val(hargabeli);
        $('[name="beli"]').val(data[6]);
        $("#suplier").val(data[0]+'|'+data[8]);

        //Handle -> CSS
        $('#HelpBarang').text('');
        $('#barang').removeClass('is-invalid');
        $('#barang').addClass('is-valid');

        $('#HelpSuplier').text('');
        $('#suplier').removeClass('is-invalid');
        $('#suplier').addClass('is-valid');

        $('#HelpJumlah').text('');
        $('#jumlah').removeClass('is-invalid');
        $('#jumlah').addClass('is-valid');

        $('#HelpBeli').text('');
        $('#beli').removeClass('is-invalid');
        $('#beli').addClass('is-valid');

        $('#HelpJual').text('');
        $('#jual').removeClass('is-invalid');
        $('#jual').addClass('is-valid');
    });

    //On Change Select Pilih Data Supplier
    $('#suplier').on('change', function() {
        data=this.value
        data=data.split('|');
        $('[name="nama_supplier"]').val(data[1].replace(/_/g,' '));
    });

     //Edit On Change Select Pilih Data Supplier
     $('#suplier_edit').on('change', function() {
        data=this.value
        data=data.split('|');
        $('[name="nama_supplier"]').val(data[1]);

    });

    //Handle Modal Add Barang
	function modalhapus(id) {
        $('#modaldelete').modal('show');
        $('[name="id_barang"]').val(id);
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
            getByDate()
        }
    }

    //Harga 10% harga beli
    function hargaJual(){

        var a=(parseInt(data[6])*(10/100))+parseInt(data[6]);

        if (a===parseInt(data[7])) {
           return hargabeli=parseInt(data[7]);
        }if(parseInt(data[7]) >= a ){
           return hargabeli=parseInt(data[7]);
        }else{
           return hargabeli=a;
        }

    }

    //Get Data Barang Masuk By Date Range
    function getByDate() {
        var start=$('#startDate').val();
        var end=$('#endDate').val();
      $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/gudang/barang_masuk/getByDate'?>',
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
                            '<td class="text-center">'+data[i].no_struk+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama_barang+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].harga_beli+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].harga_jual+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama_supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].jumlah+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].subtotal+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].tanggal_masuk.slice(0,10)+'</td>'+
                            '<td class="text-center">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].harga_beli+','+data[i].id_barang+','+data[i].id_det_barang_masuk+','+data[i].id_supplier+','+data[i].jumlah+','+data[i].nama_barang+','+data[i].nama_supplier+','+data[i].no_struk+','+data[i].subtotal+','+data[i].id_barang_masuk+','+data[i].harga_jual+'" ><span class="fas fa-pencil-alt" style="color:white"></span></a>'+' '+
                                // '<a onclick="modalhapus('+data[i].id_barang+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_barang+'">D</a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }
    
    //Get Data Barang Masuk
    function get_Barang_Masuk() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/barang_masuk/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].no_struk+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama_barang+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].harga_beli+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].harga_jual+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama_supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].jumlah+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].subtotal+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].tanggal_masuk.slice(0,10)+'</td>'+
                            '<td class="text-center">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].harga_beli+','+data[i].id_barang+','+data[i].id_det_barang_masuk+','+data[i].id_supplier+','+data[i].jumlah+','+data[i].nama_barang+','+data[i].nama_supplier+','+data[i].no_struk+','+data[i].subtotal+','+data[i].id_barang_masuk+','+data[i].harga_jual+'" ><span class="fas fa-pencil-alt" style="color:white"></span></a>'+' '+
                                // '<a onclick="modalhapus('+data[i].id_barang+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_barang+'">D</a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //Get Data Barang Masuk
    function get_Order_Barang() {
      $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/gudang/barang_masuk/getOrder'?>',
            async : false,
            dataType : 'json',
            data: { 
                status: 2
            },
            success : function(data){

                // var value=[];
                var html = '<option value="" selected disabled>Pilih Barang</option>';
                var i;
                for(i=0; i<data.length; i++){
                    var nama_barang=data[i].nama_barang.split(' ').join('_');
                    var nama_supplier=data[i].nama_supplier.split(' ').join('_');
                    html += '<option value='+data[i].id_supplier+'='+data[i].id_barang+'='+data[i].id_det_order_brg+'='+nama_barang+'='+data[i].subtotal+'='+data[i].jumlah+'='+data[i].harga_beli+'='+data[i].harga_jual+'='+nama_supplier+'>'+data[i].nama_barang+'</option>'
                }
                $('#barang').html(html);
            }
        });
    }

    //Get Data Suplier
    function get_Suplier() {
        get_Suplier2()
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/suplier/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '<option data="" selected disabled>Please select</option>';
                var i;
                for(i=0; i<data.length; i++){
                    var nama=data[i].nama.split(' ').join('_');
                    html += '<option value='+data[i].id_supplier+'|'+nama+'>'+data[i].nama+'</option>'
                }
                $('#suplier').html(html);
            }
        });
    }

    //Get Data Suplier
    function get_Suplier2() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/suplier/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '<option data="" selected disabled>Please select</option>';
                var i;
                for(i=0; i<data.length; i++){
                    var nama=data[i].nama.split(' ').join('_');
                    html += '<option value='+data[i].id_supplier+'|'+nama+'>'+data[i].nama+'</option>'
                }
                $('#suplier_edit').html(html);
            }
        });
    }
    
    
    // ------------  Validation Form ------------------------
    function validationAdd(array){
        if (array[4]=="" ||null) {
            $('#HelpNoStruk').text('Masukan No Struk');
            $('#no_struk').addClass('is-invalid');
        }
        if (array[5]==null) {
            $('#HelpBarang').text('Pilih Barang Yang Di Order');
            $('#barang').addClass('is-invalid');
        }
        if (array[6]==null) {
            $('#HelpSuplier').text('Pilih Suplier');
            $('#suplier').addClass('is-invalid');
        }
        if (array[7]=="" || null) {
            $('#HelpJumlah').text('Masukan Jumlah');
            $('#jumlah').addClass('is-invalid');
        }
        if (array[8]=="" || null) {
            $('#HelpBeli').text('Masukan Harga Beli');
            $('#beli').addClass('is-invalid');
        }
        if (array[9]=="" || null) {
            $('#HelpJual').text('Masukan Harga Jual');
            $('#jual').addClass('is-invalid');
        }
    }

    function validationEdit(array){
        if (array[0]=="" ||null) {
            $('#HelpEditStruk').text('Masukan No Struk');
            $('#no_struk_edit').addClass('is-invalid');
        }
        if (array[1]==null) {
            $('#HelpEditBarang').text('Pilih Barang Yang Di Order');
            $('#barang_edit').addClass('is-invalid');
        }
        if (array[2]==null) {
            $('#HelpEditSuplier').text('Pilih Suplier');
            $('#suplier_edit').addClass('is-invalid');
        }
        if (array[3]=="" || null) {
            $('#HelpEditJumlah').text('Masukan Jumlah');
            $('#jumlah_edit').addClass('is-invalid');
        }
        if (array[4]=="" || null) {
            $('#HelpEditBeli').text('Masukan Harga Beli');
            $('#beli_edit').addClass('is-invalid');
        }
        if (array[5]=="" || null) {
            $('#HelpEditJual').text('Masukan Harga Jual');
            $('#jual_edit').addClass('is-invalid');
        }
    }

    //Handle Form Validation
    function validation(params){
        var array=[$("#id_barang").val(),$("#id_det_order_brg").val(),$("#nama_barang").val(),$("#nama_supplier").val(),$("#no_struk").val(),$("#barang").val(),$("#suplier").val(),$("#jumlah").val(),$("#beli").val(),$("#jual").val()];
        var arrayEdit=[$("#no_struk_edit").val(),$("#barang_edit").val(),$("#suplier_edit").val(),$("#jumlah_edit").val(),$("#beli_edit").val(),$("#jual_edit").val()];
        
        var isnull = array.includes(null);
        var isnullEdit = arrayEdit.includes(null);

        var isempty=array.includes("");
        var isemptyEdit=arrayEdit.includes("");

        var istrue=[isnull,isempty];
        var istrueEdit=[isnullEdit,isemptyEdit];

        var validation=params=='Add'?istrue.includes(true):istrueEdit.includes(true);

        //If True === Ada Kolom Yang Kosong
        if(validation===true){
            if (params=='Add') {
                validationAdd(array)
            }else{
                validationEdit(arrayEdit)
            }
        }else{
            if (params=='Add') {
                submitAdd(array)
            }else{
                submitEdit(arrayEdit)
            }
        }
    }

    //Submit Add After Validation
    function submitAdd(array){
        if(parseInt(array[9]) <= parseInt(array[8])){
            $('#HelpJual').text('*Harga Jual Harus Lebih Besar Dari Harga Beli');
            $('#jual').addClass('is-invalid');
        }else{
            add_Barang_Masuk()
        }
    }

    //Submit Edit After Validation
    function submitEdit(array){
        if(parseInt(array[5]) <= parseInt(array[4])){
            $('#HelpEditJual').text('*Harga Jual Harus Lebih Besar Dari Harga Beli');
            $('#jual_edit').addClass('is-invalid');
        }else{
            update_Barang_Masuk()
        }
    }

    //No Struk ADD
    $('#no_struk').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpNoStruk').text('');
            $('#no_struk').removeClass('is-invalid');
            $('#no_struk').addClass('is-valid');
        }else{
            $('#HelpNoStruk').text('Masukan No Struk');
            $('#no_struk').removeClass('is-valid');
            $('#no_struk').addClass('is-invalid');
        }
    });

    //No Struk Edit
    $('#no_struk_edit').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpEditStruk').text('');
            $('#no_struk_edit').removeClass('is-invalid');
            $('#no_struk_edit').addClass('is-valid');
        }else{
            $('#HelpEditStruk').text('Masukan No Struk');
            $('#no_struk_edit').removeClass('is-valid');
            $('#no_struk_edit').addClass('is-invalid');
        }
    });

    //Pilih Barang
    $('#barang').on('change', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpBarang').text('');
            $('#barang').removeClass('is-invalid');
            $('#barang').addClass('is-valid');
        }else{
            $('#HelpBarang').text('Pilih Barang Yang Di Order');
            $('#barang').removeClass('is-valid');
            $('#barang').addClass('is-invalid');
        }
    });

    //Pilih Suplier Add
    $('#suplier').on('change', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpSuplier').text('');
            $('#suplier').removeClass('is-invalid');
            $('#suplier').addClass('is-valid');
        }else{
            $('#HelpSuplier').text('Pilih Suplier');
            $('#suplier').removseClass('is-valid');
            $('#suplier').addClass('is-invalid');
        }
    });

     //Pilih Suplier Edit
     $('#suplier_edit').on('change', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpEditSuplier').text('');
            $('#suplier_edit').removeClass('is-invalid');
            $('#suplier_edit').addClass('is-valid');
        }else{
            $('#HelpEditSuplier').text('Pilih Suplier');
            $('#suplier_edit').removseClass('is-valid');
            $('#suplier_edit').addClass('is-invalid');
        }
    });

    //Jumlah Add
    $('#jumlah').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpJumlah').text('');
            $('#jumlah').removeClass('is-invalid');
            $('#jumlah').addClass('is-valid');
        }else{
            $('#HelpJumlah').text('Masukan Jumlah');
            $('#jumlah').removeClass('is-valid');
            $('#jumlah').addClass('is-invalid');
        }
    });

    //Jumlah Edit
    $('#jumlah_edit').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpEditJumlah').text('');
            $('#jumlah_edit').removeClass('is-invalid');
            $('#jumlah_edit').addClass('is-valid');
        }else{
            $('#HelpEditJumlah').text('Masukan Jumlah');
            $('#jumlah_edit').removeClass('is-valid');
            $('#jumlah_edit').addClass('is-invalid');
        }
    });

    //Beli Add
    $('#beli').on('input', function() {
        data=this.value

        //Set 10% Harga Jual
        var hargabeli=(parseInt(data)*(10/100))+parseInt(data);

        if(data!==''||null){
            $('[name="jual"]').val(Math.round(hargabeli));
            $('#HelpBeli').text('');
            $('#beli').removeClass('is-invalid');
            $('#beli').addClass('is-valid');
        }else{
            $('#HelpBeli').text('Masukan Harga Beli');
            $('#beli').removeClass('is-valid');
            $('#beli').addClass('is-invalid');
        }
    });


    //Beli Edit
    $('#beli_edit').on('input', function() {
        data=this.value

        //Set 10% Harga Jual
        var hargabeli=(parseInt(data)*(10/100))+parseInt(data);

        if(data!==''||null){
            $('#jual_edit').val(Math.round(hargabeli));
            $('#HelpEditBeli').text('');
            $('#beli_edit').removeClass('is-invalid');
            $('#beli_edit').addClass('is-valid');
        }else{
            $('#HelpEditBeli').text('Masukan Harga Beli');
            $('#beli_edit').removeClass('is-valid');
            $('#beli_edit').addClass('is-invalid');
        }
    });

    //Jual
    $('#jual').on('input', function() {
        data=this.value

        //Get Value Harga Beli
        var beli= $('#beli').val();
        var hargabeli=(parseInt(beli)*(10/100))+parseInt(beli);

        if(data!==''||null){
            if(parseInt(data) < Math.round(hargabeli) ){
                $('#jual').val(Math.round(hargabeli));
                $('#HelpJual').text('Harga Jual Harus 10% dari harga beli');
                $('#jual').addClass('is-invalid');
                $('#jual').removeClass('is-valid');
            }else{
                $('#HelpJual').text('');
                $('#jual').removeClass('is-invalid');
                $('#jual').addClass('is-valid');
            }
        }else{

            $('#HelpJual').text('Masukan Harga Jual');
            $('#jual').removeClass('is-valid');
            $('#jual').addClass('is-invalid');
            
        }
    });

    //Jual Edit
    $('#jual_edit').on('input', function() {
        data=this.value

        var beli= $('#beli_edit').val();
        var hargabeli=(parseInt(beli)*(10/100))+parseInt(beli);

        if(data!==''||null){

            if(parseInt(data) < Math.round(hargabeli) ){
                $('#jual_edit').val(Math.round(hargabeli));
                $('#HelpEditJual').text('Harga Jual Harus 10% dari harga beli');
                $('#jual_edit').addClass('is-invalid');
                $('#jual_edit').removeClass('is-valid');
            }else{
                $('#HelpEditJual').text('');
                $('#jual_edit').removeClass('is-invalid');
                $('#jual_edit').addClass('is-valid');
            }

        }else{
            $('#HelpEditJual').text('Masukan Harga Jual');
            $('#jual_edit').removeClass('is-valid');
            $('#jual_edit').addClass('is-invalid');
        }
    });

    //Handle Clear From Warning
    function clearForm(){
        $('#HelpNoStruk').text('');
        $('#no_struk').removeClass('is-invalid');
        $('#no_struk').removeClass('is-valid');

        $('#HelpEditStruk').text('');
        $('#no_struk_edit').removeClass('is-valid');
        $('#no_struk_edit').removeClass('is-invalid');
        //-----------------------------------------------

        $('#HelpBarang').text('');
        $('#barang').removeClass('is-invalid');
        $('#barang').removeClass('is-valid');

        $('#HelpSuplier').text('');
        $('#suplier').removeClass('is-invalid');
        $('#suplier').removeClass('is-valid');

        $('#HelpEditSuplier').text('');
        $('#suplier_edit').removeClass('is-invalid');
        $('#suplier_edit').removeClass('is-valid');
        //-------------------------------------------------

        $('#HelpJumlah').text('');
        $('#jumlah').removeClass('is-invalid');
        $('#jumlah').removeClass('is-valid');

        $('#HelpEditJumlah').text('');
        $('#jumlah_edit').removeClass('is-invalid');
        $('#jumlah_edit').removeClass('is-valid');
        //------------------------------------------------

        $('#HelpBeli').text('');
        $('#beli').removeClass('is-invalid');
        $('#beli').removeClass('is-valid');

        $('#HelpEditBeli').text('');
        $('#beli_edit').removeClass('is-invalid');
        $('#beli_edit').removeClass('is-valid');
        //---------------------------------------------------

        $('#HelpJual').text('');
        $('#jual').removeClass('is-invalid');
        $('#jual').removeClass('is-valid');

        $('#HelpEditJual').text('');
        $('#jual_edit').removeClass('is-invalid');
        $('#jual_edit').removeClass('is-valid');
    }
    // ------------  End Validation Form ------------------------


    //Handle Add Barang
    function add_Barang_Masuk()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/barang_masuk/post'?>';
        // ajax adding data to database
        var formData = new FormData($('#addform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){   
                if(data.status===true){
                    get_Order_Barang()
                    get_Suplier()
                    get_Barang_Masuk()
                    $('#modalAdd').modal('hide')
                }
            }
        })
    }

    //Handle Add Barang
    function update_Barang_Masuk()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/barang_masuk/updateDetBarangMasuk'?>';
        // ajax adding data to database
        var formData = new FormData($('#editform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){   
                if(data.status===true){
                    get_Order_Barang()
                    get_Suplier()
                    get_Barang_Masuk()
                    $('#modalEdit').modal('hide')
                }
            }
        })
    }

    // //Handle Delete
    // function delete_Barang()
    // { 
    //     var url;
    //     url = '<?php echo  base_url().'index.php/gudang/barang/delete'?>';
    //     // ajax adding data to database
    //     var formData = new FormData($('#deleteform')[0]);
    //     $.ajax({
    //         url : url,
    //         type: "POST",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success : function(data){   
    //             if(data.status===true){
    //                 get_Barang_Masuk()
    //                 $('#modaldelete').modal('hide')
    //             }
    //         }
    //     })
    // }

</script>
