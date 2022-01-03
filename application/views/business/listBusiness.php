  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
              <li class="breadcrumb-item active">Empresa</li>
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
                    <th>Empresa</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($data != false)
                  {
                    echo "<tr>";
                    echo "<td>".$data['name']."</td>";
                    echo "<td>".$data['phone']."</td>";
                    echo "<td>".$data['address']."</td>";
                    echo "<td>". $retVal2 = ($data['status']) ? 'Activo' : 'Inactivo' ."</td>";                      
                    echo "<td><button type='button' class='btn btn-outline-success btn-rounded waves-effect' data-toggle='modal' data-target='#seeBusiness' data-id='".(int)$data['id']."'><i class='far fa-eye' aria-hidden='true'></i></button>
                    <button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#updateBusiness' data-id='".(int)$data['id']."'><i class='far fa-edit' aria-hidden='true'></i></button>
                    </td>";
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Empresa</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
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



<div class="modal fade" id="seeBusiness" role="dialog">
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

<div class="modal fade" id="updateBusiness" role="dialog">
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