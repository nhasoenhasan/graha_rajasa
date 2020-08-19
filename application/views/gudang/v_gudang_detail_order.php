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
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/gudang/index'?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/gudang_order'?>">Order Barang</a></li>
                <li class="breadcrumb-item active">Detail Order Barang</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h1 class="h3">Detail Order</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" onclick="saveCart()" class="btn btn-success mb-2 "><span data-feather="send" style="width:1rem" class="mr-2"></span>Kirim Pimpinan</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Nama Barang</th>
            <th scope="col" class="text-center">Supplier</th>
            <th scope="col" class="text-center">Qty</th>
            <th scope="col" class="text-center">Harga Beli</th>
            <th scope="col" class="text-center">Sub Total</th>
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
            <label for="exampleInputEmail1">Nama Barang</label>
            <input name="barang" type="text"  readonly class="form-control " id="barang" aria-describedby="emailHelp" placeholder="Masuikan Nama Barang" require>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Suplier</label>
            <select name="suplier" class="form-control" id="suplier">
                
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah</label>
            <input name="qty" type="number" class="form-control" id="qty" aria-describedby="emailHelp" placeholder="Masukan Jumlah">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_cart()">Add</button>
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
        get_Chart()
    });  

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Chart() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang_detail_order/getChart'?>',
            async : false,
            dataType : 'json',
            success : function(d){
                var data=Object.values(d);
                var html = '';
                var i;
                
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center" scope="row">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].name+'</td>'+
                            '<td class="text-center">'+data[i].options.supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+
                                '<div class="row justify-content-center" role="group" >'+
                                    '<a href="javascript:;" class="btn btn-primary add-cart" data="'+data[i].rowid+','+data[i].qty+'" type="button"><span class="fas fa-plus fa-sm" style="color:#ffff"></span></a>'+
                                    '<div style="width:2rem" class="justify-content-center align-content-center">'+
                                        '<p>'+data[i].qty+'</p>'+
                                    '</div>'+
                                    '<a href="javascript:;" class="btn btn-primary sub-cart" data="'+data[i].rowid+','+data[i].qty+'" type="button"><span class="fas fa-minus fa-sm" style="color:#ffff"></span></a>'+
                                '</div>'+
                            '</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].price+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].subtotal+'</td>'+
                            '<td class="text-center">'+
                            '<a href="javascript:;" class="btn btn-danger del-cart" data="'+data[i].rowid+'" type="button"><span class="fas fa-trash-alt fa-sm" style="color:#ffff"></span></a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //Handle Add Cart
    $('#show_data').on('click','.add-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/gudang_detail_order/addChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0],qty:parseInt(data[1])},
            dataType: "JSON",
            success : function(data){ 
                if(data.status===true){
                    get_Chart()
                }
            }
        })
    });

    //Handle Sub Cart
    $('#show_data').on('click','.sub-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/gudang_detail_order/subChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0],qty:parseInt(data[1])},
            dataType: "JSON",
            success : function(data){  
                if(data.status===true){
                    get_Chart()
                }
            }
        })
    });

    //Handle Delete Cart
    $('#show_data').on('click','.del-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/gudang_detail_order/delChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0]},
            dataType: "JSON",
            success : function(data){  
                if(data.status===true){
                    get_Chart()
                }
            }
        })
    });


    //Handle Save Cart To Database
    function saveCart(){
        var url;
        url = '<?php echo  base_url().'index.php/gudang_detail_order/isChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: '',
            dataType: "JSON",
            success : function(data){  
                if(data.status===true){
                    get_Chart()
                }
            }
        })
    }

</script>

