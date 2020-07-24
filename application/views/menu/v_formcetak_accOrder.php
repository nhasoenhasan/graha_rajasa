<form id=dateForm class="row mr-2" action="<?php echo  base_url().'index.php/gudang/barang_masuk/cetakBarangMasuk'?>" method="post" target="_blank">
    <div class="input-group " style="width:25rem">
        <div class="input-group-prepend">
            <span class="input-group-text">Masukan Tanggal</span>
        </div>
        <input name="startDate" id="startDate" type="text" placeholder="Start date" aria-label="First name" class="form-control start-date ">
        <input name="endDate" id="endDate" type="text" placeholder="End date" aria-label="Last name" class="form-control end-date">
    </div>
    <button type="button" onclick="getValidation()" class="btn btn-primary ml-4"><span class="fas fa-search mr-1" style="color:#ffff"></span></button>
    <button type="submit"  class="btn btn-primary ml-2 "><span class="fas fa-print" style="color:#ffff"></span></button>
    <button type="button" onclick="get_Barang_Masuk()" class="btn btn-success ml-1 mr-1"><span class="fas fa-sync-alt mr-1" style="color:#ffff"></span></button>
    <button type="button" class="btn btn-success" onclick="modaladd()" data-toggle="modal" >ADD</button>
</form>