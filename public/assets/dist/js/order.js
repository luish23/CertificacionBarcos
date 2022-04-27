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

    $('#provisional').change(function() {
      var select = $("#provisional").find('option:selected').val();
      if( select == '1'){
        var newP = $('<div class="form-group"><label for="exampleInputEmail1">Tiempo de Expiración</label><select class="form-select" id="expiry_time" name="expiry_time"><option value="60">60 días</option><option value="90">90 días</option><option value="120">120 días</option><option value="180">180 días</option></select></div>');
        $("msg2").append(newP);
      }
      else{
        $( "msg2" ).empty();
      }
    });

    $('#genCertificado').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      // console.log(rowid);
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
              alert('Ya existe una orden con igual tipo de certificacion');
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
          alert('Hay una certificación Vigente para este Navio');
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
          required: "Por favor seleccione el Navio",
          min: "Por favor seleccione el Navio"
        },
        codTypeCertification: {
          required: "Por favor seleccione el Tipo de Certificación a realizar",
          min: "Por favor seleccione el Tipo de Certificación a realizar"
        },
        codOffice: {
          required: "Por favor seleccione la Oficina",
          min: "Por favor seleccione la Oficina"
        },
        codListVerification: {
          required: "Por favor seleccione la Lista de Verificacion",
          min: "Por favor seleccione la Lista de Verificacion"
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

// $.widget.bridge('uibutton', $.ui.button)