  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('add_employees'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('add_employees'); ?></li>
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
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo $this->lang->line('placeholder_name_employee'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('lastName'); ?></label>
                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="<?php echo $this->lang->line('placeholder_lastName_employee'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('dni'); ?></label>
                    <input type="number" name="dni" class="form-control" id="dni" placeholder="987654321">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="987654321">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('position'); ?></label>
                    <input type="text" name="position" class="form-control" id="position" placeholder="<?php echo $this->lang->line('placeholder_position_employee'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="<?php echo $this->lang->line('placeholder_address_employee'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('gender'); ?></label>
                    <select class="form-select" name="gender" id="gender">
                      <option value="0"><?php echo $this->lang->line('select'); ?></option>
                      <option value="Femenino">Femenino</option>
                      <option value="Masculino">Masculino</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('user'); ?></label>
                    <select class="form-select" name="codUser" id="codUser">
                      <option value="0"><?php echo $this->lang->line('select'); ?></option>
                      <?php 
                        foreach ($data as $key => $value) {
                            echo '<option value="'.$value['id'].'">'.$value['user'].'</option>';
                        }
                    ?>
                    </select>
                  </div>   
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('shipowner'); ?></label>
                    <select class="form-select selectpicker" id="select-country" data-live-search="true">
                      <option value="0"><?php echo $this->lang->line('select'); ?></option>
                      <?php 
                        foreach ($shipowner as $key2 => $value2) {
                            echo '<option value="'.$value2['id'].'">'.$value2['name_ship'].'</option>';
                        }
                      ?>
                    </select>
                  </div>         
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" id="submit" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
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