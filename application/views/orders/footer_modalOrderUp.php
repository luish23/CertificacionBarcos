<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="../public/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
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

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
    // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask() // esta linea

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  });

  $('#condition').change(function() {
    var select = $("#condition").find('option:selected').val();
    if( select == 'CANCELADO'){
      var newP = $('<div class="form-group"><label for="exampleInputEmail1">Observación</label><textarea class="form-control" rows="3" name="reasonRejection" id="reasonRejection" placeholder="Observación"></textarea></div>');
      $("msg").append(newP);
    }
    else{
      $( "msg" ).empty();
    }
  });

  $('#provisional').change(function() {
    var select = $("#provisional").find('option:selected').val();
    if( select == '1'){
      var newP = $('<div class="form-group"><label for="exampleInputEmail1">Tiempo de Expiración</label><select class="form-control" id="expiry_time" name="expiry_time"><option value="60">60 días</option><option value="90">90 días</option><option value="120">120 días</option><option value="180">180 días</option></select></div>');
      $("msg2").append(newP);
    }
    else{
      $( "msg2" ).empty();
    }
  });

  /** PARA AGREGAR CAMPOS ADICIONALES */
  var campos_max          = 10;   //max de 10 campos
  var x = 0;
  $('#add_field').click (function(e) {
          e.preventDefault();     //prevenir novos clicks
          if (x < campos_max) {
                  $('#listas').append('<div class="pl-1">\
                                        <input type="text" class="form-control" name="namePlace_gt[]" id="namePlace_gt">\
                                        <input type="text" class="form-control" name="local_gt[]" id="local_gt">\
                                        <input type="text" class="form-control" name="length_gt[]" id="length_gt">\
                                        <a href="#" class="btn btn-danger" id="remove_field" role="button">Remover</a>\
                          </div>');
                  x++;
          }
  });
  // Remover o div anterior
  $('#listas').on("click","#remove_field",function(e) {
          e.preventDefault();
          $(this).parent('div').remove();
          x--;
  });

</script>
</body>
</html>