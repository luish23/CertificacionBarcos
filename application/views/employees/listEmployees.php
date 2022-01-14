  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('list_employees'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('list_employees'); ?></li>
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
                    <th><?php echo $this->lang->line('name_lastname'); ?></th>
                    <th><?php echo $this->lang->line('phone'); ?></th>
                    <th><?php echo $this->lang->line('position'); ?></th>
                    <th><?php echo $this->lang->line('status'); ?></th>
                    <th><?php echo $this->lang->line('actions'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($data != false)
                  {
                    foreach ($data as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['name']. ' ' .$value['lastName']."</td>";
                      echo "<td>".$value['phone']."</td>";
                      echo "<td>".$value['position']."</td>";
                      echo "<td>". $retVal2 = ($value['status']) ? $this->lang->line('active') : $this->lang->line('inactive') ."</td>";                      
                      echo "<td>";
                      if ($session['previewInfo']) {
                        echo "<button type='button' class='btn btn-outline-success btn-rounded waves-effect' data-toggle='modal' data-target='#seeEmployee' data-id='".(int)$value['id']."'><i class='far fa-eye' aria-hidden='true'></i></button>";
                      }
                      if ($session['editInfo']) {
                        echo "<button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#updateEmployee' data-id='".(int)$value['id']."'><i class='far fa-edit' aria-hidden='true'></i></button>";
                      }
                      if ($session['deleteInfo']) {
                        echo "<button type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#deleteEmployee' data-id='".(int)$value['id']."'><i class='far fa-trash-alt' aria-hidden='true'></i></button>";
                      }
                      echo "</td></tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th><?php echo $this->lang->line('name_lastname'); ?></th>
                    <th><?php echo $this->lang->line('phone'); ?></th>
                    <th><?php echo $this->lang->line('position'); ?></th>
                    <th><?php echo $this->lang->line('status'); ?></th>
                    <th><?php echo $this->lang->line('actions'); ?></th>
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



<div class="modal fade" id="seeEmployee" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $this->lang->line('information'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-data"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="updateEmployee" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title"><?php echo $this->lang->line('update_information'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataUp"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="deleteEmployee" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content bg-secondary">
          <div class="modal-header">
          <h4 class="modal-title"><?php echo $this->lang->line('answer_delete_employee'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataDel"></div>
          </div>
      </div>
  </div>
</div>