$(document).ready(function () {

var url_base = window.location.origin + '/cnhind-wtf/';

//sidebar
  $('#wrapper').addClass('toggled');
  $('.container').css("margin-left","0px");
  
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = true;

      trigger.removeClass('is-closed');
      trigger.addClass('is-open');

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {   
        // overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        $('.container').css("margin-left","auto");
        isClosed = false;
      } else {   
        // overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        $('.container').css("margin-left","0px");
        isClosed = true;
      }
  }

  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  


// tooltips Bootstrap
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="dropdown"]').tooltip();


//sortable
$(function() {
      $( ".sortable1, .sortable2" ).sortable(
      {
          connectWith: ".connectedSortable",
          start: function(event, ui) {
            // alert('start');
        },
      update: function (event, ui) {
          // alert('update');
          }
      }).disableSelection();
    });

  //resolve o problema do sortable, que não permite selecionar textarea dentro de sortable
  $('textarea').mousedown(function(e){ e.stopPropagation(); });




  function popular_periodos(){

    $('#periodos1 li').remove();
    $('#periodos2 li').remove();
    $('#acordos1 li').remove();
    $('#acordos2 li').remove();
    $('.tabela-comparacao table').remove();


    var array = [];
    $("#plantas2 li").each(function() {
        array.push($(this).attr('id'));
    });

    var plantas = array;

    $.ajax({
      type: "POST",
      url: url_base+"ocorrencia/retrieve_periodos_by_plantas",
      data: 'data=' + array,
      success: function(data)
      {
        $('#periodos1').append(data);
        // alert(data);
      }
    });

    $( "#periodos1, #periodos2" ).sortable({
          connectWith: ".connectedPeriodos",
          start: function(event, ui) {
        },
      stop: function (event, ui) {
        popular_acordos();
      }
    }).disableSelection();
}//end of function

function popular_acordos(){

    $('#acordos1 li').remove();
    $('#acordos2 li').remove();
    $('.tabela-comparacao table').remove();

    var plantas = [];
    $("#plantas2 li").each(function() {
        plantas.push($(this).attr('id'));
    });

    var periodos = [];
    $("#periodos2 li").each(function() {
        periodos.push($(this).attr('id'));
    });

    var dados = {};
    dados['dados'] = {            
            id_planta   : plantas,
            id_periodo  : periodos
        };

    var data = JSON.stringify(dados);

    $.ajax({
      type: "POST",
      url:  url_base+"ocorrencia/retrieve_acordos_by_periodos",
      data: 'data='+data,
      success: function( data )
      {
        $('#acordos1').append(data);
      }
    });

$( "#acordos1" ).sortable({
          connectWith: ".connectedTratados",
          start: function(event, ui) {
        apenas_ult_acordo();
        },
      stop: function (event, ui) {
        if ($("#acordos2 li").length > 0) {
          gerar_tabela();
        }
        
      }
    }).disableSelection();
$( "#acordos2").sortable({
          connectWith: ".connectedTratados",
          start: function(event, ui) {
        apenas_ult_acordo_s_remove();
        },
      stop: function (event, ui) {
        if ($("#acordos2 li").length > 0) {
          gerar_tabela();
        }
        
      }
    }).disableSelection();
}//end function

function apenas_ult_acordo(){
  if ($("#acordos2 li").length > 0) {
     $("#acordos2 li").clone().appendTo( "#acordos1" );
     $("#acordos2 li").remove();
  }
}//end function

//quando o Sortable start em #acordos2, não remove $("#acordos2 li").remove();, conforme função acima
function apenas_ult_acordo_s_remove(){
  if ($("#acordos2 li").length > 0) {
     $("#acordos2 li").clone().appendTo( "#acordos1" );
  }
}//end function

function gerar_tabela(){

    $('.tabela-comparacao div').remove();

    var plantas = [];
    $("#plantas2 li").each(function() {
        plantas.push($(this).attr('id'));
    });

    var periodos = [];
    $("#periodos2 li").each(function() {
        periodos.push($(this).attr('id'));
    });


    var acordos = [];
    $("#acordos2 li").each(function() {
        acordos.push($(this).attr('id'));
    });

    var dados = {};
    dados['dados'] = {            
            id_planta   : plantas,
            id_periodo  : periodos,
            id_acordo   : acordos
        };

    var data = JSON.stringify(dados);
    var acorodo = $("#acordos2 li").text();
    var desc = 'Comparação ' + acorodo;
    var controller = url_base+"ocorrencia/retrieve_tabela_comparacao";

     $.ajax({
              type      : 'post',
              url       : controller, //é o controller que receberá
              data      : 'data='+data,
              
              success: function( response ){
            $('#tabelacomparacao').append(response);
        }
          });

} 

