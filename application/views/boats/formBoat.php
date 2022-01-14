  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('add_boat'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('add_boat'); ?></li>
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
                    <label for="inputName" class="col-2 col-form-label"><?php echo $this->lang->line('name'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $this->lang->line('name'); ?>">
                    </div>
                    <label for="inputNumeroIMO" class="col-2 col-form-label"><?php echo $this->lang->line('imo'); ?></label>
                    <div class="col-4 err-form">
                        <input type="number" class="form-control" name="number_imo" id="number_imo" placeholder="<?php echo $this->lang->line('imo'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-2 col-form-label"><?php echo $this->lang->line('shipowner'); ?></label>
                    <div class="col-4 err-form">
                        <select class="form-control" name="codShipowner" id="codShipowner">
                        <option value="0"><?php echo $this->lang->line('select'); ?></option>
                        <?php 
                            foreach ($data as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name_ship'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('number_register'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="number_register" id="number_register" placeholder="<?php echo $this->lang->line('number_register'); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('call_sign'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="call_sign" id="call_sign" placeholder="<?php echo $this->lang->line('call_sign'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('year_build'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="year_build" id="year_build" placeholder="<?php echo $this->lang->line('year_build'); ?>">
                    </div>
                </div>
                <div class="form-group row">                        
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('place_build'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="place_build" id="place_build" placeholder="<?php echo $this->lang->line('place_build'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('shipyard'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="shipyard" id="shipyard" placeholder="<?php echo $this->lang->line('shipyard'); ?>">
                    </div>
                </div>
                <div class="form-group row">                        
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('type_boat'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="type_boat" id="type_boat" placeholder="<?php echo $this->lang->line('type_boat'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('navigation'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="navigation" id="navigation" placeholder="<?php echo $this->lang->line('navigation'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('service'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="service" id="service" placeholder="<?php echo $this->lang->line('service'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('number_approved_passengers'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="number_approved_passengers" id="number_approved_passengers" placeholder="<?php echo $this->lang->line('number_approved_passengers'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('total_length'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="total_length" id="total_length" placeholder="<?php echo $this->lang->line('total_length'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('length_perpendiculars'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="length_perpendiculars" id="length_perpendiculars" placeholder="<?php echo $this->lang->line('length_perpendiculars'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('manga'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="manga" id="manga" placeholder="<?php echo $this->lang->line('manga'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('structure'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="structure" id="structure" placeholder="<?php echo $this->lang->line('structure'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('gross_tonnage'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="gross_tonnage" id="gross_tonnage" placeholder="<?php echo $this->lang->line('gross_tonnage'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('liquid_tonnage'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="liquid_tonnage" id="liquid_tonnage" placeholder="<?php echo $this->lang->line('liquid_tonnage'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('gross_transport'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="gross_transport" id="gross_transport" placeholder="<?php echo $this->lang->line('gross_transport'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('engine_running'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="engine_running" id="engine_running" placeholder="<?php echo $this->lang->line('engine_running'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('amount'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="amount" id="amount" placeholder="<?php echo $this->lang->line('amount'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('mark'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="mark" id="mark" placeholder="<?php echo $this->lang->line('mark'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('model'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="model" id="model" placeholder="<?php echo $this->lang->line('model'); ?>">
                    </div>
                    <label for="inputLabel" class="col-2 col-form-label"><?php echo $this->lang->line('power_speed'); ?></label>
                    <div class="col-4 err-form">
                        <input type="text" class="form-control" name="power_speed" id="power_speed" placeholder="<?php echo $this->lang->line('power_speed'); ?>">
                    </div>
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