<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../public/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../public/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../public/assets/dist/js/demo.js"></script> -->
<!-- Custom JS login -->
<?php switch ($this->session->site_lang) {
  case 'spanish':
    $src="../public/assets/dist/js/employee.js";
    break;

  case 'english':
    $src="../public/assets/dist/js/employee_en.js";
    break;
  
  default:
    $src="../public/assets/dist/js/employee_pt.js";
    break;
} 
?>
<script src="<?php echo $src; ?>"></script>
</body>
</html>