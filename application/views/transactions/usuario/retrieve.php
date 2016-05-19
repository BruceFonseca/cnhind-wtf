<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('User id', 'Nome','Matrícula','Acesso','Status', 'Ação');


foreach ($status as $linha):

$acoes = array('data' => '  
     <a href="'.base_url('usuario/update/'.$linha->id).'">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Editar">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    </button></a>
    <a href="'.base_url('usuario/delete/'.$linha->id).'">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Excluir">
       <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
    </button></a>
                                ', 
    'class' => 'botoes_td');

    $this->table->add_row(
    $linha->username, 
    $linha->nome, 
    $linha->dsc_matricula, 
    $linha->role, 
    $linha->status,
    $acoes
	);
endforeach;

$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario"  cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo '<div class="row">';

echo '<div class="row title-form"><h2>Administrar usuários</h2></div>'; 

    echo '<div class="row content-form">';
        echo'<a href="'.base_url('usuario/create').'"><label>Novo usuário</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Adicionar novo usuário">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
            </button></a><hr>';
    
    echo '<div class="row content-table">';
        echo $this->table->generate();
    echo '</div>';

echo '</div>';

echo '</div>';

?>

