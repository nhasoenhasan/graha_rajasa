<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Suplier</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Suplier</th>
            <th scope="col">Alamat</th>
            <th scope="col">Email</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Action</th>
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
            <label for="exampleInputEmail1">Nama Supplier</label>
            <input name="nama" type="text" class="form-control " id="nama" aria-describedby="emailHelp" placeholder="Masukan Nama Suplier" require>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukan E-mail">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">No Telephone</label>
            <input name="telp" type="number" class="form-control" id="telp" placeholder="Masukan No Telephone">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_Supplier()">Save</button>
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
        $('#ModalLabel').text('Tambah Supplier');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        $('#ModalLabel').text('Edit Supplier');
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="id_supplier"]').val(id[0]);
        $('[name="nama"]').val(id[1]);
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
                            '<td>'+(i+1)+'</td>'+
                            '<td>'+data[i].nama+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].alamat+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].email+'</td>'+
                            '<td style="word-break: break-all;">'+data[i].no_telp+'</td>'+
                            '<td style="text-align:center;">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].id_supplier+','+data[i].nama+','+data[i].alamat+','+data[i].email+','+data[i].no_telp+'" >+</a>'+' '+
                                '<a onclick="modalhapus('+data[i].id_supplier+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_supplier+'">D</a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

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
