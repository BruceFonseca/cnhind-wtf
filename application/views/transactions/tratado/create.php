<?php

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("tratado/create", $atributos);
echo "<h2>Adicionar novo Assunto</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

echo form_label('Título / Descrição do Assunto');
echo form_input(array('name'=>'dsc_tratado', 'class'=>'form-control'),  '')."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'btn btn-success', 'content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";
