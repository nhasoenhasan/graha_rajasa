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
                <li class="breadcrumb-item active" >Dashboard</li>
                <li class="breadcrumb-item active">Data User</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="row ml-1">
            <h1 class="h2">Data User</h1>
            <!-- <a target="_blank" href="<?php echo  base_url().'index.php/gudang_barang/cetak'?>" class="btn btn-primary ml-3"  ><span data-feather="printer"></span></a>     -->
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Nama Lengkap</th>
                <th scope="col" class="text-center">Hak Akses</th>
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
      <form id="addform">
        <div class="form-group">
            <input name="id_user" type="hidden" class="form-control " id="id_user">
            <input name="username_old" type="hidden" class="form-control " id="username_old">
            <label for="exampleInputEmail1">Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control " id="nama_lengkap" aria-describedby="emailHelp" placeholder="Masukan Nama Lengkap" require>
            <small id="HelpNama" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input name="username" type="text" class="form-control " id="username" aria-describedby="emailHelp" placeholder="Masukan Username" require>
            <small id="HelpUsername" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" id="labelPassword">Password</label>
            <input name="password" type="password" class="form-control " id="password" aria-describedby="emailHelp" placeholder="Masukan Password" require>
            <small id="HelpPassword" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Hak Akses</label>
            <select name="level" class="form-control" id="level">
                <option value="" selected disabled>Please select</option>
                <option value='kasir'>Kasir</option>
                <option value='gudang'>Gudang</option>
                <option value='pimpinan'>Pimpinan</option>
            </select>
            <small id="HelpLevel" class="form-text text-danger ml-1">
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
                <input type="hidden" name="id_user" value="">
                <img src="<?php echo base_url(); ?>assets/images/trash-2.svg" alt="Trash">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="delete_User()">Delete</button>
        </div>
    </div>
  </div>
</div>
<!-- End Modal Delete Barang -->

<script  type="text/javascript">

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_User()
        // get_Suplier()
    });  

    //Handle Modal Add User
    function modaladd(params) {
        $('#labelPassword').show();
        $('#password').show();
        clearForm()
        $('#ModalLabel').text('Tambah User');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        clearForm()
        $('#labelPassword').hide();
        $('#password').hide();
        $('#ModalLabel').text('Edit User');
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="id_user"]').val(id[0]);
        $('[name="username"]').val(id[1]);
        $('[name="username_old"]').val(id[1]);
        $('[name="nama_lengkap"]').val(id[2]);
        $('[name="level"]').val(id[3]);
        $('#modalAdd').modal('show')
    });

    //Handle Modal Add Barang
	function modalhapus(id) {
        $('#modaldelete').modal('show');
        $('[name="id_user"]').val(id);
    }

    //Icon Feather
    feather.replace()

    //Get Data User
    function get_User() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/pimpinan_user/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].username+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].nama_lengkap+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].level+'</td>'+
                            '<td style="text-align:center;">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].id_user+','+data[i].username+','+data[i].nama_lengkap+','+data[i].level+'" ><span class="fas fa-pencil-alt" style="color:white"></span></a>'+' '+
                                '<a onclick="modalhapus('+data[i].id_user+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_user+'"><span class="fas fa-trash-alt" style="color:white"></span></a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //---------------- Validation ------------------------
     //Nama Lengkap
     $('#nama_lengkap').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpNama').text('');
            $('#nama_lengkap').removeClass('is-invalid');
        }else{
            $('#HelpNama').text('Masukan Nama Lengkap');
            $('#nama_lengkap').addClass('is-invalid');
        }
    });

    //Hak Akses
    $('#level').on('change', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpLevel').text('');
            $('#level').removeClass('is-invalid');
        }else{
            $('#HelpLevel').text('Pilih Hak Akses');
            $('#level').addClass('is-invalid');
        }
    });

    //Username
    $('#username').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpUsername').text('');
            $('#username').removeClass('is-invalid');
        }else{
            $('#HelpUsername').text('Masukan Username');
            $('#username').addClass('is-invalid');
        }
    });

    //Password
    $('#password').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpPassword').text('');
            $('#password').removeClass('is-invalid');
        }else{
            $('#HelpPassword').text('Masukan Password');
            $('#password').addClass('is-invalid');
        }
    });

    function validation(){
        var array=[$("#nama_lengkap").val(),$("#username").val(),$("#level").val(),$("#password").val()];
        var array2=[$("#nama_lengkap").val(),$("#username").val(),$("#level").val()];

        var keterangan=$("#id_user").val();

        //For Insert
        var isnull = array.includes(null);
        var isempty=array.includes("");
        var istrue=[isnull,isempty];

        //For Update
        var isnull2 = array2.includes(null);
        var isempty2=array2.includes("");
        var istrue2=[isnull2,isempty2];

        var validation=istrue.includes(true);
        var validation2=istrue2.includes(true);

        //If True === Ada Kolom Yang Kosong
        if (keterangan==='') {
            if(validation===true){
                validationForm(array)
            }else{
                add_User()
            }
        }else{
            if(validation2===true){
                validationForm(array2)
            }else{
                add_User()
            }
        }


    }

    function validationForm(array){

        if (array[0]=="") {
            $('#HelpNama').text('Masukan Nama Lengkap');
            $('#nama_lengkap').addClass('is-invalid');
        }
        if (array[1]=="") {
            $('#HelpUsername').text('Masukan Username');
            $('#username').addClass('is-invalid');
        }
        if (array[2]==null) {
            $('#HelpLevel').text('Pilih Hak Akses');
            $('#level').addClass('is-invalid');
        }
        if (array[3]=='') {
            $('#HelpPassword').text('Masukan Password');
            $('#password').addClass('is-invalid');
        }
    }

    //Handle Clear From Warning
    function clearForm(){
        $('#HelpNama').text('');
        $('#nama_lengkap').removeClass('is-invalid');

        $('#HelpUsername').text('');
        $('#username').removeClass('is-invalid');

        $('#HelpLevel').text('');
        $('#level').removeClass('is-invalid');

        $('#HelpPassword').text('');
        $('#password').removeClass('is-invalid');
    }

    //Handle Add Barang
    function add_User()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/pimpinan_user/post'?>';
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
                    get_User()
                    $('#modalAdd').modal('hide')
                }
                if (data.message==='exist') {
                    $('#HelpUsername').text('*Username sudah digunakan');
                    $('#username').addClass('is-invalid');
                }
            }
        })
    }

    //Handle Delete
    function delete_User()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/pimpinan_user/delete'?>';
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
                    get_User()
                    $('#modaldelete').modal('hide')
                }
            }
        })
    }

</script>
