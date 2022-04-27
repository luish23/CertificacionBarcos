<?php // print_r($data); //die; ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('listCerts'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('listCerts'); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php // print_r($data); ?>
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
                    <th>#</th>
                    <th><?php echo $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('list_verification'); ?></th>
                    <th><?php echo $this->lang->line('certificated_status'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($data != false)
                  {
                    foreach ($data as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['office'].str_pad($value['idOrder'], 3, '0', STR_PAD_LEFT).$value['anyo']."</td>";
                      echo "<td>".$value['name']."</td>";
                      echo "<td>".$value['name_list_verification']."</td>";
                    
                      if ($value['provisional']) {
                        $provisional = "<span class='badge badge-warning ml-2'>".$this->lang->line('provisional')."</span>";
                      }else {
                        $provisional = '';
                      }
                      if ($value['idCertificated']) {
                        if ($value['estado'] == 'ACTIVO') {
                          $alert = "<span class='badge badge-success ml-2'>".$this->lang->line('order_activo')."</span>";
                        }elseif($value['estado'] == 'VENCIDO'){
                          $alert = "<span class='badge badge-danger ml-2'>".$this->lang->line('order_vence')."</span>";
                        }else{
                          $alert = "<span class='badge badge-warning ml-2'>".$this->lang->line('order_vence_prox').' '.$value['days_remaining']." días</span>";
                        }
                        echo "<td><a target='blank' href='".$value['upload_path'].$value['file_name']."' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</a>".$alert."".$provisional."</td>";
                      }else {
                        echo "<td><button disabled type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</button>".$provisional."</td>";
                      }  

                      if ($value['condition'] != 'VALIDADO') {
                        $disabled = 'disabled';
                      }else {
                        $disabled = '';
                      }
                      
                        echo "</tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>#</th>
                    <th><?php // echo $this->lang->line('name'); ?></th>
                    <th><?php // echo $this->lang->line('list_verification'); ?></th>
                    <th><?php // echo $this->lang->line('certificated_status'); ?></th>
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

<div class="modal fade" id="seeOrder" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="fetched-data"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="updateOrder" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="fetched-dataUp"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="delOrder" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content bg-secondary">
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $this->lang->line('answer_delete_order'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataDel"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="genCertificado" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content bg-info">
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $this->lang->line('answer_generate_certificated'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataGen"></div>
          </div>
      </div>
  </div>
</div>