<!-- Modal DELETE -->
<div class="modal-header">
    <h3 class="modal-title"><strong><?php echo $data['user']; ?></strong></h3>
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="userDeleteForm" action="deleteUser" method="POST">    
    <!-- Modal Footer -->
    <div class="modal-footer">
        <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
        <button type="submit" id="submit" class="btn btn-danger"><?php echo $this->lang->line('delete'); ?></button>
        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
    </div>
</form>
<!-- FIN Modal DELETE -->