<?php

if($dados_assunto){
	for($i=0; $i < count($dados_assunto); $i++){ 
	    $id = $dados_assunto[$i]['id_assunto'];
	    $assuntos[$id] = $dados_assunto[$i]['dsc_assunto'];
	}
}else{
	$assuntos = NULL;
}

if ($dados_planta) {
	for($i=0; $i < count($dados_planta); $i++){ 
	    $id = $dados_planta[$i]['id_planta'];
	    $plantas[$id] = $dados_planta[$i]['dsc_planta'];
	}
}else{
	$plantas = NULL;
}

if($dados_periodo){
	for($i=0; $i < count($dados_periodo); $i++){ 
	    $id = $dados_periodo[$i]['id_periodo'];
	    $periodos[$id] = $dados_periodo[$i]['dsc_periodo'];
	}
}else{
	$periodos = NULL;
}

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("ocorrencia/create", $atributos);
echo "<h2>Adicionar nova Interpretação</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;


echo form_label('Planta')."<br>";
echo form_dropdown('id_planta',  $plantas, '' ,'class="form-control"').'<br>';

echo form_label('Período')."<br>";
echo form_dropdown('id_periodo',  $periodos, '' , 'class="form-control"').'<br>';

echo form_label('Acordo')."<br>";
echo form_dropdown('id_assunto',  $assuntos, '' , 'class="form-control"').'<br>';

echo'<a href="#" id="anexar-arquivo" class="atach-file"><label>Anexar arquivo</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Anexar arquivo">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
            </button></a><br><br>';

echo form_input(array('name'=>'dsc_file', 'class'=>'dsc_file form-control', 'readonly'=>'readonly'),  '')."<hr>";

echo '
 	<div class="set_assunto">
	<label>Assuntos Disponíveis /&nbsp</label><a href="#" id="adicionar-assunto" class="atach-file"><label> Novo assunto</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Adcionar um novo assunto">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
            </button></a><br><br>

	<ul id="" class="sortable1 connectedSortable list-group">';

  		for($i=0; $i < count($assuntos_disp); $i++){ 
		    $id = $assuntos_disp[$i]['id_tratado'];
		    $tratado = $assuntos_disp[$i]['dsc_tratado'];

		    echo 
		    '<li class="btn btn-primary" id="'. $id .'">
		    <span class="id">'. $id .'</span>
		  	<span class="name">'. $tratado .'</span>
		  	<textarea name="" class="dsc_interpretacao form-control"></textarea>
		    </li>';
		}
echo '</ul>';
 
 
 	echo '<label>Arraste aqui os assuntos necessários</label>
	<ul id="" class="sortable2 connectedSortable list-group">
	  
	</ul>

	</div>';


echo form_button(array('name'=>'cadastrar', 'class'=>'btn btn-success', 'id'=>'submit', 'content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";
