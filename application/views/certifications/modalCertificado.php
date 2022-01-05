<div class="modal-header">
    <h3 class="modal-title">Orden<strong><?php echo '  #'.$data['office'].str_pad($data['id'], 3, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h3>
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="CertificadoForm" action="generateCertificate" method="POST">    
    <!-- Modal Footer -->
    <div class="modal-footer">
        <input type="text" name="id" id="id" value="<?php echo $data['id']; ?>">
        <input type="text" name="codOffice" id="codOffice" value="<?php echo $data['idOffice']; ?>">
        <button type="submit" id="submit" class="btn btn-success">Si</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
    </div>
</form>