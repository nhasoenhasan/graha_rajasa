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
                <li class="breadcrumb-item active">Data Barang Masuk</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Barang Masuk</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Nota</th>
            <th scope="col" class="text-center">Nama Barang</th>
            <th scope="col" class="text-center">Harga Barang</th>
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
      <form id="addform">
        <!-- <input name="id_barang_masuk" type="hidden" class="form-control " id="id_barang_masuk"> -->
        <input name="id_barang" type="hidden" class="form-control " id="id_barang">
        <input name="id_det_order_brg" type="hidden" class="form-control " id="id_det_order_brg">
        <input name="nama_barang" id="nama_barang" type="hidden" class="form-control ">
        <input name="nama_supplier" id="nama_supplier" type="hidden" class="form-control ">
        <div class="form-group">
            <label for="exampleInputEmail1">No Struk</label>
            <input name="no_struk" type="text" class="form-control" id="no_struk" placeholder="No Struk">
        </div>
        <div class="form-group" id="modal_update_barang_masuk" >
            <label for="exampleInputEmail1">Pilih Barang Yang Di Order</label>
            <select name="barang" id="barang" class="form-control" >
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Suplier</label>
            <select name="suplier" class="form-control" id="suplier">
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" id="jumlah" placeholder="Masukan Jumlah">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Beli</label>
            <input name="beli" type="number" class="form-control" id="beli"  placeholder="Masuikan Harga Beli">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Jual</label>
            <input name="jual" type="number" class="form-control" id="jual" placeholder="Masuikan Harga Jual">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_Barang_Masuk()">Save</button>
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
        <input name="id_barang_masuk" type="text" class="form-control " id="id_barang_masuk_edit">
        <input name="id_barang" type="text" class="form-control " id="id_barang_edit">
        <input name="id_det_order_brg" type="text" class="form-control " id="id_det_order_brg_edit">
        <input name="nama_barang" id="nama_barang_edit" type="text" class="form-control ">
        <input name="nama_supplier" id="nama_supplier_edit" type="text" class="form-control ">
        <div class="form-group">
            <label for="exampleInputEmail1">No Struk</label>
            <input name="no_struk" type="text" class="form-control" id="no_struk_edit" placeholder="No Struk">
        </div>
        <div class="form-group" id="modal_update_barang_masuk" >
            <label for="exampleInputEmail1">Nama Barang</label>
            <input name="barang_edit" type="text" class="form-control" id="barang_edit" placeholder="Nama Barang">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Suplier</label>
            <select name="suplier_edit" class="form-control" id="suplier_edit">
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" id="jumlah_edit" placeholder="Masukan Jumlah">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Beli</label>
            <input name="beli" type="number" class="form-control" id="beli_edit"  placeholder="Masuikan Harga Beli">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Jual</label>
            <input name="jual" type="number" class="form-control" id="jual_edit" placeholder="Masuikan Harga Jual">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update_Barang_Masuk()">Save</button>
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

    //Handle Modal Add Barang
    function modaladd(params) {
        $('#ModalLabel').text('Tambah Barang Masuk');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    $('#show_data').on('click','.item_edit',function(){
        var id=$(this).attr('data');
        id=id.split(',');
        $('[name="beli"]').val(id[0]);
        $('[name="id_barang"]').val(id[1]);
        $('[name="id_det_order_brg"]').val(id[2]);
        $('[name="suplier_edit"]').val(id[3]+'|'+id[6]);
        $('[name="jumlah"]').val(id[4]);
        $('[name="nama_barang"]').val(id[5]);
        $('#barang_edit').val(id[5]);
        $('[name="nama_supplier"]').val(id[6]);
        $('[name="no_struk"]').val(id[6]);
        $('[name="id_barang_masuk"]').val(id[9]);
        $('#modalEdit').modal('show')
    });

    //On Change Select Pilih Data Order Barang
    $('#barang').on('change', function() {
        data=this.value
        data=data.split('=');
        $('[name="id_supplier"]').val(data[0]);
        $('[name="id_barang"]').val(data[1]);
        $('[name="id_det_order_brg"]').val(data[2]);
        $('[name="jumlah"]').val(data[5]);
        $('[name="nama_barang"]').val(data[3]);
        $('[name="nama_supplier"]').val(data[8]);
        $('[name="jual"]').val(data[7]);
        $('[name="beli"]').val(data[6]);
        $("#suplier").val(data[0]+'|'+data[8]);
    });

    //On Change Select Pilih Data Supplier
    $('#suplier').on('change', function() {
        data=this.value
        data=data.split('|');
        $('[name="nama_supplier"]').val(data[1]);

    });

     //Edit On Change Select Pilih Data Supplier
     $('#suplier_edit').on('change', function() {
        data=this.value
        console.log(data);
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
                            '<td style="word-break: break-all;" class="text-center">'+data[i].nama_supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].jumlah+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">Rp.'+data[i].subtotal+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].tanggal_masuk+'</td>'+
                            '<td class="text-center">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].harga_beli+','+data[i].id_barang+','+data[i].id_det_barang_masuk+','+data[i].id_supplier+','+data[i].jumlah+','+data[i].nama_barang+','+data[i].nama_supplier+','+data[i].no_struk+','+data[i].subtotal+','+data[i].id_barang_masuk+'" >+</a>'+' '+
                                '<a onclick="modalhapus('+data[i].id_barang+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_barang+'">D</a>'+
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
                var html = '<option value="" selected disabled>Please select</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id_supplier+'='+data[i].id_barang+'='+data[i].id_det_order_brg+'='+data[i].nama_barang+'='+data[i].subtotal+'='+data[i].jumlah+'='+data[i].harga_beli+'='+data[i].harga_jual+'='+data[i].nama_supplier+'>'+data[i].nama_barang+'</option>'
                    // html += '<option value='+data[i].nama_supplier+'>'+data[i].nama_barang+'</option>'
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
                    html += '<option value='+data[i].id_supplier+'|'+data[i].nama+'>'+data[i].nama+'</option>'
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
                    html += '<option value='+data[i].id_supplier+'|'+data[i].nama+'>'+data[i].nama+'</option>'
                }
                $('#suplier_edit').html(html);
            }
        });
    }

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
                    $('#modalAdd').modal('hide')
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
