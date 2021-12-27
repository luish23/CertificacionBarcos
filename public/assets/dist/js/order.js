$(document).ready(function(){
  $('#seeOrder').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      $.ajax({
          type : 'get',
          url : 'modalOrder', //Here you will fetch records 
          data :  'id='+ rowid, //Pass $id
          success : function(data){
          $('.fetched-data').html(data);//Show fetched data from database
          }
      });
   });

   $('#updateOrder').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalOrderUp', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataUp').html(data);//Show fetched data from database
        }
    });
  });

  $('#delOrder').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalOrderDel', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataDel').html(data);//Show fetched data from database
        }
    });
  });

});

$(function () {
  bsCustomFileInput.init();

  $('#ordersForm').validate({
    rules:{
        codOffice: {
          required: true,
          min:1
        },
        codBoat: {
          required: true,
          min:1
        },
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
        },
        codBoat: {
          required: "Por favor seleccione el Navio",
          min: "Por favor seleccione el Navio"
        },
        codOffice: {
          required: "Por favor seleccione la Oficina",
          min: "Por favor seleccione la Oficina"
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

// $.widget.bridge('uibutton', $.ui.button)