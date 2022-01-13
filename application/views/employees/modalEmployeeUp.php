

<form id="updateEmployeeForm" action="updateEmployee" method="POST">
<div class="card-body">
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label>
    <input type="text" name="name" class="form-control" id="name" value="<?php echo $data['name']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('lastName'); ?></label>
    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $data['lastName']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('dni'); ?></label>
    <input type="number" name="dni" class="form-control" id="dni" value="<?php echo $data['dni']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('phone'); ?></label>
    <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $data['phone']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('position'); ?></label>
    <input type="text" name="position" class="form-control" id="position" value="<?php echo $data['position']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
    <input type="text" name="address" class="form-control" id="address" value="<?php echo $data['address']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('gender'); ?></label>
    <select class="form-control" name="gender" id="gender">
        <option value="0"><?php echo $this->lang->line('select'); ?></option>
        <?php 
            if ($data['gender'] == 'Femenino') {
                echo '<option value="Femenino" selected="selected">Femenino</option>';
                echo '<option value="Masculino">Masculino</option>';
                echo '<option value="Otro">Otro</option>';
            }elseif($data['gender'] == 'Masculino'){
                echo '<option value="Femenino">Femenino</option>';
                echo '<option value="Masculino" selected="selected">Masculino</option>';
                echo '<option value="Otro">Otro</option>';
            }elseif($data['gender'] == 'Otro'){
                echo '<option value="Femenino">Femenino</option>';
                echo '<option value="Masculino">Masculino</option>';
                echo '<option value="Otro" selected="selected">Otro</option>';
            }
        ?>
    </select>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('status'); ?></label>
    <select class="form-control" name="status" id="status">
    <?php 
        if ($data['status']) {
            echo '<option value="1" selected="selected">'.$this->lang->line('active').'</option>';
            echo '<option value="0">'.$this->lang->line('inactive').'</option>';
        }else{
            echo '<option value="1">'.$this->lang->line('active').'</option>';
            echo '<option value="0" selected="selected">'.$this->lang->line('inactive').'</option>';
        }
    ?>
    </select>
    </div>
    <!-- <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <select class="form-control" name="codUser" id="codUser">
        <option value="0">Seleccione</option>
        <?php 
        //foreach ($data as $key => $value) {
         //   echo '<option value="'.$value['id'].'">'.$value['user'].'</option>';
       // }
    ?>
    </select>
    </div>                   -->
</div>
<!-- /.card-body -->
<div class="modal-footer">
    <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
</div>
</form>