//confirm delete
$('.delete-event').on('click', function(e){
  var link = $(this).attr('href');
  
  e.preventDefault();

  intRetVar = confirm("Tem certeza que deseja excluir o registro permanentemente?");

  if(intRetVar == true){
    window.location.href = link;
  }
});


//data table
$('#retrieve-usuario').DataTable({
        "language": {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
    } );

//summernote WYSIWYG Editor
$('#editoWYSIWYG').summernote({
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,
      toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear']],
              // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],
              //['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              // ['height', ['height']],
              // ['table', ['table']],
              ['insert', ['link', 'picture', 'hr']],
              // ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button 
              ['help', ['help']]
            ],
            lang: "pt-BR",
    });


//criar ocorrencia
$("#submit").click(function(event){
    // event.preventDefault();
      var id_planta  = $(this).closest('.form').find('select[name="id_planta"]').val();
      var id_periodo = $(this).closest('.form').find('select[name="id_periodo"]').val();
      var id_assunto = $(this).closest('.form').find('select[name="id_assunto"]').val();
      var dsc_file   = $(this).closest('.form').find("input[name='dsc_file']").val();
    
    var dadosAssuntos = {};

    $(".sortable2 li").each(function(){
            var self = $(this);
              dadosAssuntos[self.attr('id')] = {            
                id : self.find('.id').text(),
                name  : self.find('.name').text(),
                interpretacao  : self.find('textarea.dsc_interpretacao').val()
            };            
        });

    dadosAssuntos['dados_acordo'] = {            
            id_assunto  : id_assunto,
            id_planta   : id_planta,
            id_periodo  : id_periodo,
            dsc_file    : dsc_file
        };

    var dados = JSON.stringify(dadosAssuntos);

    $('#myform').submit(function(){

      $.ajax({
        type: "POST",
        url: url_base+"ocorrencia/create",
        data: 'data=' + dados,
        success: function( data )
        {
          window.location.href =  url_base+"interpretacoes";
        }
      });

      return false;
    });
  });

//ATUALIZAR ocorrencia
$("#submit-update").click(function(event){
      var id_planta  = $(this).closest('.form').find('select[name="id_planta"]').val();
      var id_periodo = $(this).closest('.form').find('select[name="id_periodo"]').val();
      var id_assunto = $(this).closest('.form').find('select[name="id_assunto"]').val();
      var dsc_file   = $(this).closest('.form').find("input[name='dsc_file']").val();
    
    var id = $('input[name="id_ocorrencia"]').val();
    var dadosAssuntos = {};

    $(".sortable2 li").each(function(){
            var self = $(this);
              dadosAssuntos[self.attr('id')] = {            
                id : self.find('.id').text(),
                name  : self.find('.name').text(),
                interpretacao  : self.find('textarea.dsc_interpretacao').val()
            };            
        });

    dadosAssuntos['dados_acordo'] = {            
            id_assunto  : id_assunto,
            id_planta   : id_planta,
            id_periodo  : id_periodo,
            dsc_file    : dsc_file
        };

    var dados = JSON.stringify(dadosAssuntos);

    $('#myform').submit(function(){

      $.ajax({
        type: "POST",
        url: url_base+"ocorrencia/update/"+id,
        data: 'data=' + dados,
        success: function( data )
        {
          window.location.href =  url_base+"interpretacoes";
        }
      });

      return false;
    });
  });

  $('#anexar-arquivo').on('click', function(){
       $.ajax({
              type      : 'post',
              url       : url_base+"ocorrencia/carregar",
              success: function( response ){
                  $('#background').show();
                  $('#upload').show();
                  $('#upload').css( "display", "table" );
                  $('#upload').css( "position", "absolute" );
                  $('#upload').append(response);
              }
      });
  });


  //tratado // garante que estarão fechados quando sistema carregar
  $('#tratado').hide();
  $('#tratado').css({position: '', display: 'none'});

//tratado
$('#adicionar-assunto').on('click', function(){
    var controller = url_base+'tratado/create_fast';
       $.ajax({
              type      : 'post',
              url       : controller, //é o controller que receberá
              success: function( response ){
                // alert(response);
                  $('#background').show();
                  $('#tratado').show();
                  $('#tratado').css( "display", "table" );
                  $('#tratado').css( "position", "absolute" );
                  $('#tratado').append(response);
              }
      });
  });



});//fim page