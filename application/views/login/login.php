<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión</title>
  <!-- Custom CSS Login -->
  <link rel="stylesheet" href="../public/assets/dist/css/login.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="container">
  <div class="frame">
    <div class="nav">
    </div>
      <div ng-app ng-init="checked = false">
        <form class="form-signin" action="" method="post" name="form"> 
          <label for="username">Username</label> 
          <input class="form-styling" type="text" name="username" placeholder="" /> 
          <label for="password">Password</label> 
          <input class="form-styling" type="text" name="password" placeholder="" /> 
          <div class="btn-animate"> <a class="btn-signin">Sign in</a> </div>
        </form>
      </div>
  </div>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Custom JS login -->
<script src="../public/assets/plugins/bootstrap/js/login.js"></script>
</body>
</html>