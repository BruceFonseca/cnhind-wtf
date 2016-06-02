<?php
echo '<div class="row-fluid">';
echo'<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Atenção! </strong> Para gerar a comparação, arraste os itens entre "Disponíveis" "Comparando".
</div>';

echo '<div class="row title-form"><h2>Comparação entre Plantas, Períodos e Acordos</h2></div>'; 

echo '<div class="col-md-4 comparacoes-criterios">';
echo '<h3>Plantas</h3><hr>';
	echo '
	<div class="col-md-6"><label>Disponíveis</label><ul id="plantas1" class="connectedPlantas list-group">';
	foreach ($plantas as $planta) {

	    echo 
	    '<li class="ui-state-default list-group-item" id="'. $planta->id_planta .'">
	  		<span class="name">'. $planta->dsc_planta .'</span>
	    </li>';
	}

	echo '</ul></div>';

	echo '<div class="col-md-6">
	<label>Comparando</label>
	<ul id="plantas2" class="connectedPlantas list-group"></ul></div>

	</div>';

echo '<div class="col-md-4 comparacoes-criterios">';
echo '<h3>Períodos</h3><hr>';
	echo '<div class="col-md-6">
	<label>Disponíveis</label>
	<ul id="periodos1" class="connectedPeriodos list-group"></ul></div>';
	echo '<div class="col-md-6">
	<label>Comparando</label>
	<ul id="periodos2" class="connectedPeriodos list-group"></ul></div>';
echo '</div>';
echo '<div class="col-md-4 comparacoes-criterios">';
echo '<h3>Acordos</h3><hr>';
	echo '<div class="col-md-6"><label>Disponíveis</label><ul id="acordos1" class="connectedTratados list-group"></ul></div>';
	echo '<div class="col-md-6">
	<label>Comparando</label>
	<ul id="acordos2" class="connectedTratados list-group"></ul></div>';
echo '</div>';

?>
</div>
</div>
</div>

<div class="row"><div id="tabelacomparacao"></div></div>


<script>

var url_base = window.location.origin + '/cnhind-wtf/';

$(function() {
	$( "#plantas1, #plantas2" ).sortable({
	      	connectWith: ".connectedPlantas",
	      	start: function(event, ui) {
		    },
			stop: function (event, ui) {
				popular_periodos();
			}
	}).disableSelection();
});

function popular_periodos(){

		$('#periodos1 li').remove();
		$('#periodos2 li').remove();
		$('#acordos1 li').remove();
		$('#acordos2 li').remove();
		$('#tabelacomparacao').empty();


		var array = [];
		$("#plantas2 li").each(function() {
		    array.push($(this).attr('id'));
		});

		var plantas = array;

		$.ajax({
			type: "POST",
			url: url_base+"ocorrencia/retrieve_periodos_by_plantas",
			data: 'data=' + array,
			success: function( data )
			{
				$('#periodos1').append(data);
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
}

function popular_acordos(){

		$('#acordos1 li').remove();
		$('#acordos2 li').remove();
		$('#tabelacomparacao').empty();

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
			url: url_base+"ocorrencia/retrieve_acordos_by_periodos",
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
}

function apenas_ult_acordo(){
	if ($("#acordos2 li").length > 0) {
		 $("#acordos2 li").clone().appendTo( "#acordos1" );
		 $("#acordos2 li").remove();
	}
}

//quando o Sortable start em #acordos2, não remove $("#acordos2 li").remove();, conforme função acima
function apenas_ult_acordo_s_remove(){
	if ($("#acordos2 li").length > 0) {
		 $("#acordos2 li").clone().appendTo( "#acordos1" );
	}
}


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

	$('html, body').animate({
        scrollTop: $("#tabelacomparacao").offset().top
    }, 1000);

}


</script>
