<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 ">
        <nav aria-label="breadcrumb" style="margin-left:-0.8rem">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/pimpinan/index'?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Acc Order</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom">
        <h1 class="h3">Acc Order</h1>
        <form id=dateForm class="row mr-2 mb-3" action="<?php echo  base_url().'index.php/pimpinan/acc_order/cetakByDate'?>" method="post" target="_blank">
                <div class="input-group " style="width:25rem">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Masukan Tanggal</span>
                    </div>
                    <input name="startDate" id="startDate" type="text" placeholder="Start date" aria-label="First name" class="form-control start-date ">
                    <input name="endDate" id="endDate" type="text" placeholder="End date" aria-label="Last name" class="form-control end-date">
                </div>
                <button type="submit"  class="btn btn-primary ml-2 "><span class="fas fa-print" style="color:#ffff"></span></button>
                <button type="button"  class="btn btn-primary ml-2" onclick="getValidation()" ><span class="fas fa-search" style="color:#ffff"></span></button>
                <button type="button"  class="btn btn-success ml-2" onclick="refresh()" ><span class="fas fa-sync-alt" style="color:#ffff"></span></button>
            </form>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Nama Barang</th>
                <th scope="col" class="text-center">Supplier</th>
                <th scope="col" class="text-center">Jumlah</th>
                <th scope="col" class="text-center">Harga Beli</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="show_data">
        
        </tbody>
    </table>
</main>

<!-- Modal Delete Barang -->
<div class="modal fade bd-example-modal-sm" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content ">
        <div class="modal-header justify-content-center">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Acc Order</h5>
        </div>
        <div class="modal-body mx-auto">
            <form id="deleteform">
                <input type="hidden" name="id_det_order_brg" value="">
                <img src="<?php echo base_url(); ?>assets/images/trash-2.svg" alt="Trash">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="delete_Order()">Delete</button>
        </div>
    </div>
  </div>
