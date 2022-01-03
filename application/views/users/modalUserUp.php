
<!-- /.card-header -->
<!-- form start -->
<form id="userFormUpdate" action="updateUsers" method="POST">
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Usuario</label>
        <input type="email" name="username" class="form-control" id="username" readonly="readonly" value="<?php echo $data['user']; ?>" placeholder="usuario@dominio.com">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Tipo de Usuario</label>
    <select class="form-control" name="codTypeUser" id="codTypeUser">
        <option value="0">Seleccione</option>
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
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo $data['password']; ?>" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?php echo $data['password']; ?>" data-rule-equalTo="#password" placeholder="Confirm Password">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Estado</label>
    <select class="form-control" name="status" id="status">
    <?php 
        if ($data['status']) {
            echo '<option value="1" selected="selected">Activo</option>';
            echo '<option value="0">Inactivo</option>';
        }else{
            echo '<option value="1">Activo</option>';
            echo '<option value="0" selected="selected">Inactivo</option>';
        }
    ?>
    </select>
    </div>
</div>
<!-- /.card-body -->
<div class="modal-footer">
    <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>">
    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()" title="Ver Clave"> <span class="fa fa-eye-slash icon"></span> </button>
    <button type="submit" id="submit" class="btn btn-success">Actualizar</button>
    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
</div>
</form>
