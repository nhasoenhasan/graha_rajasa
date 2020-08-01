<div class="row ">
    <form id=dateForm class="row mr-1" action="<?php echo  base_url().'index.php/kasir/return_barang/getCetakByDate'?>" method="post" target="_blank">
        <div class="input-group " style="width:25rem">
            <input name="startDate" id="startDate" type="text" placeholder="Start date" aria-label="First name" class="form-control start-date ">
            <input name="endDate" id="endDate" type="text" placeholder="End date" aria-label="Last name" class="form-control end-date">
        </div>
        <button type="button" onclick="getValidation()" class="btn btn-primary ml-2"><span class="fas fa-search mr-1" style="color:#ffff"></span></button>
        <button type="submit"  class="btn btn-primary ml-2 "><span class="fas fa-print" style="color:#ffff"></span></button>
    </form>
</div>