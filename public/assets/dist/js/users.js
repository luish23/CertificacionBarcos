
$(document).ready(function(){
  $('#seeUser').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      $.ajax({
          type : 'get',
          url : 'modalUser', //Here you will fetch records 
          data :  'id='+ rowid, //Pass $id
          success : function(data){
          $('.fetched-data').html(data);//Show fetched data from database
          }
      });
   });
});

$(function () {
  $('#userForm').validate({
    rules: {
      username: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      password_confirm: {
        required: true,
        minlength : 5,
        equalTo : "#password_confirm"
      },
    },
    messages: {
      username: {
        required: "Por favor ingrese un usuario",
        email: "Por favor ingrese un usuario valido"
      },
      password: {
        required: "Por favor introduzca un password",
        minlength: "Por favor introducir mas de 5 caracteres"
      },
      password_confirm: "Por favor confirme el password"
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