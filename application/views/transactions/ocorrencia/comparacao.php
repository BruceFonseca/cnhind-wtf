
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

<div id="tabelacomparacao"></div>
