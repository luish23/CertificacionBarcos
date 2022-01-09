<?php 
    if ($data != false) {
?>
        <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <?php echo ucwords($data['position']); ?>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo ucwords($data['name']) . ' ' . ucwords($data['lastName']); ?></b></h2>
                      <p class="text-muted text-sm">
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <?php echo ucwords($data['address']); ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <?php echo ucwords($data['phone']); ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="../public/images/employees/<?php echo $data['photo']; ?>" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
                </div>
              </div>
              
<?php
    }else{
        echo "<h4>".$this->lang->line('msg_modalUser')."</h4>";
        echo "<div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>".$this->lang->line('close')."</button>
                </div>";
    }
?>
