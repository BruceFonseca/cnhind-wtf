<?php

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("planta/update", $atributos);
echo "<h2>AAtualizar Planta</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

echo form_hidden('id_planta', $query->id_planta);
echo form_label('Nome da Planta');
echo form_input(array('name'=>'dsc_planta', 'class'=>'form-control'),  set_value('dsc_planta',$query->dsc_planta))."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'btn btn-success', 'content'=>'Atualizar', 'type'=>'submit'))."<br>";

echo form_close();