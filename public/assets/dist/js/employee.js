
$(document).ready(function(){
  $('#seeEmployee').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      console.log(rowid);
      $.ajax({
          type : 'get',
          url : 'modalEmployee', //Here you will fetch records 
          data :  'id='+ rowid, //Pass $id
          success : function(data){
          $('.fetched-data').html(data);//Show fetched data from database
          }
      });
   });

   $('#updateEmployee').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalEmployeeUp', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataUp').html(data);//Show fetched data from database
        }
    });
   });

   $('#deleteEmployee').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalEmployeeDel', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataDel').html(data);//Show fetched data from database
        }
    });
   });
   
});

$(function () {
    //   $.validator.setDefaults({
    //     submitHandler: function () {
    //       alert( "Usuario Registrado!!" );
    //     }
    // });
    $('#employeeForm').validate({
      rules: {
          name: {
          required: true,
        },
        lastName: {
          required: true,
        },
        dni: {
          required: true,
        },
        codUser: {
          required: true,
          min:1
        },
      },
      messages: {
          name: {
          required: "Por favor ingrese un Nombre",
        },
        lastName: {
          required: "Por favor introduzca un Apellido",
        },
        dni: {
          required: "Por favor introduzca su DNI",
        },
        codUser: {
          required: "Por favor seleccione un Usuario",
          min: "Por favor seleccione un Usuario"
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });

    $('#updateEmployeeForm').validate({
      rules: {
          name: {
          required: true,
        },
        lastName: {
          required: true,
        },
        dni: {
          required: true,
        },
      },
      messages: {
          name: {
          required: "Por favor ingrese un Nombre",
        },
        lastName: {
          required: "Por favor introduzca un Apellido",
        },
        dni: {
          required: "Por favor introduzca su DNI",
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });

  });

$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});