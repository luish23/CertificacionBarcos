<!-- Modal VER -->
<form id="boatUpdateForm" action="updateBoat" method="POST">
<div class="card-body">
            <div class="form-group row">
                <label for="inputName" class="col-2 col-form-label"><?php echo $this->lang->line('name'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['name']; ?>">
                </div>
                <label for="inputNumeroIMO" class="col-2 col-form-label"><?php echo $this->lang->line('imo'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="number_imo" id="number_imo" value="<?php echo $data['number_imo']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('shipowner'); ?></label>
                <div class="col-4 err-form">
                    <select class="form-control" name="codShipowner" id="codShipowner">
                        <option value="0"><?php echo $this->lang->line('select'); ?></option>
                        <?php 
                        foreach ($shipowner as $key => $value2) {
                            if ($data['codShipowner'] == $value2['id']) {
                                echo '<option value="'.$value2['id'].'" selected="selected">'.$value2['name_ship'].'</option>';
                            }else{
                                echo '<option value="'.$value2['id'].'">'.$value2['name_ship'].'</option>';
                            }
                        }
                        ?>
                    </select>


                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('number_register'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="number_register" id="number_register" value="<?php echo $data['number_register']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('call_sign'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="call_sign" id="call_sign" value="<?php echo $data['call_sign']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('call_sign'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="year_build" id="year_build" value="<?php echo $data['year_build']; ?>">
                </div>
            </div>
            <div class="form-group row">                        
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('place_build'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="place_build" id="place_build" value="<?php echo $data['place_build']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('shipyard'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="shipyard" id="shipyard" value="<?php echo $data['shipyard']; ?>">
                </div>
            </div>
            <div class="form-group row">                        
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('type_boat'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="type_boat" id="type_boat" value="<?php echo $data['type_boat']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('navigation'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="navigation" id="navigation" value="<?php echo $data['navigation']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('service'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="service" id="service" value="<?php echo $data['service']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('number_approved_passengers'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="number_approved_passengers" id="number_approved_passengers" value="<?php echo $data['number_approved_passengers']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('total_length'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="total_length" id="total_length" value="<?php echo $data['total_length']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('length_perpendiculars'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="length_perpendiculars" id="length_perpendiculars" value="<?php echo $data['length_perpendiculars']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('manga'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="manga" id="manga" value="<?php echo $data['manga']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('structure'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="structure" id="structure" value="<?php echo $data['structure']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('gross_tonnage'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="gross_tonnage" id="gross_tonnage" value="<?php echo $data['gross_tonnage']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('liquid_tonnage'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="liquid_tonnage" id="liquid_tonnage" value="<?php echo $data['liquid_tonnage']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('gross_transport'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="gross_transport" id="gross_transport" value="<?php echo $data['gross_transport']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('engine_running'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="engine_running" id="engine_running" value="<?php echo $data['engine_running']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('amount'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $data['amount']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('mark'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="mark" id="mark" value="<?php echo $data['mark']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('model'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="model" id="model" value="<?php echo $data['model']; ?>">
                </div>
                <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('power_speed'); ?></label>
                <div class="col-4 err-form">
                    <input type="text" class="form-control" name="power_speed" id="power_speed" value="<?php echo $data['power_speed']; ?>">
                </div>
            </div>
        </div>

</div>
<!-- FIN Modal VER -->
        
        <!-- Modal Footer -->
        <div class="modal-footer">
            <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
            <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
        </div>
    </div>
</form>
<!-- FIN Modal VER -->