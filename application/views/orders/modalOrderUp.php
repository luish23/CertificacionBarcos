<div class="modal-header">
    <h4 class="modal-title"><strong><?php echo '  #'.$data['office'].str_pad($data['idOrder'], 4, '0', STR_PAD_LEFT).$data['anyo']; ?></strong></h4>
</div>

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><?php echo $this->lang->line('information'); ?></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><?php echo $this->lang->line('convalidations'); ?></a>
            </li>
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
                    <option value="<?php echo $this->lang->line('start'); ?>" selected="selected"><?php echo $this->lang->line('start'); ?></option>
                    <option value="<?php echo $this->lang->line('process'); ?>"><?php echo $this->lang->line('process'); ?></option>
                    </select>
                </div>
                <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('provisional'); ?></label>
                    <select class="form-control" id="provisional" name="provisional">
                    <option value="1"><?php echo $this->lang->line('yes'); ?></option>
                    <option value="0" selected="selected"><?php echo $this->lang->line('no'); ?></option>
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
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <form id="ordersFormUpdateNS01" action="updateOrderNS01" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <select class="form-control" id="transport_commodity" name="transport_commodity">
                                <option value="">Transportar Mercancía</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="propulsion_plant_type" name="propulsion_plant_type" placeholder="Tipo da Planta Propulsora">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="power_total_efective" name="power_total_efective" placeholder="Potencia Efectiva Total">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="towing_destination" name="towing_destination" placeholder="Destino del Remolque">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="vessel" name="vessel" placeholder="Embarcación">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="poll" name="poll" placeholder="Encuesta">
                        </div>
                    </div>
                    <div class="row col-12 m-1">
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" id="normam01" value="1" name="normam01">
                            <label class="form-check-label" for="normam01">NORMAM-01</label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" id="normam02" value="1" name="normam02">
                            <label class="form-check-label" for="normam02">NORMAM-02</label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" type="checkbox" id="public_water_transport"  value="1" name="public_water_transport">
                            <label class="form-check-label" for="public_water_transport">Transporte Público de Pasajeros</label>
                        </div>
                    </div>
 
                    <div class="form-group row col-12 pt-2">
                        <div class="col-12">
                            <input type="text" class="form-control" id="issued_in" name="issued_in" placeholder="Emitido en">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual01_init" name="visit_annual01_init" placeholder="Visita 01 desde">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual01_end" name="visit_annual01_end" placeholder="Visita 01 hasta">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit01" name="place_date_visit01" placeholder="Lugar de visita 01">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor01" name="surveyor01" placeholder="Encuestador 01">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual02_init" name="visit_annual02_init" placeholder="Visita 02 desde">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual02_end" name="visit_annual02_end" placeholder="Visita 02 hasta">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit02" name="place_date_visit02" placeholder="Lugar de visita 02">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor02" name="surveyor02" placeholder="Encuestador 02">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_intermedia_init" name="visit_intermedia_init" placeholder="Visita Intermedio desde">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_intermedia_end" name="visit_intermedia_end" placeholder="Visita Intermedio hasta">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_intermedia" name="place_date_intermedia" placeholder="Lugar de visita Intermedio">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="intermedia_surveyor" name="intermedia_surveyor" placeholder="Encuestador Intermedio">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual03_init" name="visit_annual03_init" placeholder="Visita 03 desde">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual03_end" name="visit_annual03_end" placeholder="Visita 03 hasta">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit03" name="place_date_visit03" placeholder="Lugar de visita 03">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor03" name="surveyor03" placeholder="Encuestador 03">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual04_init" name="visit_annual04_init" placeholder="Visita 04 desde">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="visit_annual04_end" name="visit_annual04_end" placeholder="Visita 04 hasta">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="place_date_visit04" name="place_date_visit04" placeholder="Lugar de visita 04">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="surveyor04" name="surveyor04" placeholder="Encuestador 04">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersP" name="seated_passengersP" placeholder="Passageiros sentados CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersS" name="seated_passengersS" placeholder="Passageiros sentados CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="seated_passengersL" name="seated_passengersL" placeholder="Passageiros sentados ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinP" name="passengers_cabinP" placeholder="Passageiros em camarote CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinS" name="passengers_cabinS" placeholder="Passageiros em camarote CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_cabinL" name="passengers_cabinL" placeholder="Passageiros em camarote ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksP" name="passengers_networksP" placeholder="Passageiros em redes CONVÉS PRINCIPAL">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksS" name="passengers_networksS" placeholder="Passageiros em redes CONVÉS SUPERIOR">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="passengers_networksL" name="passengers_networksL" placeholder="Passageiros em redes ÁREA DE LAZER">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="carga_geral" name="carga_geral" placeholder="Porão de carga 01 (carga geral)">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="helmet" name="helmet" placeholder="Paiol no casco">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="almoxarifado" name="almoxarifado" placeholder="Almoxarifado no convés principal">
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="col-4">
                            <input type="text" class="form-control" id="main_deposit" name="main_deposit" placeholder="Depósito no convés principal">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="upper_deposit" name="upper_deposit" placeholder="Depósito no convés superior">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" id="observations" name="observations" placeholder="Observaciones">
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