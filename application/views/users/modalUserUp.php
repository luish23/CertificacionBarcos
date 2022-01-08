
<!-- /.card-header -->
<!-- form start -->
<form id="userFormUpdate" action="updateUsers" method="POST">
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('users'); ?></label>
        <input type="email" name="username" class="form-control" id="username" readonly="readonly" value="<?php echo $data['user']; ?>">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $this->lang->line('type_users'); ?></label>
    <select class="form-control" name="codTypeUser" id="codTypeUser">
        <option value="0"><?php echo $this->lang->line('select'); ?></option>
        <?php 
        foreach ($typeUser as $key => $value2) {
            if ($data['codTypeUser'] == $value2['id']) {
                echo '<option value="'.$value2['id'].'" selected="selected">'.$value2['description'].'</option>';
            }else{
                echo '<option value="'.$value2['id'].'">'.$value2['description'].'</option>';
            }
        }
    ?>
    </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1"><?php echo $this->lang->line('password'); ?></label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo $data['password']; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2"><?php echo $this->lang->line('confirm_password'); ?></label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?php echo $data['password']; ?>" data-rule-equalTo="#password" placeholder="Confirm Password">
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
</div>
<!-- /.card-body -->
<div class="modal-footer">
    <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()" title="Ver Clave"> <span class="fa fa-eye-slash icon"></span> </button>
    <button type="submit" id="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
    <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
</div>
</form>
