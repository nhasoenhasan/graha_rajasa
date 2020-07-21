<style>
    .cart {
        width: 250px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kasir</h1>
        <div class="btn-toolbar mb-2 mr-3 mb-md-0" >
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row pr-4">
                <div class="col bordered" style="margin-left:-1rem">
                    <form id="dataform">
                        <div class="form-group col-md-8">
                            <label class="font-weight-bold" for="inputEmail4">Pilih Barang</label>
                                <select class="custom-select" name="barang" id="barang">
                            </select>
                            <small id="HelpBarang" class="form-text text-danger ml-1">
                            </small>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="font-weight-bold" for="inputCity">Masukan Jumlah</label>
                            <input type="number" class="form-control" name="qty" id="qty">
                            <small id="HelpQty" class="form-text text-danger ml-1">
                            </small>
                            <input type="hidden" class="form-control" name="stock" id="stock">
                            <input type="hidden" class="form-control" name="id_barang" id="id_barang">
                            <input type="hidden" class="form-control" name="price" id="price">
                            <input type="hidden" class="form-control" name="nama_barang" id="nama_barang">
                            <input type="hidden" class="form-control" name="totalSend" id="totalSend">
                            <input type="hidden" class="form-control" name="diskonSend" id="diskonSend">
                        </div>
                        <div class="form-group col-md-8">
                            <label class="font-weight-bold mr-3">Sub Total</label>
                            <label id="harga_show">0</label>
                        </div>
                    </form>
                    <div class="form-group col-md-8">
                        <button type="submit" onclick="validationAddCart()" class="btn btn-primary">Add To Cart</button>
                    </div>                                                                        
                </div>
                <div class="d-flex align-items-start flex-column align-content-md-start cart " style="height: auto;width:38rem">
                    <div class="mb-auto p-2 ">
                        <div class="mb-3 pl-2 pt-2">
                            <p class="h5">Detail Transaksi</p>
                        </div>
                        <div id="show_cart">

                        </div>
                    </div>
                    <div id=empty>
                    <div class="p-2 pl-4 mt-5 mb-5" style="margin-bottom:-0.5rem">
                        <div class="row ml-1">
                            <div style="width:7rem">
                                <p class="font-weight-bold">Subtotal</p>
                            </div>
                            <div>
                                <p class="font-weight-bold" id="total_cart">Rp.0</p>
                            </div>
                        </div>
                        <div class="row ml-1" style="margin-top:-0.4rem;magin-bottom:-4rem">
                            <div style="width:7rem">
                                <p class="font-weight-bold">Diskon<span id="kurung"></span></p>
                            </div>
                            <div>
                                <p class="font-weight-bold" id="rupiah_diskon">Rp.0</p>
                            </div>
                        </div>
                        <hr style="margin-bottom:1rem;background-color:black">
                        <div class="row ml-1">
                            <div style="width:7rem">
                                <p class="font-weight-bold">Total</p>
                            </div>
                            <div>
                                <p class="font-weight-bold" id="total_all">Rp.0</p>
                            </div>
                        </div>
                        <hr style="margin-top:-0.5rem;background-color:black">
                        <div class="row ml-1">
                            <div style="width:7rem">
                                <p class="font-weight-bold">Bayar</p>
                            </div>
                            <div class="form-group col-md-5" style="margin-left:-0.9rem">
                                <input type="text" class="form-control" id="bayar">
                            </div>
                        </div>
                        <div class="row ml-1">
                            <div style="width:7rem">
                                <p class="font-weight-bold">Kembalian</p>
                            </div>
                            <div>
                                <p class="font-weight-bold" id="kembalian">Rp.0</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark btn-sm ml-3 mb-3" data-toggle="modal" onclick="modalDiskon()">Edit Discont (%)</button>
                    <form  action="<?php echo  base_url().'index.php/kasir/kasir/cetakNota'?>" method="post" target="_blank">
                        <button type="submit"  onclick="save_Database()"class="btn btn-primary btn-lg btn-block" >SAVE</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="diskonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Diskon </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pl-5 pr-5 pb-3">
        <form id="diskonform">
            <div class="form-group">
                <label for="exampleFormControlInput1">Diskon (%)</label>
                <input type="number" class="form-control" id="edit_diskon" name="edit_diskon" placeholder="Masukan Diskon Dalam Persen (%)">
                <small id="HelpDiskon" class="form-text text-danger ml-1">
                </small>        
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validation()">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<script  type="text/javascript">
    var price=0;
    var total_cart=0;
    var diskon=0;
    var rupiah_diskon=0;
    var all=0;

    $(document).ready(function(){
        get_Barang()
        getCart()
        getDiskon()
        $('#total_cart').text('Rp. '+total_cart);
        setTotal()
        resetBayarKembalian()
    });

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
                var html = '<option value="null" selected>Please Select</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].id_barang+','+data[i].nama_barang+','+data[i].stok+','+data[i].harga_jual+'" selected>'+data[i].nama_barang+'</option>';
                }
                $('#barang').html(html);
            }
        });
    }

    //OnChange Select Barang
    $('#barang').on('change', function() {
        data=this.value

        if (data==='null') {
            price=0;
            $('#id_barang').val(null);
            $('#nama_barang').val(null);
            $('#stock').val(0);
            $('#price').val(0);
            $('#harga_show').text(0);
            $('#qty').val(0);
        }else{
            data=data.split(',');
            price=data[3];
            $('#id_barang').val(data[0]);
            $('#nama_barang').val(data[1]);
            $('#price').val(data[3]);
            $('#harga_show').text(data[3]);
            $('#stock').val(data[2]);
            $('#qty').val(1);
        }
    });

    //On Input Qty 
    $('#qty').on('input', function() {
        var stock=$("input[name=stock]").val();
        stock=parseInt(stock);
        data=this.value
        var sub_total=price;
        sub_total=price*data;
        
        if (data==='') {
            $('#HelpQty').text('Masukan Jumlah');
            $('#qty').addClass('is-invalid');
        }else{
            if(data>stock){
                $('#HelpQty').text('*Stok Tidak Tersedia');
                $('#qty').addClass('is-invalid');
            }else{
                $('#harga_show').text(sub_total);
                $('#HelpQty').text('');
                $('#qty').removeClass('is-invalid');
            }
        }
    });

    //On Input Qty 
    $('#edit_diskon').on('input', function() {
        var value=$("input[name=edit_diskon]").val();

        if (value==='') {
            $('#HelpDiskon').text('Masukan Jumlah Diskon');
            $('#edit_diskon').addClass('is-invalid');
        }else{
            $('#HelpDiskon').text('');
            $('#edit_diskon').removeClass('is-invalid');
        }
    });

    //On Input Qty 
    $('#barang').on('change', function() {
        data=this.value
        if (data===''||data==='null') {
            $('#HelpBarang').text('Pilih Barang');
            $('#barang').addClass('is-invalid');
        }else{
            $('#HelpBarang').text('');
            $('#barang').removeClass('is-invalid');
            $('#HelpQty').text('');
            $('#qty').removeClass('is-invalid');
        }
    });

    //On Input Qty 
    $('#bayar').on('input', function() {
        data=this.value
        if (data==='') {
            $('#kembalian').text('Rp .'+0);
        }else{
            data=data-all
            data=data.toFixed(2)
            $('#kembalian').text('Rp .'+data);
        }
    });

    function resetBayarKembalian(){
        $('#kembalian').text(0);
        $('#bayar').val(0);
    }

    //Handle Validation Add To Cart
    function validationAddCart(){
        var stock=$("input[name=stock]").val();
        var barang=$("#barang").val();
        stock=parseInt(stock);
        var qty=$("input[name=stock]").val();

        if (barang==='null'||qty==='') {
            $('#HelpQty').text('Masukan Jumlah');
            $('#qty').addClass('is-invalid');
            $('#HelpBarang').text('Pilih Barang');
            $('#barang').addClass('is-invalid');
        }else{
            qty=parseInt(qty);
            if(qty>stock){
                $('#HelpQty').text('*Stok Tidak Tersedia');
                $('#qty').addClass('is-invalid');
            }else{
                add_ToCart()
            }
        }
    }

    //Handle Add Barang
    function add_ToCart()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/cart'?>';
        // ajax adding data to database
        var formData = new FormData($('#dataform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){  
                total_cart=data.total;
                $('#total_cart').text('Rp. '+total_cart);
                if(data.status===true){
                    getCart()
                    getDiskon()
                    setTotal()
                    resetBayarKembalian()
                }
            }
        })
    }

    function validation(){
        var submit=$("#edit_diskon").val();

        //If True === Ada Kolom Yang Kosong
        if(submit===''){
            $('#HelpDiskon').text('Masukan Jumlah Diskon');
            $('#edit_diskon').addClass('is-invalid');
        }else{
            update_Diskon()
        }
    }
    function clearForm(){
        $('#HelpDiskon').text('');
        $('#edit_diskon').removeClass('is-invalid');
    }

    //Show Modal Edit Diskon
    function modalDiskon() {
        clearForm()
        $('#diskonform')[0].reset();
        $('#edit_diskon').val(diskon);
        $('#diskonModal').modal('show');
    }

    //Handle Update Diskon
    function update_Diskon()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/updateDiskon'?>';
        // ajax adding data to database
        var formData = new FormData($('#diskonform')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){  
                if(data.status===true){
                    $('#diskonModal').modal('hide');
                    destroyCart()
                    get_Barang()
                    getCart()
                    getDiskon()
                    $('#total_cart').text('Rp. 0');
                    $('#barang').val('null');
                    $('#qty').val('');
                    $('#harga_show').text('Rp. 0');
                    setTotal()
                    resetBayarKembalian()
                }
            }
        })
    }

    function destroyCart(){
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/destroyCart'?>';
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            contentType: false,
            processData: false,
            dataType: "JSON",
            success : function(data){  
            }
        })
    }

    //Handle Add Barang
    function save_Database()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/isCart'?>';
        // ajax adding data to database
        var formData = new FormData($('#dataform')[0]);
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
                    getCart()
                    getDiskon()
                    $('#total_cart').text('Rp. 0');
                    $('#barang').val('null');
                    $('#qty').val('');
                    $('#harga_show').text('Rp. 0');
                    setTotal()
                    resetBayarKembalian()
                    
                }
            }
        })
    }

    //Handle Add Barang
    function getCart()
    { 
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/kasir/kasir/getChart'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                total_cart=data.total;
                data=Object.values(data.data)
                var html = '';
                var html2 = '';
                var i;
                if (data.length!==0) {
                    html2 ='';

                    for(i=0; i<data.length; i++){
                        html += '<div class="d-flex justify-content-around pl-2">'+
                                    '<div class="p-1">'+
                                        '<p>'+(i+1)+'.</p>'+
                                    '</div>'+
                                    '<div class="p-1" style="width:7rem">'+
                                        '<p>'+data[i].name+'</p>'+
                                    '</div>'+
                                    '<div class="p-1 row justify-content-center" style="width:17rem">'+ 
                                        '<div style="width:auto" class="pr-2 pl-1">'+
                                            '<p>'+data[i].qty+'   x   Rp.'+data[i].price+'</p>'+
                                        '</div>'+                                                                                        
                                    '</div>'+
                                    '<div class="p-1" style="width:8rem" >'+
                                        '<p>Rp.  '+data[i].subtotal+'</p>'+
                                    '</div>'+
                                    '<div class="p-1 pl-3">'+
                                        '<a href="javascript:;" class="btn btn-danger btn-sm del-cart" data="'+data[i].rowid+','+data[i].qty+'"><span class="fas fa-trash-alt fa-sm" style="color:#ffff;height:0.4rem"></span></a>'+
                                    '</div>'+
                                '</div>';
                    }   
                    $('#show_cart').html(html);
                }else{
                    $('#show_cart').html('<h5 class="ml-2">Kosong....</h5>');
                }
            }
        });
    }

    function setEmpty(){
        var html='<h1>Cart Kosong</h1>';
        $('#empty').html(html);
    }

    //Get Diskon
    function getDiskon()
    { 
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/kasir/kasir/getDiskon'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                if(data.status===true){
                    diskon=data.data[0].value;
                    rupiah_diskon=(diskon/100)*total_cart;
                    rupiah_diskon = rupiah_diskon.toFixed(2);
                    $('#kurung').text('('+diskon+'%)');
                    $('#rupiah_diskon').text('Rp. '+rupiah_diskon+'');
                    $('#diskonSend').val(rupiah_diskon);
                    setTotal()
                }else{
                    diskon=0;
                }
            }
        });
    }

    function setTotal(){
        all=total_cart-rupiah_diskon;
        $('#total_all').text('Rp. '+all);
        $('#totalSend').val(all);
    }

     //Handle Add Cart
     $('#show_cart').on('click','.add-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/addChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0],qty:parseInt(data[1])},
            dataType: "JSON",
            success : function(data){ 
                if(data.status===true){
                    getCart()
                    total_cart=data.total;
                    rupiah_diskon=(diskon/100)*total_cart;
                    rupiah_diskon = rupiah_diskon.toFixed(2);
                    $('#total_cart').text('Rp. '+total_cart);
                    $('#rupiah_diskon').text('Rp. '+rupiah_diskon+'');
                    $('#diskonSend').val(rupiah_diskon);
                    setTotal()
                    resetBayarKembalian()
                }
            }
        })
    });

    //Handle Sub Cart
    $('#show_cart').on('click','.sub-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/subChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0],qty:parseInt(data[1])},
            dataType: "JSON",
            success : function(data){   
                if(data.status===true){
                    getCart()
                    total_cart=data.total;
                    rupiah_diskon=(diskon/100)*total_cart;
                    rupiah_diskon = rupiah_diskon.toFixed(2);
                    $('#total_cart').text('Rp. '+total_cart);
                    $('#rupiah_diskon').text('Rp. '+rupiah_diskon+'');
                    $('#diskonSend').val(rupiah_diskon);
                    setTotal()
                    resetBayarKembalian()
                }
            }
        })
    });

    //Handle Delete Cart
    $('#show_cart').on('click','.del-cart',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        var url;
        url = '<?php echo  base_url().'index.php/kasir/kasir/delChart'?>';
        $.ajax({
            url : url,
            type: "POST",
            data: {row_id:data[0]},
            dataType: "JSON",
            success : function(data){  
                
                if(data.status===true){
                    getCart()
                    total_cart=data.total;
                    rupiah_diskon=(diskon/100)*total_cart;
                    rupiah_diskon = rupiah_diskon.toFixed(2);
                    $('#total_cart').text('Rp. '+total_cart);
                    $('#rupiah_diskon').text('Rp. '+rupiah_diskon+'');
                    $('#diskonSend').val(rupiah_diskon);
                    setTotal()
                    resetBayarKembalian()
                }
            }
        })
    });

</script>