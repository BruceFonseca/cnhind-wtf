<?php

$this->table->set_heading('Acordo', 'Ação');


foreach ($status as $linha):

$acoes = array('data' => '  
     <a href="'.base_url('assunto/update/'.$linha->id_assunto).'">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Editar">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    </button></a>
    <a href="'.base_url('assunto/delete/'.$linha->id_assunto).'"  class="delete-event">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Excluir">
       <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
    </button></a>
                                ', 
    'class' => 'botoes_td');

    $this->table->add_row(
    $linha->dsc_assunto, 
	$acoes);
endforeach;


$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario"  cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo '<div class="row">';

echo '<div class="row title-form"><h2>Administrar Acordos</h2></div>'; 

    echo '<div class="row content-form">';
    

if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

        echo'<a href="'.base_url('assunto/create').'"><label>Novo acordo</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Adicionar novo acordo">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
            </button></a><hr>';
    
    echo '<div class="row content-table">';
        echo $this->table->generate();
    echo '</div>';

echo '</div>';

echo '</div>';

?>

