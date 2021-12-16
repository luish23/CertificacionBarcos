  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Navios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Registrar Navios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="boatForm" action="registerBoat" method="POST">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-2 col-form-label">Nombre</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                        </div>
                        <label for="inputNumeroIMO" class="col-2 col-form-label">Numero IMO</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_imo" id="number_imo" placeholder="Numero IMO">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Armador</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="shipowner" id="shipowner" placeholder="Armador">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Numero de Registro</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_register" id="number_register" placeholder="Numero de Registro">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Indicativo de Llamada</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="call_sign" id="call_sign" placeholder="Indicativo de Llamada">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Año de Construcción</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="year_build" id="year_build" placeholder="Año de Construcción">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputLabel" class="col-2 col-form-label">Lugar de Construcción</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="place_build" id="place_build" placeholder="Lugar de Construcción">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Astillero</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="shipyard" id="shipyard" placeholder="Astillero">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputLabel" class="col-2 col-form-label">Tipo de Barco</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="type_boat" id="type_boat" placeholder="Tipo de Barco">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Navegación</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="navigation" id="navigation" placeholder="Navegación">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Servicio</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="service" id="service" placeholder="Servicio">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Numero de Pasajeros Aprobados</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="number_approved_passengers" id="number_approved_passengers" placeholder="Numero de Pasajeros Aprobados">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Longitud Total</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="total_length" id="total_length" placeholder="Longitud Total">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Longitud entre Perpendiculares</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="length_perpendiculars" id="length_perpendiculars" placeholder="Longitud entre Perpendiculares">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Manga</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="manga" id="manga" placeholder="Manga">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Estructura</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="structure" id="structure" placeholder="Estructura">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Tonelada Bruta</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="gross_tonnage" id="gross_tonnage" placeholder="Tonelada Bruta">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Tonelada Líquida</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="liquid_tonnage" id="liquid_tonnage" placeholder="Tonelada Líquida">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Transporte Bruto</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="gross_transport" id="gross_transport" placeholder="Transporte Bruto">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Motor Encendido</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="engine_running" id="engine_running" placeholder="Motor Encendido">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Cantidad</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Cantidad">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Marca</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="mark" id="mark" placeholder="Marca">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLabel" class="col-2 col-form-label">Modelo</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="model" id="model" placeholder="Modelo">
                        </div>
                        <label for="inputLabel" class="col-2 col-form-label">Potencia / Velocidad</label>
                        <div class="col-4 err-form">
                            <input type="text" class="form-control" name="power_speed" id="power_speed" placeholder="Potencia / Velocidad">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" id="submit" class="btn btn-primary">Registrar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- ./wrapper -->