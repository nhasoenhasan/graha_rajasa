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
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/gudang/index'?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Barang</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Barang</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stock</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Suplier</th>
            <th scope="col">Action</th>
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
      <form id="addform">
        <div class="form-group">
            <input name="id_barang" type="hidden" class="form-control " id="id_barang">
            <label for="exampleInputEmail1">Nama Barang</label>
            <input name="barang" type="text" class="form-control " id="barang" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang" require>
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
            <label for="exampleInputEmail1">Stok</label>
            <input name="stok" type="number" class="form-control" id="stok" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang">
            <small id="HelpStok" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Beli</label>
            <input name="beli" type="number" class="form-control" id="beli" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang">
            <small id="HelpBeli" class="form-text text-danger ml-1">
            </small>        
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Jual</label>
            <input name="jual" type="number" class="form-control" id="jual" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang">
            <small id="HelpJual" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validation()">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Add Barang -->

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
        get_Barang()
        get_Suplier()
    });  

    //Handle Modal Add Barang
    function modaladd(params) {
        clearForm()
        $('#ModalLabel').text('Tambah Barang');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        clearForm()
        $('#ModalLabel').text('Edit Barang');
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="id_barang"]').val(id[0]);
        $('[name="suplier"]').val(id[1]);
        $('[name="barang"]').val(id[2]);
        $('[name="stok"]').val(id[3]);
        $('[name="beli"]').val(id[4]);
        $('[name="jual"]').val(id[5]);
        $('[name="deskripsi"]').val(id[6]);
        $('#modalAdd').modal('show')
    });

    //Handle Modal Add Barang
	function modalhapus(id) {
        $('#modaldelete').modal('show');
        $('[name="id_barang"]').val(id);
    }

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Barang() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/barang/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>'+data[i].nama_barang+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].stok+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].harga_beli+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].harga_jual+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].nama+'</td>'+
                            '<td style="text-align:right;">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].id_barang+','+data[i].id_supplier+','+data[i].nama_barang+','+data[i].stok+','+data[i].harga_beli+','+data[i].harga_jual+','+data[i].deskripsi+'" >+</a>'+' '+
                                '<a onclick="modalhapus('+data[i].id_barang+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_barang+'">D</a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //Get Data Suplier
    function get_Suplier() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/suplier/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '<option value="" selected disabled>Please select</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id_supplier+'>'+data[i].nama+'</option>'
                }
                $('#suplier').html(html);
            }
        });
    }

    //---------------- Validation ------------------------
     //Input Barang
     $('#barang').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpBarang').text('');
            $('#barang').removeClass('is-invalid');
            $('#barang').addClass('is-valid');
        }else{
            $('#HelpBarang').text('Masukan Nama Barang');
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

    //Stok
    $('#stok').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpStok').text('');
            $('#stok').removeClass('is-invalid');
            $('#stok').addClass('is-valid');
        }else{
            $('#HelpStok').text('Masukan Jumlah Stok');
            $('#stok').removeClass('is-valid');
            $('#stok').addClass('is-invalid');
        }
    });

     //Beli Add
     $('#beli').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpBeli').text('');
            $('#beli').removeClass('is-invalid');
            $('#beli').addClass('is-valid');
        }else{
            $('#HelpBeli').text('Masukan Harga Beli');
            $('#beli').removeClass('is-valid');
            $('#beli').addClass('is-invalid');
        }
    });

    //Jual
    $('#jual').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpJual').text('');
            $('#jual').removeClass('is-invalid');
            $('#jual').addClass('is-valid');
        }else{
            $('#HelpJual').text('Masukan Harga Jual');
            $('#jual').removeClass('is-valid');
            $('#jual').addClass('is-invalid');
        }
    });

    function validation(){
        var array=[$("#barang").val(),$("#suplier").val(),$("#stok").val(),$("#beli").val(),$("#jual").val()];
        var keterangan=$('#id_barang').val()
        var isnull = array.includes(null);
        var isempty=array.includes("");
        var istrue=[isnull,isempty];

        var validation=istrue.includes(true);

        //If True === Ada Kolom Yang Kosong
        if(validation===true){
            validationForm(array)
        }else{
            //Cek Harga Jual >= Harga Beli
            if (parseInt(array[4])<=parseInt(array[3])) {
                $('#HelpJual').text('*Harga Jual Harus Lebih Besar Dari Harga Beli');
                $('#jual').addClass('is-invalid');
            }else{
                add_Barang()
            }
        }
    }

    function validationForm(array){
        if (array[0]=="") {
            $('#HelpBarang').text('Masukan Nama Barang');
            $('#barang').addClass('is-invalid');
        }
        if (array[1]==null) {
            $('#HelpSuplier').text('Pilih Suplier');
            $('#suplier').addClass('is-invalid');
        }
        if (array[2]=="" || null) {
            $('#HelpStok').text('Masukan Jumlah Stok');
            $('#stok').addClass('is-invalid');
        }
        if (array[3]=="" || null) {
            $('#HelpBeli').text('Masukan Harga Beli');
            $('#beli').addClass('is-invalid');
        }
        if (array[4]=="" || null) {
            $('#HelpJual').text('Masukan Harga Jual');
            $('#jual').addClass('is-invalid');
        }
    }

    //Handle Clear From Warning
    function clearForm(){
        $('#HelpBarang').text('');
        $('#barang').removeClass('is-invalid');
        $('#barang').removeClass('is-valid');

        $('#HelpSuplier').text('');
        $('#suplier').removeClass('is-invalid');
        $('#suplier').removeClass('is-valid');

        $('#HelpStok').text('');
        $('#stok').removeClass('is-invalid');
        $('#stok').removeClass('is-valid');

        $('#HelpBeli').text('');
        $('#beli').removeClass('is-invalid');
        $('#beli').removeClass('is-valid');

        $('#HelpJual').text('');
        $('#jual').removeClass('is-invalid');
        $('#jual').removeClass('is-valid');
    }

    //Handle Add Barang
    function add_Barang()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/barang/post'?>';
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
                    get_Barang()
                    $('#modalAdd').modal('hide')
                }
            }
        })
    }

    //Handle Delete
    function delete_Barang()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/barang/delete'?>';
        // ajax adding data to database
        var formData = new FormData($('#deleteform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){   
                if(data.status===true){
                    get_Barang()
                    $('#modaldelete').modal('hide')
                }
            }
        })
    }

</script>
