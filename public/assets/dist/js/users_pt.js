
$(document).ready(function(){
  $('#seeUser').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      $.ajax({
          type : 'get',
          url : 'modalUser', //Here you will fetch records 
          data :  'id='+ rowid, //Pass $id
          success : function(data){
          $('.fetched-data').html(data);//Show fetched data from database
          }
      });
   });

   $('#updateUser').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalUserUp', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataUp').html(data);//Show fetched data from database
        }
    });
   });

   $('#deleteUser').on('show.bs.modal', function (e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type : 'get',
        url : 'modalUserDel', //Here you will fetch records 
        data :  'id='+ rowid, //Pass $id
        success : function(data){
        $('.fetched-dataDel').html(data);//Show fetched data from database
        }
    });
   });
   
});


function mostrarPassword(){
  var cambio = document.getElementById("password");
  var cambio2 = document.getElementById("password_confirm");
  if(cambio.type == "password" || cambio2.type == "password"){
    cambio.type = "text";
    cambio2.type = "text";
    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  }else{
    cambio.type = "password";
    cambio2.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}


$(function () {
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
      codTypeUser: {
        required: true,
        min:1
      },
    },
    messages: {
      username: {
        required: "Insira um nome de usuário",
        email: "Insira um nome de usuário válido"
      },
      codTypeUser: {
        required: "Selecione um tipo de usuário",
        min: "Selecione um tipo de usuário"
      },
      password: {
        required: "Por favor insira uma senha",
        minlength: "Insira mais de 5 caracteres"
      },
      password_confirm: "Por favor, confirme a senha"
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