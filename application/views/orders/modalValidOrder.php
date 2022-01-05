<!-- form start -->
<?php // print_r($data); die; ?>
<div class="modal-header">
    <h3 class="modal-title">Validar Orden<strong><?php echo '  #'.$data['office'].str_pad($data['id'], 3, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="ordersFormUpdate" action="processOrder" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group err-form">
            <label for="exampleInputEmail1">Desea Validar Orden?</label>
            <select class="form-control" id="condition" name="condition">
                <option value="1">Si</option>
                <option value="0">No</option>  
            </select>
            </div>
            <msg></msg>
        </div>
           
        <!-- /.card-body -->
        <div class="modal-footer">
            <!-- <input type="hidden" name="codBoat" id="codBoat" value="<?php // echo $data['id']; ?>"> -->
            <input type="hidden" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">
            <button type="submit" id="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>

  