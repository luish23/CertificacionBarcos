
<form id="shipownerForm" action="updateShipowner" method="POST">
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputPassword1"><?php echo $this->lang->line('shipowner'); ?></label>
        <input type="text" name="name_ship" class="form-control" id="name_ship" value="<?php echo $data['name_ship'] ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
        <input type="text" name="address" class="form-control" id="address" value="<?php echo $data['address'] ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>
        <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $data['phone'] ?>">
    </div>
</div>
<!-- /.card-body -->
<div class="modal-footer">
    <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
    <button type="submit" id="submit" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
</div>
</form>
           