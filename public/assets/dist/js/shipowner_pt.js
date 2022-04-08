$(document).ready(function(){
    $('#updateShipowner').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'get',
            url : 'modalShipownerUp', //Here you will fetch records 
            data :  'id='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-dataUp').html(data);//Show fetched data from database
            }
        });
    });
});

$(function () {
    $('#shipownerForm').validate({
      rules: {
        name_ship: {
          required: true,
        },
/*        address: {
          required: true,
        },
        phone: {
          required: true,
        },*/
      },
      messages: {
        name_ship: {
          required: "O campo é obrigatório",
        },
/*        address: {
          required: "Por favor introduzca una Dirección",
        },
        phone: {
          required: "Por favor introduzca un Teléfono",
        },*/
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