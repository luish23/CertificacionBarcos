<!-- Modal VER -->

<div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-2 col-form-label">Nombre</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="name" id="name" readonly value="<?php echo $data['name']; ?>">
                        </div>
                        <label for="inputNumeroIMO" class="col-2 col-form-label">Numero IMO</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_imo" id="number_imo" readonly value="<?php echo $data['number_imo']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Armador</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="shipowner" id="shipowner" readonly value="<?php echo $data['shipowner']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Numero de Registro</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_register" id="number_register" readonly value="<?php echo $data['number_register']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Indicativo de Llamada</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="call_sign" id="call_sign" readonly value="<?php echo $data['call_sign']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Año de Construcción</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="year_build" id="year_build" readonly value="<?php echo $data['year_build']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputLabel" class="col-2 col-form-label">Lugar de Construcción</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="place_build" id="place_build" readonly value="<?php echo $data['place_build']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Astillero</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="shipyard" id="shipyard" readonly value="<?php echo $data['shipyard']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputLabel" class="col-2 col-form-label">Tipo de Barco</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="type_boat" id="type_boat" readonly value="<?php echo $data['type_boat']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Navegación</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="navigation" id="navigation" readonly value="<?php echo $data['navigation']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Servicio</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="service" id="service" readonly value="<?php echo $data['service']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Numero de Pasajeros Aprobados</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_approved_passengers" id="number_approved_passengers" readonly value="<?php echo $data['number_approved_passengers']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Longitud Total</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="total_length" id="total_length" readonly value="<?php echo $data['total_length']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Longitud entre Perpendiculares</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="length_perpendiculars" id="length_perpendiculars" readonly value="<?php echo $data['length_perpendiculars']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Manga</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="manga" id="manga" readonly value="<?php echo $data['manga']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Estructura</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="structure" id="structure" readonly value="<?php echo $data['structure']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Tonelada Bruta</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="gross_tonnage" id="gross_tonnage" readonly value="<?php echo $data['gross_tonnage']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Tonelada Líquida</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="liquid_tonnage" id="liquid_tonnage" readonly value="<?php echo $data['liquid_tonnage']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Transporte Bruto</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="gross_transport" id="gross_transport" readonly value="<?php echo $data['gross_transport']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Motor Encendido</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="engine_running" id="engine_running" readonly value="<?php echo $data['engine_running']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Cantidad</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="amount" id="amount" readonly value="<?php echo $data['amount']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Marca</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="mark" id="mark" readonly value="<?php echo $data['mark']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Modelo</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="model" id="model" readonly value="<?php echo $data['model']; ?>">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Potencia / Velocidad</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="power_speed" id="power_speed" readonly value="<?php echo $data['power_speed']; ?>">
                        </div>
                    </div>
                </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

</div>
<!-- FIN Modal VER -->