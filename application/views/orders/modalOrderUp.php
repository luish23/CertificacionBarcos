<div class="modal-header">
    <h4 class="modal-title"><strong><?php echo '  #'.$data['office'].str_pad($data['idOrder'], 4, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h4>
</div>

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><?php echo $this->lang->line('information'); ?></a>
            </li>
            <?php if ($data['codTypeCertification'] == 1) {
                echo ' <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-ns01-tab" data-toggle="pill" href="#custom-tabs-one-ns01" role="tab" aria-controls="custom-tabs-one-ns01" aria-selected="false">'. $this->lang->line("convalidations").'</a>
                </li>';
            } ?>
            <?php if ($data['codTypeCertification'] == 2) {
                echo ' <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-ns02-tab" data-toggle="pill" href="#custom-tabs-one-ns02" role="tab" aria-controls="custom-tabs-one-ns02" aria-selected="false">'. $this->lang->line("place_includes").'</a>
                </li>';
            } ?>
           <?php if ($data['codTypeCertification'] == 3) {
                echo ' <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-ns03-tab" data-toggle="pill" href="#custom-tabs-one-ns03" role="tab" aria-controls="custom-tabs-one-ns03" aria-selected="false">'. $this->lang->line("test_result").'</a>
                </li>';
            } ?>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
            <form id="ordersFormUpdate" action="updateOrder" method="POST" enctype="multipart/form-data">
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
                </br>
                <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('condition'); ?></label>
                    <select class="form-control" id="condition" name="condition">
                    <?php if ($data['condition'] == 'INICIADO') {
                        echo '<option value="'.$this->lang->line('start').'" selected="selected">'.$this->lang->line("start").'</option>';
                        echo '<option value="'.$this->lang->line('process').'">'.$this->lang->line("process").'</option>';
                    }else {
                        echo '<option value="'.$this->lang->line('start').'">'.$this->lang->line("start").'</option>';
                        echo '<option value="'.$this->lang->line('process').'" selected="selected">'.$this->lang->line("process").'</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('provisional'); ?></label>
                    <select class="form-control" id="provisional" name="provisional">
                        <?php if ($data['provisional']) {
                            echo '<option value="1" selected="selected">'.$this->lang->line("yes").'</option>';
                            echo '<option value="0">'.$this->lang->line("no").'</option>';
                        }else {
                            echo '<option value="1">'.$this->lang->line("yes").'</option>';
                            echo '<option value="0" selected="selected">'.$this->lang->line("no").'</option>';
                        }
                        ?>
                    
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="codBoat" id="codBoat" value="<?php echo $data['codBoat']; ?>">
                    <input type="hidden" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">
                    <input type="hidden" name="codTypeCertification" id="codTypeCertification" value="<?php echo $data['codTypeCertification']; ?>">                
                    <input type="hidden" name="codListVerification" id="codListVerification" value="<?php echo $data['codListVerification']; ?>">                
                    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
            </form>

            </div>
            <div class="tab-pane fade" id="custom-tabs-one-ns01" role="tabpanel" aria-labelledby="custom-tabs-one-ns01-tab">
                <form id="ordersFormUpdateNS01" action="updateOrderNS01" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <div class="form-group row err-form">
                                <label for="exampleInputEmail1" class="col-8"><?php echo $this->lang->line('transport_commodity'); ?></label>
                                <select class="form-control col-3 " id="transport_commodity" name="transport_commodity">
                                    <?php 
                                        if ($dataNS['transport_commodity']) {
                                            echo '<option value="1" selected="selected">'.$this->lang->line("yes").'</option>';
                                            echo '<option value="0">'.$this->lang->line("no").'</option>';
                                        }else{
                                            echo '<option value="1">'.$this->lang->line("yes").'</option>';
                                            echo '<option value="0" selected="selected">'.$this->lang->line("no").'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="propulsion_plant_type" name="propulsion_plant_type" value="<?php if (isset($dataNS['propulsion_plant_type'])) echo $dataNS['propulsion_plant_type'] ?>" placeholder="Tipo da Planta Propulsora">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="power_total_efective" name="power_total_efective" value="<?php if (isset($dataNS['power_total_efective'])) echo $dataNS['power_total_efective'] ?>" placeholder="Potencia Efectiva Total">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="towing_destination" name="towing_destination" value="<?php if (isset($dataNS['towing_destination'])) echo $dataNS['towing_destination'] ?>" placeholder="Destino del Remolque">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="vessel" name="vessel" value="<?php if (isset($dataNS['vessel'])) echo $dataNS['vessel'] ?>" placeholder="Embarcación">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="poll" name="poll" value="<?php if (isset($dataNS['poll'])) echo $dataNS['poll'] ?>" placeholder="Encuesta">
                        </div>
                    </div>
                    <div class="row col-12 m-1">
                        <div class="form-check col-4">
                            <?php 
                                if (isset($dataNS['normam01'])) {
                                    echo '<input class="form-check-input" type="checkbox" id="normam01" value="1" checked name="normam01">';
                                }else{
                                    echo '<input class="form-check-input" type="checkbox" id="normam01" value="1" name="normam01">';
                                }
                            ?>
                            <label class="form-check-label" for="normam01">NORMAM-01</label>
                        </div>
                        <div class="form-check col-4">
                            <?php 
                                if (isset($dataNS['normam02'])) {
                                    echo '<input class="form-check-input" type="checkbox" id="normam02" value="1" checked name="normam02">';
                                }else{
                                    echo '<input class="form-check-input" type="checkbox" id="normam02" value="1" name="normam02">';
                                }
                            ?>
                            <label class="form-check-label" for="normam02">NORMAM-02</label>
                        </div>
                        <div class="form-check col-4">
                            <?php 
                                if (isset($dataNS['public_water_transport'])) {
                                    echo '<input class="form-check-input" type="checkbox" id="public_water_transport" value="1" checked name="public_water_transport">';
                                }else{
                                    echo '<input class="form-check-input" type="checkbox" id="public_water_transport" value="1" name="public_water_transport">';
                                }
                            ?>
                            <label class="form-check-label" for="public_water_transport">Transporte Público de Pasajeros</label>
                        </div>
                    </div>
 
                    <div class="form-group row col-12 pt-2">
                        <div class="col-12">
                            <input type="text" class="form-control" id="issued_in" name="issued_in" value="<?php if (isset($dataNS['issued_in'])) echo $dataNS['issued_in'] ?>" placeholder="Emitido en">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual01_init" name="visit_annual01_init" value="<?php if (isset($dataNSEx['visit_annual01_init'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual01_init'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual01_end" name="visit_annual01_end" value="<?php if (isset($dataNSEx['visit_annual01_end'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual01_end'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit01" name="place_date_visit01" value="<?php if (isset($dataNSEx['place_date_visit01'])) echo $dataNSEx['place_date_visit01'] ?>" placeholder="Lugar de visita 01">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor01" name="surveyor01" value="<?php if (isset($dataNSEx['surveyor01'])) echo $dataNSEx['surveyor01'] ?>" placeholder="Encuestador 01">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual02_init" name="visit_annual02_init" value="<?php if (isset($dataNSEx['visit_annual02_init'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual02_init'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual02_end" name="visit_annual02_end" value="<?php if (isset($dataNSEx['visit_annual02_end'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual02_end'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit02" name="place_date_visit02" value="<?php if (isset($dataNSEx['place_date_visit02'])) echo $dataNSEx['place_date_visit02'] ?>" placeholder="Lugar de visita 02">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor02" name="surveyor02" value="<?php if (isset($dataNSEx['surveyor02'])) echo $dataNSEx['surveyor02'] ?>" placeholder="Encuestador 02">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_intermedia_init" name="visit_intermedia_init" value="<?php if (isset($dataNSEx['visit_intermedia_init'])) echo date("d-m-Y", strtotime($dataNSEx['visit_intermedia_init'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_intermedia_end" name="visit_intermedia_end" value="<?php if (isset($dataNSEx['visit_intermedia_end'])) echo date("d-m-Y", strtotime($dataNSEx['visit_intermedia_end'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_intermedia" name="place_date_intermedia" value="<?php if (isset($dataNSEx['place_date_intermedia'])) echo $dataNSEx['place_date_intermedia'] ?>" placeholder="Lugar de visita Intermedio">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="intermedia_surveyor" name="intermedia_surveyor" value="<?php if (isset($dataNSEx['intermedia_surveyor'])) echo $dataNSEx['intermedia_surveyor'] ?>" placeholder="Encuestador Intermedio">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual03_init" name="visit_annual03_init" value="<?php if (isset($dataNSEx['visit_annual03_init'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual03_init'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual03_end" name="visit_annual03_end" value="<?php if (isset($dataNSEx['visit_annual03_end'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual03_end'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit03" name="place_date_visit03" value="<?php if (isset($dataNSEx['place_date_visit03'])) echo $dataNSEx['place_date_visit03'] ?>" placeholder="Lugar de visita 03">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor03" name="surveyor03" value="<?php if (isset($dataNSEx['surveyor03'])) echo $dataNSEx['surveyor03'] ?>" placeholder="Encuestador 03">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual04_init" name="visit_annual04_init" value="<?php if (isset($dataNSEx['visit_annual04_init'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual04_init'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="visit_annual04_end" name="visit_annual04_end" value="<?php if (isset($dataNSEx['visit_annual04_end'])) echo date("d-m-Y", strtotime($dataNSEx['visit_annual04_end'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit04" name="place_date_visit04" value="<?php if (isset($dataNSEx['place_date_visit04'])) echo $dataNSEx['place_date_visit04'] ?>"  placeholder="Lugar de visita 04">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor04" name="surveyor04" value="<?php if (isset($dataNSEx['surveyor04'])) echo $dataNSEx['surveyor04'] ?>"  placeholder="Encuestador 04">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersP" name="seated_passengersP" value="<?php if (isset($dataNS['seated_passengersP'])) echo $dataNS['seated_passengersP'] ?>" placeholder="Passageiros sentados CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersS" name="seated_passengersS" value="<?php if (isset($dataNS['seated_passengersS'])) echo $dataNS['seated_passengersS'] ?>" placeholder="Passageiros sentados CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersL" name="seated_passengersL" value="<?php if (isset($dataNS['seated_passengersL'])) echo $dataNS['seated_passengersL'] ?>" placeholder="Passageiros sentados ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinP" name="passengers_cabinP" value="<?php if (isset($dataNS['passengers_cabinP'])) echo $dataNS['passengers_cabinP'] ?>" placeholder="Passageiros em camarote CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinS" name="passengers_cabinS" value="<?php if (isset($dataNS['passengers_cabinS'])) echo $dataNS['passengers_cabinS'] ?>" placeholder="Passageiros em camarote CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinL" name="passengers_cabinL" value="<?php if (isset($dataNS['passengers_cabinL'])) echo $dataNS['passengers_cabinL'] ?>" placeholder="Passageiros em camarote ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksP" name="passengers_networksP" value="<?php if (isset($dataNS['passengers_networksP'])) echo $dataNS['passengers_networksP'] ?>" placeholder="Passageiros em redes CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksS" name="passengers_networksS" value="<?php if (isset($dataNS['passengers_networksS'])) echo $dataNS['passengers_networksS'] ?>" placeholder="Passageiros em redes CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksL" name="passengers_networksL" value="<?php if (isset($dataNS['passengers_networksL'])) echo $dataNS['passengers_networksL'] ?>" placeholder="Passageiros em redes ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="carga_geral" name="carga_geral" value="<?php if (isset($dataNS['carga_geral'])) echo $dataNS['carga_geral'] ?>" placeholder="Porão de carga 01 (carga geral)">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="helmet" name="helmet" value="<?php if (isset($dataNS['helmet'])) echo $dataNS['helmet'] ?>" placeholder="Paiol no casco">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="almoxarifado" name="almoxarifado" value="<?php if (isset($dataNS['almoxarifado'])) echo $dataNS['almoxarifado'] ?>" placeholder="Almoxarifado no convés principal">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="main_deposit" name="main_deposit" value="<?php if (isset($dataNS['main_deposit'])) echo $dataNS['main_deposit'] ?>" placeholder="Depósito no convés principal">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="upper_deposit" name="upper_deposit" value="<?php if (isset($dataNS['upper_deposit'])) echo $dataNS['upper_deposit'] ?>" placeholder="Depósito no convés superior">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="observations" name="observations" value="<?php if (isset($dataNS['observations'])) echo $dataNS['observations'] ?>" placeholder="Observaciones">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">             
                    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                </form>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-ns02" role="tabpanel" aria-labelledby="custom-tabs-one-ns02-tab">
                <form id="ordersFormUpdateNS02" action="updateOrderNS02" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Puerto de Inscripción</label>
                            <input type="text" class="form-control" id="port_inscription" name="port_inscription" value="<?php if (isset($dataNS02['port_inscription'])) echo $dataNS02['port_inscription'] ?>" placeholder="Porto de Inscrição">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Batimento de Quilha</label>
                            <input type="text" class="form-control" id="batimento" name="batimento" value="<?php if (isset($dataNS02['batimento'])) echo $dataNS02['batimento'] ?>" placeholder="Batimento de Quilha">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Comprimento De Regra</label>
                            <input type="text" class="form-control" id="ruler_length" name="ruler_length" value="<?php if (isset($dataNS02['ruler_length'])) echo $dataNS02['ruler_length'] ?>" placeholder="Comprimento De Regra">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Boca</label>
                            <input type="text" class="form-control" id="boca" name="boca" value="<?php if (isset($dataNS02['boca'])) echo $dataNS02['boca'] ?>" placeholder="Boca">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Pontal Moldado</label>
                            <input type="text" class="form-control" id="molded_knit" name="molded_knit" value="<?php if (isset($dataNS02['molded_knit'])) echo $dataNS02['molded_knit'] ?>" placeholder="Pontal Moldado">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Emitido em</label>
                            <input type="text" class="form-control" id="emitido" name="emitido" value="<?php if (isset($dataNS02['emitido'])) echo $dataNS02['emitido'] ?>" placeholder="Emitido em">
                        </div>
                    </div>
                    <!-- CAMPOS NO RELEVANTES PARA EL CERTIFICADO NS02 -->
                    <!-- <div class="form-group row col-12">
                        <div class="form-group pl-2">
                            <input class="btn btn-success" type="button" id="add_field" value="Agregar +">    
                        </div>
                        <div id="listas" class="form-row pl-1">
                        </div>
                    </div> -->
                    <div class="form-group row col-12">
                        <div class="col-12">
                            <label for="exampleFormControlInput1">Espacios Excluidos</label>
                            <input type="text" class="form-control" id="place_exclude" name="place_exclude" value="<?php if (isset($dataNS02['place_exclude'])) echo $dataNS02['place_exclude'] ?>" placeholder="Espacios Excluidos">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Total de passageiros em camarote</label>
                            <input type="text" class="form-control" id="number_passengers_berths" name="number_passengers_berths" value="<?php if (isset($dataNS02['number_passengers_berths'])) echo $dataNS02['number_passengers_berths'] ?>" placeholder="Número total de passageiros em camarotes com até 8 beliches">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Número total dos demais passageiros</label>
                            <input type="text" class="form-control" id="number_total_passengers" name="number_total_passengers" value="<?php if (isset($dataNS02['number_total_passengers'])) echo $dataNS02['number_total_passengers'] ?>" placeholder="Número total dos demais passageiros">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Calado Moldado</label>
                            <input type="text" class="form-control" id="molded_project" name="molded_project" value="<?php if (isset($dataNS02['molded_project'])) echo $dataNS02['molded_project'] ?>" placeholder="Calado Moldado">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-6">
                            <label for="exampleFormControlInput1">Fecha y Lugar de Arqueo Original</label>
                            <input type="text" class="form-control" id="place_date_original" name="place_date_original" value="<?php if (isset($dataNS02['place_date_original'])) echo $dataNS02['place_date_original'] ?>" placeholder="Fecha y Lugar de Arqueo Original">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1">Fecha y Lugar de Ultimo Arqueo</label>
                            <input type="text" class="form-control" id="place_date_last" name="place_date_last" value="<?php if (isset($dataNS02['place_date_last'])) echo $dataNS02['place_date_last'] ?>" placeholder="Fecha y Lugar de Ultimo Arqueo">
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="exampleFormControlInput1">Observaciones</label>
                            <input type="text" class="form-control" id="observations" name="observations" value="<?php if (isset($dataNS02['observations'])) echo $dataNS02['observations'] ?>" placeholder="Observaciones">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">             
                    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                </form>
            </div>

            <div class="tab-pane fade" id="custom-tabs-one-ns03" role="tabpanel" aria-labelledby="custom-tabs-one-ns03-tab">
                <form id="ordersFormUpdateNS03" action="updateOrderNS03" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Ejecutor del Ensayo</label>
                            <input type="text" class="form-control" id="executor" name="executor" value="<?php if (isset($dataNS04['executor'])) echo $dataNS03['executor'] ?>" placeholder="Ejecutor del Ensayo">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Marca</label>
                            <input type="text" class="form-control" id="mark" name="mark" value="<?php if (isset($dataNS03['mark'])) echo $dataNS03['mark'] ?>" placeholder="Marca">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Modelo</label>
                            <input type="text" class="form-control" id="model" name="model" value="<?php if (isset($dataNS03['model'])) echo $dataNS03['model'] ?>" placeholder="Modelo">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <label for="exampleFormControlInput1">LO(m)</label>
                            <input type="text" class="form-control" id="lo" name="lo" value="<?php if (isset($dataNS03['lo'])) echo $dataNS03['lo'] ?>" placeholder="LO(m)">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Boca Moldada (m)</label>
                            <input type="text" class="form-control" id="boca_moldada" name="boca_moldada" value="<?php if (isset($dataNS03['boca_moldada'])) echo $dataNS03['boca_moldada'] ?>" placeholder="Boca Moldada (m)">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Pontal Moldado</label>
                            <input type="text" class="form-control" id="pontal_moldado" name="pontal_moldado" value="<?php if (isset($dataNS03['pontal_moldado'])) echo $dataNS03['pontal_moldado'] ?>" placeholder="Pontal Moldado">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Nº de série</label>
                            <input type="text" class="form-control" id="number_serie" name="number_serie" value="<?php if (isset($dataNS03['number_serie'])) echo $dataNS03['number_serie'] ?>" placeholder="Nº de série">
                        </div>
                    </div>
                    <div class="form-group row col-12">                        
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Cantidad</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="<?php if (isset($dataNS03['amount'])) echo $dataNS03['amount'] ?>" placeholder="Cantidad">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Potencia HP</label>
                            <input type="text" class="form-control" id="powerHP" name="powerHP" value="<?php if (isset($dataNS03['powerHP'])) echo $dataNS03['powerHP'] ?>" placeholder="Potencia HP">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Rotação (rpm)</label>
                            <input type="text" class="form-control" id="rotation" name="rotation" value="<?php if (isset($dataNS03['rotation'])) echo $dataNS03['rotation'] ?>" placeholder="Rotação (rpm)">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Redução</label>
                            <input type="text" class="form-control" id="reduce" name="reduce" value="<?php if (isset($dataNS03['reduce'])) echo $dataNS03['reduce'] ?>" placeholder="Redução">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Tipo</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?php if (isset($dataNS03['type'])) echo $dataNS03['type'] ?>" placeholder="Tipo">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Nº de pás</label>
                            <input type="text" class="form-control" id="number_pas" name="number_pas" value="<?php if (isset($dataNS03['number_pas'])) echo $dataNS03['number_pas'] ?>" placeholder="Nº de pás">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Diamêtro</label>
                            <input type="text" class="form-control" id="diameter" name="diameter" value="<?php if (isset($dataNS03['diameter'])) echo $dataNS03['diameter'] ?>" placeholder="Diamêtro">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Passo</label>
                            <input type="text" class="form-control" id="passo" name="passo" value="<?php if (isset($dataNS03['passo'])) echo $dataNS03['passo'] ?>" placeholder="Passo">
                        </div>
                    </div>
                    <div class="form-group row col-12">                        
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Tracción Estatica</label>
                            <input type="text" class="form-control" id="static_drive" name="static_drive" value="<?php if (isset($dataNS03['static_drive'])) echo $dataNS03['static_drive'] ?>" placeholder="Tracción Estatica">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Lugar</label>
                            <input type="text" class="form-control" id="place" name="place" value="<?php if (isset($dataNS03['place'])) echo $dataNS03['place'] ?>" placeholder="Lugar">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Fecha</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="fecha" name="fecha" value="<?php if (isset($dataNS03['fecha'])) echo date("d-m-Y", strtotime($dataNS03['fecha'])) ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask="" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">Hora</label>
                            <input type="text" class="form-control" id="times" name="times" value="<?php if (isset($dataNS03['times'])) echo $dataNS03['times'] ?>" placeholder="Hora">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Viento</label>
                            <input type="text" class="form-control" id="wind" name="wind" value="<?php if (isset($dataNS03['wind'])) echo $dataNS03['wind'] ?>" placeholder="Viento">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Correnteza</label>
                            <input type="text" class="form-control" id="actual" name="actual" value="<?php if (isset($dataNS03['actual'])) echo $dataNS03['actual'] ?>" placeholder="Correnteza">
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlInput1">Profundidade</label>
                            <input type="text" class="form-control" id="depth" name="depth" value="<?php if (isset($dataNS03['depth'])) echo $dataNS03['depth'] ?>" placeholder="Profundidade">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <label for="exampleFormControlInput1">HAV</label>
                            <input type="text" class="form-control" id="hav" name="hav" value="<?php if (isset($dataNS03['hav'])) echo $dataNS03['hav'] ?>" placeholder="HAV">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">HAR</label>
                            <input type="text" class="form-control" id="har" name="har" value="<?php if (isset($dataNS03['har'])) echo $dataNS03['har'] ?>" placeholder="HAR">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">TRIM</label>
                            <input type="text" class="form-control" id="trims" name="trims" value="<?php if (isset($dataNS03['trims'])) echo $dataNS03['trims'] ?>" placeholder="TRIM">
                        </div>
                        <div class="col-3">
                            <label for="exampleFormControlInput1">LCABO</label>
                            <input type="text" class="form-control" id="lcabo" name="lcabo" value="<?php if (isset($dataNS03['lcabo'])) echo $dataNS03['lcabo'] ?>" placeholder="LCABO">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="form-check col-4 ml-md-auto">
                            <?php 
                                if (isset($dataNS['attachments1'])) {
                                    echo '<input class="form-check-input" type="checkbox" id="attachments1" value="1" checked name="attachments1">';
                                }else{
                                    echo '<input class="form-check-input" type="checkbox" id="attachments1" value="1" name="attachments1">';
                                }
                            ?>
                            <label class="form-check-label" for="attachments1">Gráfico “tração estática x rotação”</label>
                        </div>
                        <div class="form-check col-4 ml-md-auto">
                            <?php 
                                if (isset($dataNS['attachments2'])) {
                                    echo '<input class="form-check-input" type="checkbox" id="attachments2" value="1" checked name="attachments2">';
                                }else{
                                    echo '<input class="form-check-input" type="checkbox" id="attachments2" value="1" name="attachments2">';
                                }
                            ?>
                            <label class="form-check-label" for="attachments2">Gráfico “potência x rotação”</label>
                        </div>
                    </div>
                    <div class="form-group row col-12 text-center">
                        <div class="col-2">
                            <label for="exampleFormControlInput1">Condição de carga</label>
                            <input type="text" class="btn btn-info" value="70%" readonly>
                        </div>
                        <div class="col-1">
                            <label for="exampleFormControlInput1">BB</label>
                            <input type="text" class="form-control" id="bb70" name="bb70" value="<?php if (isset($dataNSEx03['bb70'])) echo $dataNSEx03['bb70'] ?>">
                        </div>
                        <div class="col-1">
                            <label for="exampleFormControlInput1">LC</label>
                            <input type="text" class="form-control" id="lc70" name="lc70" value="<?php if (isset($dataNSEx03['lc70'])) echo $dataNSEx03['lc70'] ?>">
                        </div>
                        <div class="col-1">
                            <label for="exampleFormControlInput1">BE</label>
                            <input type="text" class="form-control" id="be70" name="be70" value="<?php if (isset($dataNSEx03['be70'])) echo $dataNSEx03['be70'] ?>">
                        </div>
                        <div class="col-2">
                            <label for="exampleFormControlInput1">Tração máxima</label>
                            <input type="text" class="form-control" id="max70" name="max70" value="<?php if (isset($dataNSEx03['max70'])) echo $dataNSEx03['max70'] ?>">
                        </div>
                        <div class="col-2">
                            <label for="exampleFormControlInput1">Tração mínima</label>
                            <input type="text" class="form-control" id="min70" name="min70" value="<?php if (isset($dataNSEx03['min70'])) echo $dataNSEx03['min70'] ?>">
                        </div>
                        <div class="col-2">
                            <label for="exampleFormControlInput1">Tração estática</label>
                            <input type="text" class="form-control" id="static70" name="static70" value="<?php if (isset($dataNSEx03['static70'])) echo $dataNSEx03['static70'] ?>">
                        </div>
                        <div class="col-1">
                            <label for="exampleFormControlInput1">Potência</label>
                            <input type="text" class="form-control" id="opc70" name="opc70" value="<?php if (isset($dataNSEx03['opc70'])) echo $dataNSEx03['opc70'] ?>">
                        </div>
                    </div>
                    <div class="form-group row col-12 text-center">
                        <div class="col-2">
                            <input type="text" class="btn btn-info" value="80%" readonly>
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="bb80" name="bb80" value="<?php if (isset($dataNSEx03['bb80'])) echo $dataNSEx03['bb80'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="lc80" name="lc80" value="<?php if (isset($dataNSEx03['lc80'])) echo $dataNSEx03['lc80'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="be80" name="be80" value="<?php if (isset($dataNSEx03['be80'])) echo $dataNSEx03['be80'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="max80" name="max80" value="<?php if (isset($dataNSEx03['max80'])) echo $dataNSEx03['max80'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="min80" name="min80" value="<?php if (isset($dataNSEx03['min80'])) echo $dataNSEx03['min80'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="static80" name="static80" value="<?php if (isset($dataNSEx03['static80'])) echo $dataNSEx03['static80'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="opc80" name="opc80" value="<?php if (isset($dataNSEx03['opc80'])) echo $dataNSEx03['opc80'] ?>">
                        </div>
                    </div>
                    <div class="form-group row col-12 text-center">
                        <div class="col-2">
                            <input type="text" class="btn btn-info" value="90%" readonly>
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="bb90" name="bb90" value="<?php if (isset($dataNSEx03['bb90'])) echo $dataNSEx03['bb90'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="lc90" name="lc90" value="<?php if (isset($dataNSEx03['lc90'])) echo $dataNSEx03['lc90'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="be90" name="be90" value="<?php if (isset($dataNSEx03['be90'])) echo $dataNSEx03['be90'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="max90" name="max90" value="<?php if (isset($dataNSEx03['max90'])) echo $dataNSEx03['max90'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="min90" name="min90" value="<?php if (isset($dataNSEx03['min90'])) echo $dataNSEx03['min90'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="static90" name="static90" value="<?php if (isset($dataNSEx03['static90'])) echo $dataNSEx03['static90'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="opc90" name="opc90" value="<?php if (isset($dataNSEx03['opc90'])) echo $dataNSEx03['opc90'] ?>">
                        </div>
                    </div>
                    <div class="form-group row col-12 text-center">
                        <div class="col-2">
                            <input type="text" class="btn btn-info" value="100%" readonly>
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="bb100" name="bb100" value="<?php if (isset($dataNSEx03['bb100'])) echo $dataNSEx03['bb100'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="lc100" name="lc100" value="<?php if (isset($dataNSEx03['lc100'])) echo $dataNSEx03['lc100'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="be100" name="be100" value="<?php if (isset($dataNSEx03['be100'])) echo $dataNSEx03['be100'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="max100" name="max100" value="<?php if (isset($dataNSEx03['max100'])) echo $dataNSEx03['max100'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="min100" name="min100" value="<?php if (isset($dataNSEx03['min100'])) echo $dataNSEx03['min100'] ?>">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="static100" name="static100" value="<?php if (isset($dataNSEx03['static100'])) echo $dataNSEx03['static100'] ?>">
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control" id="opc100" name="opc100" value="<?php if (isset($dataNSEx03['opc100'])) echo $dataNSEx03['opc100'] ?>">
                        </div>
                    </div>
                   
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="idOrder" id="idOrder" value="<?php echo $data['idOrder']; ?>">             
                    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>