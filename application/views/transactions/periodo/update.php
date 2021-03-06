<?php

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("periodo/update", $atributos);
echo "<h2>Atualizar Período</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

echo form_label('Período');
echo form_input(array('name'=>'dsc_periodo', 'class'=>'form-control'), set_value('dsc_periodo',$query->dsc_periodo))."<br>";

echo form_hidden('id_periodo', $query->id_periodo);

echo form_button(array('name'=>'atualizar', 'class'=>'btn btn-success', 'content'=>'Atualizar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";