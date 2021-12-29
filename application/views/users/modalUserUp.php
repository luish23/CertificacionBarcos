
<!-- /.card-header -->
<!-- form start -->
<form id="userFormUpdate" action="updateUsers" method="POST">
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Usuario</label>
        <input type="email" name="username" class="form-control" id="username" readonly="readonly" value="<?php echo $data['user']; ?>" placeholder="usuario@dominio.com">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo $data['password']; ?>" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword2">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?php echo $data['password']; ?>" data-rule-equalTo="#password" placeholder="Confirm Password">
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
