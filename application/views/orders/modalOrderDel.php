<!-- Modal DELETE -->
<div class="modal-header">
    <h3 class="modal-title"><?php echo $this->lang->line('order'); ?><strong><?php echo '  #'.$data['office'].str_pad($data['id'], 3, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h3>
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="orderDeleteForm" action="deleteOrder" method="POST">    
    <!-- Modal Footer -->
    <div class="modal-footer">
        <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
        <button type="submit" id="submit" class="btn btn-danger"><?php echo $this->lang->line('delete'); ?></button>
        <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
    </div>
</form>
<!-- FIN Modal DELETE -->