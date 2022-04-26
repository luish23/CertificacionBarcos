  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $this->lang->line('title_checkOrders'); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard"><?php echo $this->lang->line('home'); ?></a></li>
              <li class="breadcrumb-item active"><?php echo $this->lang->line('title_checkOrders'); ?></li>
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
                    <th>#</th>
                    <th><?php echo $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('imo'); ?></th>
                    <th><?php echo $this->lang->line('office'); ?></th>
                    <th><?php echo $this->lang->line('status'); ?></th>
                    <th><?php echo $this->lang->line('preview_doc'); ?></th>
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
                      echo "<td>".$value['number_imo']."</td>";
                      echo "<td>".$value['office']."</td>";
                      echo "<td>".$value['condition']."</td>";
                      echo "<td>";
                      if ($value['codWord']) {
                        echo "<a href='download/".$value['codWord']."' class='btn btn-outline-info btn-rounded waves-effect'><i class='far fa-file-word pr-2' aria-hidden='true'></i>WORD</a>";
                      } 
                      else {
                        echo "<button disabled type='button' class='btn btn-outline-info btn-rounded waves-effect'><i class='far fa-file-word pr-2' aria-hidden='true'></i>WORD</button>";
                      }
                      if ($value['codPDF']) {
                        echo "<a href='download/".$value['codPDF']."' class='btn btn-outline-danger btn-rounded waves-effect ml-3'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</a></td>";
                      }else {
                        echo "<button disabled type='button' class='btn btn-outline-danger btn-rounded waves-effect ml-3'><i class='far fa-file-pdf pr-2' aria-hidden='true'></i>PDF</button></td>";
                      } 

                      if ($value['condition'] != 'VALIDADO') {
                        $disabled = 'disabled';
                      }else {
                        $disabled = '';
                      }
                      
                      echo "<td><button type='button' class='btn btn-outline-success btn-rounded waves-effect' title='Preview Certificated' data-toggle='modal' data-target='#seeCertificado' data-id=".$value['idOrder']."><i class='far fa-eye' aria-hidden='true'></i></button>
                      <button type='button' class='btn btn-outline-info btn-rounded waves-effect ml-3' title='Validar Orden' data-toggle='modal' data-target='#validOrder' data-id=".$value['idOrder']."><i class='fas fa-check-double'></i></button></td>";
                      echo "</tr>";
                    }
                  }
                  ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>#</th>
                    <th><?php // echo $this->lang->line('name'); ?></th>
                    <th><?php // echo $this->lang->line('imo'); ?></th>
                    <th><?php // echo $this->lang->line('office'); ?></th>
                    <th><?php // echo $this->lang->line('status'); ?></th>
                    <th><?php // echo $this->lang->line('preview_doc'); ?></th>
                    <th><?php // echo $this->lang->line('actions'); ?></th>
                  </tr> -->
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

<!-- <div class="modal fade" id="seeOrder" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="fetched-data"></div>
          </div>
      </div>
  </div>
</div> -->

<div class="modal fade" id="seeCertificado" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content bg-info">
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $this->lang->line('answer_preview_certificated'); ?></h4>
          </div>
          <div class="modal-body">
              <div class="fetched-dataGen"></div>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="validOrder" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="fetched-dataVal"></div>
          </div>
      </div>
  </div>
</div>