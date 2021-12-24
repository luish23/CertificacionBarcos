  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Empleados</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Registrar Empleados</li>
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
              <form id="employeeForm" action="registerEmployee" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Introducir nombre">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Introducir apellido">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">DNI</label>
                    <input type="number" name="dni" class="form-control" id="dni" placeholder="987654321">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefono</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="987654321">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cargo</label>
                    <input type="text" name="position" class="form-control" id="position" placeholder="Introducir Cargo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dirección</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Introducir Dirección">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sexo</label>
                    <select class="form-control" name="gender" id="gender">
                      <option value="0">Seleccione</option>
                      <option value="Femenino">Femenino</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Otro">Otro</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Usuario</label>
                    <select class="form-control" name="codUser" id="codUser">
                      <option value="0">Seleccione</option>
                      <?php 
                        foreach ($data as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['user'].'</option>';
                        }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de Usuario</label>
                    <select class="form-control" name="codTypeUser" id="codTypeUser">
                      <option value="0">Seleccione</option>
                      <?php 
                        foreach ($typeUser as $key => $value2) {
                            echo '<option value="'.$value2['id'].'">'.$value2['description'].'</option>';
                        }
                    ?>
                    </select>
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