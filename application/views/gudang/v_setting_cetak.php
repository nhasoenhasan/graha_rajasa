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
                <li class="breadcrumb-item"><a href="<?php echo  base_url().'index.php/gudang_home'?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Setting Cetak</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="row ml-1">
            <h1 class="h2">Setting Cetak</h1>  
        </div>
    </div>
    <table id="myTable" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Nama Perusahaan</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Tag Line</th>
                <th scope="col" class="text-center">Nama Tanda Tangan</th>
                <th scope="col" class="text-center">Mengetahui</th>
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
            <input name="id_setting_cetak" type="hidden" class="form-control " id="id_setting_cetak">
            <input name="tdd_pimpinan" type="hidden" class="form-control " id="tdd_pimpinan">
            <label for="exampleInputEmail1">Nama Perusahaan</label>
            <input name="nama_perusahaan" type="text" class="form-control " id="nama_perusahaan" aria-describedby="emailHelp" placeholder="Masukan Nama Perusahaan" require>
            <small id="HelpNamaPerusahaan" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
            <small id="HelpAlamat" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Sub Judul</label>
            <input name="tag_line" type="text" class="form-control" id="tag_line" aria-describedby="emailHelp" placeholder="Masukan Sub Judul">
            <small id="HelpTagLine" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Tanda Tangan</label>
            <input name="tdd_gudang" type="text" class="form-control" id="tdd_gudang" aria-describedby="emailHelp" placeholder="Masukan Nama Tanda Tangan">
            <small id="HelpTddGudang" class="form-text text-danger ml-1">
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mengetahui</label>
            <input name="mengetahui" type="text" class="form-control" id="mengetahui" aria-describedby="emailHelp" placeholder="Masukan Nama Tanda Tangan">
            <small id="HelpMengetahui" class="form-text text-danger ml-1">
            </small>
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
        get_Setting()
    });  

    $('#show_data').on('click','.item_edit',function(){
        clearForm()
        $('#ModalLabel').text('Edit ');
        var id=$(this).attr('data');
        id=id.split('|');
        $('[name="id_setting_cetak"]').val(id[0]);
        $('[name="nama_perusahaan"]').val(id[1]);
        $('[name="alamat"]').val(id[2]);
        $('[name="tag_line"]').val(id[3]);
        $('[name="tdd_gudang"]').val(id[4]);
        $('[name="tdd_pimpinan"]').val(id[5]);
        $('[name="mengetahui"]').val(id[6]);
        $('#modalAdd').modal('show')
    });

    //Icon Feather
    feather.replace()

    //Get Data Barang
    function get_Setting() {
      $.ajax({
            type  : 'ajax',
            url   : '<?php echo  base_url().'index.php/gudang_setting/get'?>',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += 
                        '<tr>'+
                            '<td class="text-center">'+data[i].nama_perusahaan+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].alamat+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].tag_line+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].tdd_gudang+'</td>'+
                            '<td class="text-center" style="word-break: break-all;">'+data[i].mengetahui+'</td>'+
                            '<td style="text-align:center;">'+
                                '<a  href="javascript:;" class="btn btn-warning item_edit btn-xs" data="'+data[i].id_setting_cetak+'|'+data[i].nama_perusahaan+'|'+data[i].alamat+'|'+data[i].tag_line+'|'+data[i].tdd_gudang+'|'+data[i].tdd_pimpinan+'|'+data[i].mengetahui+'" ><span class="fas fa-pencil-alt" style="color:white"></span></a>'+' '+
                            '</td>'+
                        '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //---------------- Validation ------------------------
    //Input Nama Perusahaan
    $('#nama_perusahaan').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpNamaPerusahaan').text('');
            $('#nama_perusahaan').removeClass('is-invalid');
        }else{
            $('#HelpNamaPerusahaan').text('Masukan Nama Perusahaan');
            $('#nama_perusahaan').addClass('is-invalid');
        }
    });

    //Input Alamat
    $('#alamat').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpAlamat').text('');
            $('#alamat').removeClass('is-invalid');
        }else{
            $('#HelpAlamat').text('Masukan Alamat');
            $('#alamat').addClass('is-invalid');
        }
    });

     //Input Sub Judul
     $('#tag_line').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpTagLine').text('');
            $('#tag_line').removeClass('is-invalid');
        }else{
            $('#HelpTagLine').text('Masukan Sub Judul');
            $('#tag_line').addClass('is-invalid');
        }
    });

     //Input Nama Tanda Tangan
     $('#tdd_gudang').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpTddGudang').text('');
            $('#tdd_gudang').removeClass('is-invalid');
        }else{
            $('#HelpTddGudang').text('Masukan Nama Tanda Tangan');
            $('#tdd_gudang').addClass('is-invalid');
        }
    });

    //Input Nama Tanda Tangan
    $('#mengetahui').on('input', function() {
        data=this.value
        if(data!==''||null){
            $('#HelpMengetahui').text('');
            $('#mengetahui').removeClass('is-invalid');
        }else{
            $('#HelpMengetahui').text('Masukan Data');
            $('#mengetahui').addClass('is-invalid');
        }
    });

    function validation(){
        var array=[$("#nama_perusahaan").val(),$("#alamat").val(),$("#tag_line").val(),$("#tdd_gudang").val(),$("#mengetahui").val()];
        var istrue=array.includes("");

        var validation=istrue

        //If True === Ada Kolom Yang Kosong
        if(validation===true){
            validationForm(array)
        }else{
            add_Cetak()
        }
    }

    function validationForm(array){
        if (array[0]=="") {
            $('#HelpNamaPerusahaan').text('Masukan Nama Perusahaan');
            $('#nama_perusahaan').addClass('is-invalid');
        }
        if (array[1]=="") {
            $('#HelpAlamat').text('Masukan Alamat');
            $('#alamat').addClass('is-invalid');
        }
        if (array[2]=="") {
            $('#HelpTagLine').text('Masukan Sub Judul');
            $('#tag_line').addClass('is-invalid');
        }
        if (array[3]=="") {
            $('#HelpTddGudang').text('Masukan Nama Tanda Tangan');
            $('#tdd_gudang').addClass('is-invalid');
        }
        if (array[4]=="") {
            $('#HelpMengetahui').text('Masukan Data');
            $('#mengetahui').addClass('is-invalid');
        }
    }

    //Handle Clear From Warning
    function clearForm(){
        $('#HelpNamaPerusahaan').text('');
        $('#nama_perusahaan').removeClass('is-invalid');

        $('#HelpAlamat').text('');
        $('#alamat').removeClass('is-invalid');

        $('#HelpTagLine').text('');
        $('#tag_line').removeClass('is-invalid');

        $('#HelpTddGudang').text('');
        $('#tdd_gudang').removeClass('is-invalid');

        $('#HelpMengetahui').text('');
        $('#mengetahui').removeClass('is-invalid');
    }

    //Handle Add Barang
    function add_Cetak()
    { 
        var url;
        url = '<?php echo  base_url().'index.php/gudang_setting/post'?>';
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
                    get_Setting() 
                    $('#modalAdd').modal('hide')
                }
            }
        })
    }

</script>
