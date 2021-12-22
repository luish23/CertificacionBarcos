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
          codTypeUser: {
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
          codTypeUser: {
            required: "Por favor seleccione un Tipo de Usuario",
            min: "Por favor seleccione un Tipo de Usuario"
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