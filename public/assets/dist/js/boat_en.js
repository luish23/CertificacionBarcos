$(document).ready(function(){
  $('#seeBoat').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      $.ajax({
          type : 'get',
          url : 'modalBoat', //Here you will fetch records 
          data :  'id='+ rowid, //Pass $id
          success : function(data){
          $('.fetched-data').html(data);//Show fetched data from database
          }
      });
   });

   $('#updateBoat').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalBoatUp', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataUp').html(data);//Show fetched data from database
        }
    });
   });

   $('#delBoat').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalBoatDel', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataDel').html(data);//Show fetched data from database
        }
    });
   });

   $('#number_imo').on('change', function () {
    var dataIMO = $(this).val();
    $.ajax({
        type : 'post',
        url : 'checkIMO', //Here you will fetch records 
        data :  'imo='+ dataIMO, //Pass $id
        success : function(data){
          console.log(data);
          if (data) {
            alert(data);//Show fetched data from database
            $('input[name=number_imo').val('');
          }
        }
    });
   });
  
   $('#boatForm').validate({
    rules: {
      name: {
        required: true
      },
      number_imo: {
        required: true,
        minlength: 7
      },
      codShipowner: {
        required: true,
        min:1
      },
      number_register: {
        required: true,
      },
      call_sign: {
        required: true,
      },
      year_build: {
        required: true,
      },
      place_build: {
        required: true,
      },
      shipyard: {
        required: true,
      },
      type_boat: {
        required: true,
      },
      navigation: {
        required: true,
      },
      service: {
        required: true,
      },
      number_approved_passengers: {
        required: true,
      },
      total_length: {
        required: true,
        pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
      },
      length_perpendiculars: {
        required: true,
        pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
      },
      manga: {
        required: true,
        pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
      },
      structure: {
        required: true,
      },
      gross_tonnage: {
        required: true,
        pattern: "^[0-9]{1,5}[.]{1}[0-9]{1,2}",
      },
      liquid_tonnage: {
        required: true,
      },
      gross_transport: {
        required: true,
        pattern: "^[0-9]{1,5}[.]{1}[0-9]{1,2}",
      },
      engine_running: {
        required: true,
      },
      amount: {
        required: true,
      },
      mark: {
        required: true,
      },
      model: {
        required: true,
      },
      power_speed: {
        required: true,
      },
    },
    messages: {
        name: {
            required: "The field is required"
        },
        // number_imo: {
        //     required: "The field is required",
        //     minlength: "Minimo 7 digitos"
        // },
        // codShipowner: {
        //     required: "The field is required",
        //     min: "The field is required"
        // },
        number_register: {
            required: "The field is required",
        },
        // call_sign: {
        //     required: "The field is required",
        // },
        // year_build: {
        //     required: "The field is required",
        // },
        // place_build: {
        //     required: "The field is required",
        // },
        // shipyard: {
        //     required: "The field is required",
        // },
        // type_boat: {
        //     required: "The field is required",
        // },
        // navigation: {
        //     required: "The field is required",
        // },
        // service: {
        //     required: "The field is required",
        // },
        // number_approved_passengers: {
        //     required: "The field is required",
        // },
        // total_length: {
        //     required: "The field is required",
        //     pattern: "Wrong number pattern. Ej: 123.45",
        // },
        // length_perpendiculars: {
        //     required: "The field is required",
        //     pattern: "Wrong number pattern. Ej: 123.45",
        // },
        // manga: {
        //     required: "The field is required",
        //     pattern: "Wrong number pattern. Ej: 123.45",
        // },
        // structure: {
        //     required: "The field is required",
        // },
        // gross_tonnage: {
        //     required: "The field is required",
        //     pattern: "Wrong number pattern. Ej: 12345.67",
        // },
        // liquid_tonnage: {
        //     required: "The field is required",
        // },
        // gross_transport: {
        //     required: "The field is required",
        //     pattern: "Wrong number pattern. Ej: 12345.67",
        // },
        // engine_running: {
        //     required: "The field is required",
        // },
        // amount: {
        //     required: "The field is required",
        // },
        // mark: {
        //     required: "The field is required",
        // },
        // model: {
        //     required: "The field is required",
        // },
        // power_speed: {
        //     required: "The field is required",
        // },
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

  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    "language": {
      "sProcessing":    "Procesando...",
      "sLengthMenu":    "Mostrar _MENU_ registros",
      "sZeroRecords":   "No se encontraron resultados",
      "sEmptyTable":    "Ningún dato disponible en esta tabla",
      "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":   "",
      "sSearch":        "Buscar:",
      "sUrl":           "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":    "Último",
          "sNext":    "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
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