</div>
<!-- End Modal Delete Barang -->
<script  type="text/javascript">
    var nama='';
    var arrData=[];
    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Order(0)
        get_Suplier()
       
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

    //Handle Refresh
    function refresh(){
        nama=''
        get_Order(0)
        get_Suplier()
    }

    //Handle Delete
    function delete_Order()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang/acc_order/delete'?>';
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
                    get_Order(0)
                    get_Suplier()
                    $('#modaldelete').modal('hide')
                }
            }
        })
    }

    //On Change Select Pilih Supplier
    $('#suplier').on('change', function() {
        // alert(  );
        nama=this.value
        get_Order(3)
    });

    //Handle Modal Delete
	function modalhapus(id) {
        $('#modaldelete').modal('show');
        $('[name="id_det_order_brg"]').val(id);
    }

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Order(sts) {
      $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/pimpinan/acc_order/get'?>',
            async : false,
            dataType : 'json',
            data: { 
                status: sts,
                id_supplier: nama
            },
            success : function(d){
                var data=Object.values(d);
                arrData=data;
                var html = '';
                var i;
                var status;
                var textColor;
                for(i=0; i<data.length; i++){
                    //0=minta persetujuan, 1=belum di pesan, 2=di pesan ,3=selesai
                    status=data[i].status==='0'?'Minta Persetujuan':(data[i].status=='1'?'Belum di pesan':(data[i].status=='2'?'Di Pesan':'selesai'));
                    textColor=data[i].status==='0'?'warning':(data[i].status=='1'?'danger':(data[i].status=='2'?'primary':'success'));
                    // textColor=data[i].status==='1'?'danger':(data[i].status=='2'?'primary':'warning');
                    html += 
                        '<tr>'+
                            '<td class="text-center" scope="row">'+(i+1)+'</td>'+
                            '<td class="text-left">'+data[i].nama_barang+'</td>'+
                            '<td class="text-center">'+data[i].nama_supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].jumlah+'</td>'+
                            '<td style="word-break: break-all;" class="text-right">Rp.'+data[i].subtotal+'</td>'+
                            '<td   class="text-center text-'+textColor+' font-weight-bold">'+status+'</td>'+
                            '<td style="text-align:center;">'+
                                '<a  class="btn btn-success btn-xs item_order mr-2 " data="'+data[i].id_det_order_brg+','+data[i].status+'"><span class="fas fa-check" style="color:white"></span></a>'+
                                '<a onclick="modalhapus('+data[i].id_det_order_brg+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_det_order_brg+'"><span class="fas fa-trash-alt" style="color:white"></a>'+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }


    $('#startDate').on('input', function() {
        data=this.value
        if (data !== '') {
            $('#startDate').removeClass('is-invalid');
            // $('#endDate').addClass('is-invalid');
        }
    });

    $('#endDate').on('input', function() {
        data=this.value
        if (data !== '') {
            $('#endDate').removeClass('is-invalid');
            // $('#endDate').addClass('is-invalid');
        }
    });

    //Get Data Barang
    function getValidation() {
        var start=$('#startDate').val();
        var end=$('#endDate').val();
        if (start === '' || end === '') {
            $('#startDate').addClass('is-invalid');
            $('#endDate').addClass('is-invalid');
        }else{
            get_OrderByDate()
        }
    }


    //Get Data Order By Date
    function get_OrderByDate() {
      var start=$('#startDate').val();
      var end=$('#endDate').val();
      $.ajax({
            type  : 'get',
            url   : '<?php echo  base_url().'index.php/pimpinan/acc_order/getByDate'?>',
            async : false,
            dataType : 'json',
            data:{
                startDate:start,
                endDate:end
            },
            success : function(d){
                var data=Object.values(d);
                arrData=data;
                var html = '';
                var i;
                var status;
                var textColor;
                for(i=0; i<data.length; i++){
                    //0=minta persetujuan, 1=belum di pesan, 2=di pesan ,3=selesai
                    status=data[i].status==='0'?'Minta Persetujuan':(data[i].status=='1'?'Belum di pesan':(data[i].status=='2'?'Di Pesan':'selesai'));
                    textColor=data[i].status==='0'?'warning':(data[i].status=='1'?'danger':(data[i].status=='2'?'primary':'success'));
                    // textColor=data[i].status==='1'?'danger':(data[i].status=='2'?'primary':'warning');
                    html += 
                        '<tr>'+
                            '<td class="text-center" scope="row">'+(i+1)+'</td>'+
                            '<td class="text-left">'+data[i].nama_barang+'</td>'+
                            '<td class="text-center">'+data[i].nama_supplier+'</td>'+
                            '<td style="word-break: break-all;" class="text-center">'+data[i].jumlah+'</td>'+
                            '<td style="word-break: break-all;" class="text-right">Rp.'+data[i].subtotal+'</td>'+
                            '<td   class="text-center text-'+textColor+' font-weight-bold">'+status+'</td>'+
                            '<td style="text-align:center;">'+
                                '<a  class="btn btn-success btn-xs item_order mr-2 " data="'+data[i].id_det_order_brg+','+data[i].status+'"><span class="fas fa-check" style="color:white"></span></a>'+
                                '<a onclick="modalhapus('+data[i].id_det_order_brg+')" class="btn btn-danger btn-xs item_hapus " data="'+data[i].id_det_order_brg+'"><span class="fas fa-trash-alt" style="color:white"></a>'+
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
                var html = '<option value="" selected disabled>Pilih Supplier</option>';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id_supplier+'>'+data[i].nama+'</option>'
                }
                $('#suplier').html(html);
        }
    });

    $('#show_data').on('click','.item_order',function(){
        var data=$(this).attr('data');
        data=data.split(',');
        
        if (data[1]==='0') {
            var url;
            url = '<?php echo  base_url().'index.php/pimpinan/acc_order/update'?>';
            // ajax adding data to database
            var formData = new FormData();
            formData.append('data',data[0])
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success : function(data){   
                    if(data.status===true){
                        get_Order(0)
                    }
                }
            })
        }
    });

    

    

}

</script>

