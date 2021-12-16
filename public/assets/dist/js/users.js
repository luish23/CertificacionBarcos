$(function () {
//   $.validator.setDefaults({
//     submitHandler: function () {
//       alert( "Usuario Registrado!!" );
//     }
// });
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