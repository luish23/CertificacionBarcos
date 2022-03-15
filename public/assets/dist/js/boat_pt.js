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
        // number_imo: {
        //   required: true,
        //   minlength: 7
        // },
        // codShipowner: {
        //   required: true,
        //   min:1
        // },
        number_register: {
          required: true,
        },
        // call_sign: {
        //   required: true,
        // },
        // year_build: {
        //   required: true,
        // },
        // place_build: {
        //   required: true,
        // },
        // shipyard: {
        //   required: true,
        // },
        // type_boat: {
        //   required: true,
        // },
        // navigation: {
        //   required: true,
        // },
        // service: {
        //   required: true,
        // },
        // number_approved_passengers: {
        //   required: true,
        // },
        // total_length: {
        //   required: true,
        //   pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
        // },
        // length_perpendiculars: {
        //   required: true,
        //   pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
        // },
        // manga: {
        //   required: true,
        //   pattern: "^[0-9]{1,3}[.]{1}[0-9]{1,2}",
        // },
        // structure: {
        //   required: true,
        // },
        // gross_tonnage: {
        //   required: true,
        //   pattern: "^[0-9]{1,5}[.]{1}[0-9]{1,2}",
        // },
        // liquid_tonnage: {
        //   required: true,
        // },
        // gross_transport: {
        //   required: true,
        //   pattern: "^[0-9]{1,5}[.]{1}[0-9]{1,2}",
        // },
        // engine_running: {
        //   required: true,
        // },
        // amount: {
        //   required: true,
        // },
        // mark: {
        //   required: true,
        // },
        // model: {
        //   required: true,
        // },
        // power_speed: {
        //   required: true,
        // },
      },
      messages: {
          name: {
              required: "O campo é obrigatório"
          },
        //   number_imo: {
        //       required: "O campo é obrigatório",
        //       minlength: "Minimo 7 digitos"
        //   },
        //   codShipowner: {
        //       required: "O campo é obrigatório",
        //       min: "O campo é obrigatório"
        //   },
          number_register: {
              required: "O campo é obrigatório",
          },
        //   call_sign: {
        //       required: "O campo é obrigatório",
        //   },
        //   year_build: {
        //       required: "O campo é obrigatório",
        //   },
        //   place_build: {
        //       required: "O campo é obrigatório",
        //   },
        //   shipyard: {
        //       required: "O campo é obrigatório",
        //   },
        //   type_boat: {
        //       required: "O campo é obrigatório",
        //   },
        //   navigation: {
        //       required: "O campo é obrigatório",
        //   },
        //   service: {
        //       required: "O campo é obrigatório",
        //   },
        //   number_approved_passengers: {
        //       required: "O campo é obrigatório",
        //   },
        //   total_length: {
        //       required: "O campo é obrigatório",
        //       pattern: "Padrão de número errado. Ej: 123.45",
        //   },
        //   length_perpendiculars: {
        //       required: "O campo é obrigatório",
        //       pattern: "Padrão de número errado. Ej: 123.45",
        //   },
        //   manga: {
        //       required: "O campo é obrigatório",
        //       pattern: "Padrão de número errado. Ej: 123.45",
        //   },
        //   structure: {
        //       required: "O campo é obrigatório",
        //   },
        //   gross_tonnage: {
        //       required: "O campo é obrigatório",
        //       pattern: "Padrão de número errado. Ej: 12345.67",
        //   },
        //   liquid_tonnage: {
        //       required: "O campo é obrigatório",
        //   },
        //   gross_transport: {
        //       required: "O campo é obrigatório",
        //       pattern: "Padrão de número errado. Ej: 12345.67",
        //   },
        //   engine_running: {
        //       required: "O campo é obrigatório",
        //   },
        //   amount: {
        //       required: "O campo é obrigatório",
        //   },
        //   mark: {
        //       required: "O campo é obrigatório",
        //   },
        //   model: {
        //       required: "O campo é obrigatório",
        //   },
        //   power_speed: {
        //       required: "O campo é obrigatório",
        //   },
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
        "sProcessing":    "Em processamento...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "nenhum resultado encontrado",
        "sEmptyTable":    "Não há dados disponíveis nesta tabela",
        "sInfo":          "Mostrando registros de _START_ a _END_ de um total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros de 0 a 0 de um total de 0 registros",
        "sInfoFiltered":  "(filtrando um total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Olhe para:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sLast":    "Mais recentes",
            "sNext":    "Seguindo",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Marque para classificar a coluna em ordem crescente",
            "sSortDescending": ": Marque para classificar a coluna decrescente"
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
  
  