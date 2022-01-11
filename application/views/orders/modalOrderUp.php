<!-- form start -->
<?php // print_r($data); die; ?>
<div class="modal-header">
    <h3 class="modal-title"><?php echo $this->lang->line('information'); ?><strong><?php // echo '  #'.$data['office'].str_pad($data['idOrder'], 3, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="ordersFormUpdate" action="updateOrder" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group err-form">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('office'); ?></label>
            <select class="form-control" id="codOffice" name="codOffice">
            <option value="0"><?php echo $this->lang->line('select'); ?></option>
            <?php 
                foreach ($offices as $key => $value2) {
                    if ($value2['office'] == $data['office']) {
                        echo '<option value="'.$value2['id'].'" selected="selected">'.$value2['office'].'</option>';
                    }else{
                        echo '<option value="'.$value2['id'].'">'.$value2['office'].'</option>';
                    }
                }
            ?>   
            </select>
            </div>
            <div class="input-group err-form">
                <div class="custom-file">
                <input type="hidden" class="custom-file-input" id="idword_old" name="idword_old" value="<?php echo $data['codWord']; ?>">
                <input type="file" class="custom-file-input" id="word" name="word">
                <label class="custom-file-label" for="exampleInputFile"><?php echo $this->lang->line('select_word'); ?></label>
                </div>
                <div class="input-group-append">
                <span class="input-group-text">WORD</span>
                </div>
            </div>
            </br>
            <div class="input-group err-form">
                <div class="custom-file">
                <input type="hidden" class="custom-file-input" id="idpdf_old" name="idpdf_old" value="<?php echo $data['codPDF']; ?>">
                <input type="file" class="custom-file-input" id="pdf" name="pdf">
                <label class="custom-file-label" for="exampleInputFile"><?php echo $this->lang->line('select_pdf'); ?></label>
                </div>
                <div class="input-group-append">
                <span class="input-group-text">&nbsp; PDF &nbsp;</span>
                </div>
            </div>
        </div>   
        <!-- /.card-body -->
        <div class="modal-footer">
            <input type="text" name="codBoat" id="codBoat" value="<?php echo $data['id']; ?>">
            <input type="text" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">
            <input type="hidden" name="codTypeCertification" id="codTypeCertification" value="<?php echo $data['codTypeCertification']; ?>">                
            <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
        </div>
    </div>
</form>



  