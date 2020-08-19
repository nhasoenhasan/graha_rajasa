<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3  mb-1">
        <nav aria-label="breadcrumb" style="margin-left:-0.8rem">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/gudang_home'?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Order Barang</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
        <h1 class="h3">Order Barang</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?php echo  base_url().'index.php/gudang_detail_order'?>" class="btn btn-secondary"   >
            <span id="chartTotal" class="badge badge-danger mr-2"><?php echo $this->cart->total_items()?></span><span data-feather="shopping-cart"></span>   Detail Order
            </a>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Nama Barang</th>
            <th scope="col" class="text-center">Stock</th>
            <th scope="col" class="text-center">Harga Beli</th>
            <th scope="col" class="text-center">Harga Jual</th>
            <th scope="col" class="text-center">Suplier</th>
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
            <input name="id_barang" type="hidden" class="form-control " id="id_barang">
            <input name="beli" type="hidden" class="form-control " id="beli">
            <input name="jual" type="hidden" class="form-control " id="jual">
            <input name="supplier_name" type="hidden" class="form-control " id="supplier_name">
            <label for="exampleInputEmail1">Nama Barang</label>
            <input name="barang" type="text"  readonly class="form-control " id="barang" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang" require>
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
            <input name="qty" type="number" class="form-control" id="qty" aria-describedby="emailHelp" placeholder="Masukan Jumlah">
            <small id="HelpQty" class="form-text text-danger ml-1">
            </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validation()">Add</button>
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
        $('#addform')[0].reset();
        $('#ModalLabel').text('Tambah Barang');
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_order',function(){
        clearForm()
        $('#ModalLabel').text('Order Barang');
        $('#addform')[0].reset();
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="id_barang"]').val(id[0]);
        $('[name="suplier"]').val(id[1]);
        $('[name="barang"]').val(id[2]);
        $('[name="stok"]').val(id[3]);
        $('[name="beli"]').val(id[4]);
        $('[name="jual"]').val(id[5]);
        $('[name="supplier_name"]').val(id[7]);
        $('#modalAdd').modal('show')
    });

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Barang() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang_barang/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center" scope="row">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].nama_barang+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].stok+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].harga_beli+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].harga_jual+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama+'</td>'+
                            '<td class="text-center">'+
                                '<a  href="javascript:;" class="btn btn-success item_order btn-xs" data="'+data[i].id_barang+','+data[i].id_supplier+','+data[i].nama_barang+','+data[i].stok+','+data[i].harga_beli+','+data[i].harga_jual+','+data[i].deskripsi+','+data[i].nama+'" ><span class="fas fa-cart-plus" style="color:white"></span></a>'
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
            url   : '<?php echo  base_url().'index.php/gudang_suplier/get'?>',
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

    //--------- Form Validation ----------------- 
    //Pilih Suplier Add
    $('#suplier').on('change', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpSuplier').text('');
            $('#suplier').removeClass('is-invalid');
            $('#suplier').addClass('is-valid');
        }else{
            $('#HelpSuplier').text('Silahkan Pilih Suplier');
            $('#suplier').removseClass('is-valid');
            $('#suplier').addClass('is-invalid');
        }
    });

    //Stok
    $('#qty').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpQty').text('');
            $('#qty').removeClass('is-invalid');
            $('#qty').addClass('is-valid');
        }else{
            $('#HelpQty').text('Masukan Jumlah');
            $('#qty').removeClass('is-valid');
            $('#qty').addClass('is-invalid');
        }
    });


    //Handle Validation Form Modal
    function validation(){
        var array=[$("#suplier").val(),$("#qty").val()];
        var isnull = array.includes(null);
        var isempty=array.includes("");
        var istrue=[isnull,isempty];

        var validation=istrue.includes(true);

        //If True === Ada Kolom Yang Kosong
        if(validation===true){
            validationForm(array)
        }else{
            add_cart()
        }
    }

    //Form Validation
    function validationForm(array){
        if (array[0]==null) {
            $('#HelpSuplier').text('Silahkan Pilih Suplier');
            $('#suplier').addClass('is-invalid');
        }
        if (array[1]=="") {
            $('#HelpQty').text('Masukan Jumlah');
            $('#qty').addClass('is-invalid');
        }
    }

    function clearForm(){
        $('#HelpSuplier').text('');
        $('#suplier').removeClass('is-invalid');
        $('#suplier').removeClass('is-valid');

        $('#HelpQty').text('');
        $('#qty').removeClass('is-invalid');
        $('#qty').removeClass('is-valid');
    }

    //Handle Add Barang
    function add_cart()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang_order/cart'?>';
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
                    $('#modalAdd').modal('hide')
                    $('#chartTotal').text(data.total)
                    get_Barang()
                }
            }
        })
    }
</script>
