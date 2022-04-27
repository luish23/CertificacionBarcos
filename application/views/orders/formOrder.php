  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('add_orders'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('add_orders'); ?></li>
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
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('office'); ?></label>
                    <select class="form-select" id="codOffice" name="codOffice">
                    <option value="0"><?php echo $this->lang->line('select'); ?></option>
                    <?php 
                        foreach ($offices as $key => $value2) {
                            echo '<option value="'.$value2['id'].'">'.$value2['office'].'</option>';
                        }
                    ?>   
                    </select>
                  </div>
                  <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('boat'); ?></label>
                    <select class="form-select" id="codBoat" name="codBoat">
                    <option value="0"><?php echo $this->lang->line('select'); ?></option>
                    <?php 
                        foreach ($data as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                        }
                    ?>
                        
                    </select>
                  </div>
                  <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('type_certificated'); ?></label>
                    <select class="form-select" id="codTypeCertification" name="codTypeCertification">
                    <option value="0"><?php echo $this->lang->line('select'); ?></option>
                    <?php 
                        foreach ($certifications as $key => $value3) {
                            echo '<option value="'.$value3['codCert'].'">'.$value3['name_certificate'].'</option>';
                        }
                    ?>
                        
                    </select>
                  </div>
                  <div id="SelectListVerification">
                    <div class="form-group err-form">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('type_certificated'); ?></label>
                      <select class="form-select" id="codListVerification" name="codListVerification">
                      <option value="0"><?php echo $this->lang->line('select'); ?></option>                              
                      </select>
                    </div>
                  </div>

                  <div class="form-group err-form">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('provisional'); ?></label>
                    <select class="form-select" id="provisional" name="provisional">
                    <option value="1"><?php echo $this->lang->line('yes'); ?></option>
                    <option value="0" selected="selected"><?php echo $this->lang->line('no'); ?></option>
                    </select>
                  </div>
                  <msg2></msg2>
                </div>   
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" id="submit" class="btn btn-secondary" disabled>Registrar</button>
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