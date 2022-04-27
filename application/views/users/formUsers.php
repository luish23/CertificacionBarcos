  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('add_users'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('add_users'); ?></li>
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
              <form id="userForm" action="registerUsers" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('users'); ?></label>
                    <input type="email" name="username" class="form-control" id="username" placeholder="usuario@dominio.com">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('type_users'); ?></label>
                    <select class="form-select" name="codTypeUser" id="codTypeUser">
                      <option value="0"><?php echo $this->lang->line('select'); ?></option>
                      <?php 
                        foreach ($typeUser as $key => $value2) {
                            echo '<option value="'.$value2['id'].'">'.$value2['description'].'</option>';
                        }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"><?php echo $this->lang->line('password'); ?></label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="<?php echo $this->lang->line('placeholder_password'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2"><?php echo $this->lang->line('confirm_password'); ?></label>
                    <input type="password" name="password_confirm" class="form-control" id="password_confirm" data-rule-equalTo="#password" placeholder="<?php echo $this->lang->line('placeholder_confirm_password'); ?>">
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