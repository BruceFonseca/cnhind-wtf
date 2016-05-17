$(document).ready(function () {

var url_base = "http://localhost/cnhind-wtf/";

//sidebar
  $('#wrapper').addClass('toggled');
  
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
        isClosed = false;
      } else {   
        // overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
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
  $( "#plantas1, #plantas2" ).sortable({
          connectWith: ".connectedPlantas",
          start: function(event, ui) {
        },
      stop: function (event, ui) {
        popular_periodos();
      }
  }).disableSelection();

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


});//fim page