<?php

$atributos = array('class' => 'form', 'id' => 'myform');
$data = array(
    'name'        => 'exibir',
    'value'        => 1,
    'checked'     => TRUE,
    );

echo "<div class='row content-form'>";

echo form_open("assunto/create", $atributos);
echo "<h2>Adicionar novo Acordo</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

echo form_label('Título do Acordo');
echo form_input(array('name'=>'dsc_assunto', 'class'=>'form-control'),  '')."<br>";

echo form_label('Conceito do Acordo');
echo form_textarea(array('name'=>'dsc_conceito', 'class'=>'form-control', 'id'=>'editoWYSIWYG'),  '');

echo "<div class='checkbox'>";
echo "<label>";
echo form_checkbox($data).'Exibir na home page';
echo "</label>";
echo "</div><br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'btn btn-success', 'content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";
