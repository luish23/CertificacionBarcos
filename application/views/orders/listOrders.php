  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('title_listOrders'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('title_listOrders'); ?></li>
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
                    <!-- <th><?php // echo $this->lang->line('imo'); ?></th> -->
                    <!-- <th><?php // echo $this->lang->line('type_certificate'); ?></th> -->
                    <th><?php echo $this->lang->line('list_verification'); ?></th>
                    <th><?php echo $this->lang->line('process'); ?></th>
                    <th><?php echo $this->lang->line('check_documents'); ?></th>
                    <th><?php echo $this->lang->line('certificated_status'); ?></th>
                    <th><?php echo $this->lang->line('actions'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($data != false)
                  {
                    foreach ($data as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['office'].str_pad($value['idOrder'], 3, '0', STR_PAD_LEFT).$value['anyo']."</td>";
                      echo "<td>".$value['name']."</td>";
                      // echo "<td>".$value['number_imo']."</td>";
                      // echo "<td>".$value['name_certificate']."</td>";
                      echo "<td>".$value['name_list_verification']."</td>";
                      echo "<td>".$value['condition']."</td>";                      
                      echo "<td>";
                      if ($value['codWord']) {
                        echo "<a href='download/".$value['codWord']."' class='btn btn-outline-info btn-rounded waves-effect'><i class='far fa-file-word pr-2' aria-hidden='true'></i>WORD</a>";
                      } 
                      else {
                        echo "<button disabled type='button' class='btn btn-outline-info btn-rounded waves-effect'><i class='far fa-file-word pr-2' aria-hidden='true'></i>WORD</button>";
                      }
                      if ($value['codPDF']) {
                        echo "<a href='download/".$value['codPDF']."' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</a></td>";
                      }else {
                        echo "<button disabled type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</button></td>";
                      }
                      if ($value['provisional']) {
                        $provisional = "<span class='badge badge-warning ml-2'>Provisional</span>";
                      }else {
                        $provisional = '';
                      }
                      if ($value['idCertificated']) {
                        if ($value['estado'] == 'ACTIVO') {
                          $alert = "<span class='badge badge-success ml-2'>".$value['estado']."</span>";
                        }elseif($value['estado'] == 'VENCIDO'){
                          $alert = "<span class='badge badge-danger ml-2'>".$value['estado']."</span>";
                        }else{
                          $alert = "<span class='badge badge-warning ml-2'>".$value['estado']."</span>";
                        }
                        echo "<td><a target='blank' href='".$value['upload_path'].$value['file_name']."' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</a>".$alert."".$provisional."</td>";
                      }else {
                        echo "<td><button disabled type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-1'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</button></td>";
                      }  

                      if ($value['condition'] != 'VALIDADO') {
                        $disabled = 'disabled';
                      }else {
                        $disabled = '';
                      }
                      
                      echo "<td>";
                      if ($session['previewInfo']) {
                        echo "<button type='button' class='btn btn-outline-success btn-rounded waves-effect' title='Ver Orden' data-toggle='modal' data-target='#seeOrder' data-id=".$value['id']."><i class='far fa-eye' aria-hidden='true'></i></button>";
                      }
                      if ($session['editInfo']) {
                        echo "<button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-1' title='Editar Orden' data-toggle='modal' data-target='#updateOrder' data-id=".$value['idOrder']."><i class='far fa-edit' aria-hidden='true'></i></button>";
                      }
                      if ($session['deleteInfo']) {
                        echo "<button type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-1' title='Eliminar Orden' data-toggle='modal' data-target='#delOrder' data-id=".$value['idOrder']."><i class='far fa-trash-alt' aria-hidden='true'></i></button>";
                      }
                      if ($session['generateCert']) {
                        echo "<button type='button' class='btn btn-outline-primary btn-rounded waves-effect ml-1' $disabled title='Generar Certificado' data-toggle='modal' data-target='#genCertificado' data-id=".$value['idOrder']."><i class='fas fa-file-signature' aria-hidden='true'></i></button>";
                      }
                        echo "</td></tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th><?php echo $this->lang->line('name'); ?></th>
                    <!-- <th><?php // echo $this->lang->line('imo'); ?></th> -->
                    <!-- <th><?php // echo $this->lang->line('type_certificate'); ?></th> -->
                    <th><?php echo $this->lang->line('list_verification'); ?></th>
                    <th><?php echo $this->lang->line('process'); ?></th>
                    <th><?php echo $this->lang->line('check_documents'); ?></th>
                    <th><?php echo $this->lang->line('certificated_status'); ?></th>
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