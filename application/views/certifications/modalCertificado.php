<div class="modal-header">
    <h3 class="modal-title">Orden a Certificar<strong><?php echo '  #'.$data['office'].str_pad($data['id'], 3, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h3>
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="CertificadoForm" action="generateCertificate" method="POST">    
    <!-- Modal Footer -->
    <div class="modal-footer">
        <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
        <input type="hidden" name="codOffice" id="codOffice" value="<?php echo $data['idOffice']; ?>">
        <input type="hidden" name="codTypeCertification" id="codTypeCertification" value="<?php echo $data['codTypeCertification']; ?>">
        <input type="hidden" name="downloadType" id="downloadType" value="<?php echo $data['downloadType']; ?>">
        <button type="submit" id="submit" class="btn btn-success">Si</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
    </div>
</form>