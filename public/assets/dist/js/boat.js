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
  
   $('#boatForm').validate({
    rules: {
      name: {
        required: true
      },
      number_imo: {
        required: true,
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
      },
      length_perpendiculars: {
        required: true,
      },
      manga: {
        required: true,
      },
      structure: {
        required: true,
      },
      gross_tonnage: {
        required: true,
      },
      liquid_tonnage: {
        required: true,
      },
      gross_transport: {
        required: true,
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
            required: "El campo es obligatorio"
        },
        number_imo: {
            required: "El campo es obligatorio",
        },
        codShipowner: {
            required: "El campo es obligatorio",
            min: "El campo es obligatorio"
        },
        number_register: {
            required: "El campo es obligatorio",
        },
        call_sign: {
            required: "El campo es obligatorio",
        },
        year_build: {
            required: "El campo es obligatorio",
        },
        place_build: {
            required: "El campo es obligatorio",
        },
        shipyard: {
            required: "El campo es obligatorio",
        },
        type_boat: {
            required: "El campo es obligatorio",
        },
        navigation: {
            required: "El campo es obligatorio",
        },
        service: {
            required: "El campo es obligatorio",
        },
        number_approved_passengers: {
            required: "El campo es obligatorio",
        },
        total_length: {
            required: "El campo es obligatorio",
        },
        length_perpendiculars: {
            required: "El campo es obligatorio",
        },
        manga: {
            required: "El campo es obligatorio",
        },
        structure: {
            required: "El campo es obligatorio",
        },
        gross_tonnage: {
            required: "El campo es obligatorio",
        },
        liquid_tonnage: {
            required: "El campo es obligatorio",
        },
        gross_transport: {
            required: "El campo es obligatorio",
        },
        engine_running: {
            required: "El campo es obligatorio",
        },
        amount: {
            required: "El campo es obligatorio",
        },
        mark: {
            required: "El campo es obligatorio",
        },
        model: {
            required: "El campo es obligatorio",
        },
        power_speed: {
            required: "El campo es obligatorio",
        },
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

