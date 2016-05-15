
<div class='form'>
	

<?php


echo '<form method="post" action="" class="ajax_form_ocorrencia">';

echo form_fieldset('Comparar acordos entre Plantas');

echo form_fieldset('Plantas');
	echo '
	<ul id="plantas1" class="connectedPlantas list-group">';
	foreach ($plantas as $planta) {

	    echo 
	    '<li class="ui-state-default list-group-item" id="'. $planta->id_planta .'">
	  		<span class="name">'. $planta->dsc_planta .'</span>
	    </li>';
	}

	echo '</ul>';

	echo '<ul id="plantas2" class="connectedPlantas list-group"></ul>';
echo form_fieldset_close();	

echo form_fieldset('Períodos');
	echo '<ul id="periodos1" class="connectedPeriodos list-group"></ul>';
	echo '<ul id="periodos2" class="connectedPeriodos list-group"></ul>';
echo form_fieldset_close();	

echo form_fieldset('Acordos');	
	echo '<ul id="acordos1" class="connectedTratados list-group"></ul>';
	echo '<ul id="acordos2" class="connectedTratados list-group"></ul>';
echo form_fieldset_close();	   
 
echo form_fieldset_close();
echo form_close();



?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
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
		$('.tabela-comparacao table').remove();


		var array = [];
		$("#plantas2 li").each(function() {
		    array.push($(this).attr('id'));
		});

		var plantas = array;

		$.ajax({
			type: "POST",
			url: "ocorrencia/retrieve_periodos_by_plantas",
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
			url: "ocorrencia/retrieve_acordos_by_periodos",
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
		var controller = "ocorrencia/retrieve_tabela_comparacao";
		var numTran = numTab();

		criarNovaAbaSemConteudo(controller, desc, numTran);

		 $.ajax({
	            type      : 'post',
	            url       : controller, //é o controller que receberá
	            data      : 'data='+data,
	            
	            success: function( response ){
	 					$('div[numtab="'+ numTran +'"]').append(response);
				}
	        });

}	
</script>



