<?php

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("usuario/trocar_senha", $atributos);
echo "<h2>Trocar Senha</h2><hr>";

if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

echo form_label('Nova senha');
echo form_input(array('name'=>'nova-senha', 'class'=>'form-control', 'type'=>'password'),  '','bloqued')."<br>";

echo form_label('Confirmar');
echo form_input(array('name'=>'confirmar-senha', 'class'=>'form-control', 'type'=>'password'),  '')."<br>";

echo form_label('');
echo form_button(array('name'=>'trocar-senha', 'class'=>'btn btn-success', 'content'=>'Trocar Senha', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";