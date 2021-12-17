$(function () {
  bsCustomFileInput.init();

  $('#ordersForm').validate({
    rules:{
        word:{
            required:true,
            extension: "docx|doc"
        },
        pdf:{
            required:true,
            extension: "pdf"
        }
    },
    messages: {  // <-- you must declare messages inside of "messages" option
        word:{
            required:"Campo Obligatorio",                  
            extension:"Seleccione el formato válido (docx|doc)"
        },
        pdf:{
            required:"Campo Obligatorio",                  
            extension:"Seleccione el formato válido (pdf)"
        }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.err-form').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});