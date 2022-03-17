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
    console.log(rowid);
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

  $('#genCertificado').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    console.log(rowid);
    $.ajax({
        type : 'get',
        url : 'modalCertificado', //Here you will fetch records 
        data :  'id='+ rowid+'&downloadType=F', //Pass $id
        success : function(data){
        $('.fetched-dataGen').html(data);//Show fetched data from database
        }
    });
  });

  $('#seeCertificado').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    console.log(rowid);
    $.ajax({
        type : 'get',
        url : 'modalCertificado', //Here you will fetch records 
        data :  'id='+ rowid+'&downloadType=D', //Pass $id
        success : function(data){
        $('.fetched-dataGen').html(data);//Show fetched data from database
        }
    });
  });

  $('#validOrder').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalValidOrder', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataVal').html(data);//Show fetched data from database
        }
    });
  });

  $('#codTypeCertification').change(function() {
    var selectCertif = $('option:selected', this).attr('value');

    $.ajax({
      type : 'post',
      url : 'getVerifications', //Here you will fetch records 
      data :  'idCer='+ selectCertif, //Pass $id
      success : function(data){
        console.log(data);
        var newP = $(data);
        $("#SelectListVerification").html(newP);
      }
    });

    $('#codBoat').change(function() {
      var selectCertif = $("#codTypeCertification").find('option:selected').val();
      var selectNavio = $('option:selected', this).attr('value');
      
      if (selectCertif > 0) {
        $.ajax({
          type : 'post',
          url : 'veriffOrder', //Here you will fetch records 
          data :  'idCer='+ selectCertif+'&idNav='+selectNavio, //Pass $id
          success : function(data){
            if( JSON.stringify(data.response) == 'true'){
              alert('Já existe um pedido com o mesmo tipo de certificação');
              $(":submit").attr("disabled", true);
              $(":submit").removeClass("btn-success");
              $(":submit").addClass("btn-secondary");
            }
            else{
              $(":submit").removeAttr("disabled");
              $(":submit").removeClass("btn-secondary");
              $(":submit").addClass("btn-success");
            }
          }
        });
      }

    });
    
  });

});

function listVerif() {
  var selectNavio = $("#codBoat").find('option:selected').val();
  var selectCertif = $("#codTypeCertification").find('option:selected').val();
  var selectVerif = $("#codListVerification").find('option:selected').val();
  console.log(selectNavio);
  console.log(selectCertif);
  console.log(selectVerif);
    $.ajax({
    type : 'post',
    url : 'veriffOrder', //Here you will fetch records 
    data :  'idCer='+ selectCertif+'&idNav='+selectNavio+'&idVerif='+selectVerif, //Pass $id
    success : function(data){
      console.log(data);
        if( JSON.stringify(data.response) == 'true'){
          $(":submit").attr("disabled", true);
          alert('Existe uma certificação válida para este navio');
          $(":submit").removeClass("btn-success");
          $(":submit").addClass("btn-secondary");
        }
        else{
          $(":submit").removeAttr("disabled");
          $(":submit").removeClass("btn-secondary");
          $(":submit").addClass("btn-success");
        }
      }
    })
  }

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
        codTypeCertification: {
          required: true,
          min:1
        },
        codListVerification: {
          required: true,
          min:1
        }
    },
    messages: {  // <-- you must declare messages inside of "messages" option
        codBoat: {
          required: "Por favor, selecione o navio",
          min: "Por favor, selecione o navio"
        },
        codTypeCertification: {
          required: "Por favor, selecione o Tipo de Certificação a realizar",
          min: "Por favor, selecione o Tipo de Certificação a realizar"
        },
        codOffice: {
          required: "Selecione o Escritório",
          min: "Selecione o Escritório"
        },
        codListVerification: {
          required: "Selecione a Lista de Verificação",
          min: "Selecione a Lista de Verificação"
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

// $.widget.bridge('uibutton', $.ui.button)