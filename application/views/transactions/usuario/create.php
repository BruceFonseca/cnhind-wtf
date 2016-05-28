<?php

for($i=0; $i < count($users_roles); $i++){
    $roles[($users_roles[$i]['id_user_roles'])] = ($users_roles[$i]['dsc_name']);
    }

$atributos = array('class' => 'form', 'id' => 'myform');

echo "<div class='row content-form'>";

echo form_open("usuario/create", $atributos);
echo "<h2>Adicionar novo Usuário</h2><hr>";

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

echo form_label('User ID');
echo form_input(array('name'=>'username', 'class'=>'form-control'),  '','autofocus')."<br>";

echo form_label('Nome');
echo form_input(array('name'=>'dsc_name', 'class'=>'form-control'),  '')."<br>";

echo form_label('E-mail');
echo form_input(array('name'=>'email', 'class'=>'form-control'),  '')."<br>";

echo form_label('Matrícula');
echo form_input(array('name'=>'dsc_matricula', 'class'=>'form-control'),  '')."<br>";

echo form_label('Perfil');
echo form_dropdown('id_user_roles', $roles ,'3', 'class="form-control"')."<br>";

echo form_label('Status');
echo form_dropdown('ativo',  array("A"=>"Ativo", "I"=>"Inativo"),'A', 'class="form-control"' )."<br>";

echo form_hidden(array('name'=>'dt_added'),  date("d/m/y H:i:s"));

echo form_hidden(array('name'=>'dt_updated'),  date("d/m/y H:i:s"));

echo form_hidden('password', md5(123));
echo form_label('');

echo form_button(array('name'=>'cadastrar', 'class'=>'btn btn-success', 'content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_close();

echo "</div>";