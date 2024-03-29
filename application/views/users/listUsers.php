  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('list_users'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('list_users'); ?></li>
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
                    <th><?php echo $this->lang->line('users'); ?></th>
                    <th><?php echo $this->lang->line('type_users'); ?></th>
                    <th><?php echo $this->lang->line('assigned'); ?></th>
                    <th><?php echo $this->lang->line('status'); ?></th>
                    <th><?php echo $this->lang->line('actions'); ?></th>
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
                      echo "<td>";
                      if ($session['previewInfo']) {
                        echo "<button type='button' class='btn btn-outline-success btn-rounded waves-effect' data-toggle='modal' data-target='#seeUser' data-id='".(int)$value['id']."'><i class='far fa-eye' aria-hidden='true'></i></button>";
                      }
                      if ($session['editInfo']) {
                        echo "<button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#updateUser' data-id='".(int)$value['id']."'><i class='far fa-edit' aria-hidden='true'></i></button>";
                      }
                      if ($session['deleteInfo']) {
                        echo "<button type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-3' data-toggle='modal' data-target='#deleteUser' data-id='".(int)$value['id']."'><i class='far fa-trash-alt' aria-hidden='true'></i></button>";
                      }
                      echo "</tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th><?php // echo $this->lang->line('users'); ?></th>
                    <th><?php // echo $this->lang->line('type_users'); ?></th>
                    <th><?php // echo $this->lang->line('assigned'); ?></th>
                    <th><?php // echo $this->lang->line('status'); ?></th>
                    <th><?php // echo $this->lang->line('actions'); ?></th>
                  </tr>
                  </tfoot> -->
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
              <h4 class="modal-title"><?php echo $this->lang->line('information'); ?></h4>
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
          <h4 class="modal-title"><?php echo $this->lang->line('update_information'); ?></h4>
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
          <h4 class="modal-title"><?php echo $this->lang->line('answer_delete_user'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataDel"></div>
          </div>
      </div>
  </div>
</div>