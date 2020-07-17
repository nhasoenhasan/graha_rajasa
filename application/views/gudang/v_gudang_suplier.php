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
                <li class="breadcrumb-item active">Data Suplier</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
        <div class="row ">
            <h1 class="h2">Data Suplier</h1>
            <a target="_blank" href="<?php echo  base_url().'index.php/gudang/suplier/cetak'?>" class="btn btn-primary ml-3"  ><span data-feather="printer"></span></a>    
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Nama Suplier</th>
            <th scope="col" class="text-center">Alamat</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">No Telepon</th>
            <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</main>

<!-- Modal Add -->
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
            <input name="id_supplier" type="hidden" class="form-control " id="id_supplier">
            <input name="nama_supplier" type="hidden" class="form-control " id="nama_supplier">
            <label for="exampleInputEmail1">Nama Supplier</label>
            <input name="nama" type="text" class="form-control " id="nama" aria-describedby="emailHelp" placeholder="Masukan Nama Suplier" require>
            <small id="HelpSuplier" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
            <small id="HelpAlamat" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukan E-mail">
            <small id="HelpEmail" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">No Telephone</label>
            <input name="telp" type="number" class="form-control" id="telp" placeholder="Masukan No Telephone">
            <small id="HelpTelp" class="form-text text-danger ml-1">
            </small>
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
<!-- End Modal Add -->

<!-- Modal Delete -->
<div class="modal fade bd-example-modal-sm" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content ">
        <div class="modal-header justify-content-center">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Supplier</h5>
        </div>
        <div class="modal-body mx-auto">
            <form id="deleteform">
                <input type="hidden" name="id_supplier" value="">
                <img src="<?php echo base_url(); ?>assets/images/trash-2.svg" alt="Trash">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="delete_Supplier()">Delete</button>
        </div>
    </div>
  </div>
</div>
<!-- End Modal Delete -->

<script  type="text/javascript">

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Supplier()
    });  

    //Handle Modal Add Barang
    function modaladd(params) {
        clearForm()
        $('#ModalLabel').text('Tambah Supplier');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        $('#ModalLabel').text('Edit Supplier');
        clearForm()
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="id_supplier"]').val(id[0]);
        $('[name="nama"]').val(id[1]);
        $('[name="nama_supplier"]').val(id[1]);
        $('[name="alamat"]').val(id[2]);
        $('[name="email"]').val(id[3]);
        $('[name="telp"]').val(id[4]);
        $('#modalAdd').modal('show')
    });

    //Handle Modal Add Barang
	function modalhapus(id) {
        $('#modaldelete').modal('show');
        $('[name="id_supplier"]').val(id);
    }

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Supplier() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang/suplier/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].nama+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].alamat+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].email+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].no_telp+'</td>'+
                            '<td class="text-center" style="text-align:center;">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].id_supplier+','+data[i].nama+','+data[i].alamat+','+data[i].email+','+data[i].no_telp+'" ><span class="fas fa-pencil-alt" style="color:white"></span></a>'+' '+
                                '<a onclick="modalhapus('+data[i].id_supplier+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_supplier+'"><span class="fas fa-trash-alt" style="color:white"></span></a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    // ------------------- Validation Form -----------------------------
    //Input Nama Suplier
    $('#nama').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpSuplier').text('');
            $('#nama').removeClass('is-invalid');
            $('#nama').addClass('is-valid');
        }else{
            $('#HelpSuplier').text('Masukan Nama Suplier');
            $('#nama').removeClass('is-valid');
            $('#nama').addClass('is-invalid');
        }
    });

    //Input Alamat
    $('#alamat').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpAlamat').text('');
            $('#alamat').removeClass('is-invalid');
            $('#alamat').addClass('is-valid');
        }else{
            $('#HelpAlamat').text('Masukan Alamat');
            $('#alamat').removeClass('is-valid');
            $('#alamat').addClass('is-invalid');
        }
    });

    //Input Email
    $('#email').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpEmail').text('');
            $('#email').removeClass('is-invalid');
            $('#email').addClass('is-valid');
        }else{
            $('#HelpEmail').text('Masukan Email');
            $('#email').removeClass('is-valid');
            $('#email').addClass('is-invalid');
        }
    });

    //Input No Telephone
    $('#telp').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpTelp').text('');
            $('#telp').removeClass('is-invalid');
            $('#telp').addClass('is-valid');
        }else{
            $('#HelpTelp').text('Masukan No Telephone');
            $('#telp').removeClass('is-valid');
            $('#telp').addClass('is-invalid');
        }
    });


    function validation(){
        var array=[$("#nama").val(),$("#alamat").val(),$("#email").val(),$("#telp").val()];
        var keterangan=$('#id_supplier').val()
        var isnull = array.includes(null);
        var isempty=array.includes("");
        var istrue=[isnull,isempty];

        var validation=istrue.includes(true);

        //If True === Ada Kolom Yang Kosong
        if(validation===true){
            validationForm(array)
        }else{
            add_Supplier()
        }
    }

    function validationForm(array){
        if (array[0]=="") {
            $('#HelpSuplier').text('Masukan Nama Suplier');
            $('#nama').addClass('is-invalid');
        }
        if (array[1]=="") {
            $('#HelpAlamat').text('Masukan Alamat');
            $('#alamat').addClass('is-invalid');
        }
        if (array[2]=="" || null) {
            $('#HelpEmail').text('Masukan Email');
            $('#email').addClass('is-invalid');
        }
        if (array[3]=="" || null) {
            $('#HelpTelp').text('Masukan No Telp');
            $('#telp').addClass('is-invalid');
        }
    }

    //Handle Clear From Warning
    function clearForm(){
        $('#HelpSuplier').text('');
        $('#nama').removeClass('is-invalid');
        $('#nama').removeClass('is-valid');

        $('#HelpAlamat').text('');
        $('#alamat').removeClass('is-invalid');
        $('#alamat').removeClass('is-valid');

        $('#HelpEmail').text('');
        $('#email').removeClass('is-invalid');
        $('#email').removeClass('is-valid');

        $('#HelpTelp').text('');
        $('#telp').removeClass('is-invalid');
        $('#telp').removeClass('is-valid');
    }

    // ---------- End Validation Form ---------------------------------
    //Handle Add 
    function add_Supplier()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/suplier/post'?>';
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
                    get_Supplier()
                    $('#modalAdd').modal('hide')
                }
                if (data.message==='exist') {
                    $('#HelpSuplier').text('*Nama Suplier Sudah Ada');
                    $('#nama').removeClass('is-valid');
                    $('#nama').addClass('is-invalid');
                }
            }
        })
    }

    //Handle Delete
    function delete_Supplier()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/suplier/delete'?>';
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
                    get_Supplier()
                    $('#modaldelete').modal('hide')
                }
            }
        })
    }

</script>
