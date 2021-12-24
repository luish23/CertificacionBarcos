  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registrar Órdenes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
              <li class="breadcrumb-item active">Registrar Órdenes</li>
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
              <form id="ordersForm" action="registerOrder" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group err-form">
                    <label for="exampleInputEmail1">Oficina</label>
                    <select class="form-control" id="codOffice" name="codOffice">
                    <option value="0">Seleccione</option>
                    <?php 
                        foreach ($offices as $key => $value2) {
                            echo '<option value="'.$value2['id'].'">'.$value2['office'].'</option>';
                        }
                    ?>   
                    </select>
                  </div>
                  <div class="form-group err-form">
                    <label for="exampleInputEmail1">Navio</label>
                    <select class="form-control" id="id_boat" name="id_boat">
                    <option value="0">Seleccione</option>
                    <?php 
                        foreach ($data as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                        }
                    ?>
                        
                    </select>
                  </div>
                  <div class="input-group err-form">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="word" name="word">
                        <label class="custom-file-label" for="exampleInputFile">Seleccione documento Word</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">WORD</span>
                      </div>
                  </div>
                    </br>
                    <div class="input-group err-form">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="pdf" name="pdf">
                        <label class="custom-file-label" for="exampleInputFile">Seleccione documento PDF</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">&nbsp; PDF &nbsp;</span>
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