<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión</title>
  <!-- Custom CSS Login -->
  <link rel="stylesheet" href="../public/assets/dist/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../public/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="container">
<input type="hidden" name="data" id="data" value="<?php echo $msg ?>">

  <div class="frame">
  <div id="msg"></div>
      <div ng-app ng-init="checked = false">
        <form class="form-signin" action="login" method="POST" name="form"> 
          <label for="username">Username</label> 
          <input class="form-styling" type="email" name="username" minlength="3" placeholder="Ingresar Usuario..." /> 
          <label for="password">Password</label> 
          <input class="form-styling" type="password" name="password"  minlength="5" placeholder="Ingresar Clave..." /> 
          <button type="text" class="btn-animate btn-signin">Ingresar</button>
        </form>
      </div>
  </div>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Custom JS login -->
<script src="../public/assets/dist/js/login.js"></script>
</body>
</html>