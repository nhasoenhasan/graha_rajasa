<!-- Styling -->
<style>
    select option[disabled]:first-child {
        display: none;
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom pt-5">
        <div class="row ml-1">
            <h1 class="h2">Data Return</h1>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Tanggal</th>
                <th scope="col" class="text-center">No Nota</th>
                <th scope="col" class="text-center">Nama Barang</th>
                <th scope="col" class="text-center">Harga Satuan</th>
                <th scope="col" class="text-center">Qty</th>
                <th scope="col" class="text-center">Disc</th>
                <th scope="col" class="text-center">Total</th>
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
            <label for="exampleFormControlSelect1">Masukan No Nota</label>
            <select name="suplier" class="form-control" id="suplier">
            </select>
            <small id="HelpSuplier" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Barang</label>
            <select name="suplier" class="form-control" id="suplier">
            </select>
            <small id="HelpSuplier" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alasan</label>
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

<script  type="text/javascript">

    // On Load Documents
    $(document).ready( function () {
        $('#myTable').DataTable();
        get_Penjualan()
    });  

    //Handle Modal Add Barang
    function modaladd(params) {
        // clearForm()
        $('#ModalLabel').text('Tambah Data Return');
        $('#addform')[0].reset();
        $('#modalAdd').modal('show')
    }

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Penjualan() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/kasir/penjualan/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                console.log(data);
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+(i+1)+'</td>'+
                            '<td class="text-center">'+data[i].tanggal+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].no_order+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].nama_barang+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp. '+data[i].harga+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].jumlah+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].diskon+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">Rp.'+data[i].subtotal+'</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    

</script>
