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
<script>
  $(function () {
    bsCustomFileInput.init();
  });

  $('#condition').change(function() {
    var select = $("#condition").find('option:selected').val();
    if( select == 0){
      var newP = $('<div class="form-group"><label for="exampleInputEmail1">Observación</label><textarea class="form-control" rows="3" name="reasonRejection" id="reasonRejection" placeholder="Observación"></textarea></div>');
      $("msg").append(newP);
    }
    else{
      $( "msg" ).empty();
    }
  });

</script>
</body>
</html>