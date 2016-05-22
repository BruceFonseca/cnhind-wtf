<?php

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("tratado/update", $atributos);
echo "<h2>Atualizar novo Assunto</h2><hr>";

echo form_hidden('id_tratado', $query->id_tratado);

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

echo form_label('Título / Descrição do Assunto');
echo form_input(array('name'=>'dsc_tratado', 'class'=>'form-control', 'value'=>$query->dsc_tratado),  '')."<br>";

echo form_button(array('name'=>'Atualizar', 'class'=>'btn btn-success', 'content'=>'Atualizar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";