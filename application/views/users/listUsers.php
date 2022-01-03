  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listado de Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de Usuarios</li>
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
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Tipo Usuario</th>
                    <th>Asignado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($data != false)
                  {
                    foreach ($data as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['user']."</td>";
                      echo "<td>".$value['description']."</td>";
                      echo "<td>". $retVal = ($value['assigned']) ? 'Si' : 'No' ."</td>";
                      echo "<td>". $retVal2 = ($value['status']) ? 'Activo' : 'Inactivo' ."</td>";                      
                      echo "<td><button type='button' class='btn btn-outline-success btn-rounded waves-effect' data-toggle='modal' data-target='#seeUser' data-id='".(int)$value['id']."'><i class='far fa-eye' aria-hidden='true'></i></button>
                      <button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#updateUser' data-id='".(int)$value['id']."'><i class='far fa-edit' aria-hidden='true'></i></button>
                      <button type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#deleteUser' data-id='".(int)$value['id']."'><i class='far fa-trash-alt' aria-hidden='true'></i></button></td>";
                      echo "</tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Usuario</th>
                    <th>Tipo Usuario</th>
                    <th>Asignado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



<div class="modal fade" id="seeUser" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Información</h4>
          </div>
          <div class="modal-body">
              <div class="fetched-data"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="updateUser" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title">Editar Información</h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataUp"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="deleteUser" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content bg-secondary">
          <div class="modal-header">
          <h4 class="modal-title">Seguro desea eliminar el registro?</h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataDel"></div>
          </div>
      </div>
  </div>
</div>