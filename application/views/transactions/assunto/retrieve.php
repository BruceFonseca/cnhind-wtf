<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('Acordo', 'Ação');


foreach ($status as $linha):
$id = array('data'=> $linha->id_assunto, 'class'=>'id-assunto');

    $this->table->add_row(
    $linha->dsc_assunto, 
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;


$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario"  cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo '<div class="row">';

echo '<div class="row title-form"><h2>Administrar acordos</h2></div>'; 

    echo '<div class="row content-form">';
        echo'<a href="'.base_url('assunto/create').'"><label>Novo acordo</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Adicionar novo usuário">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
            </button></a><hr>';
    
    echo '<div class="row content-table">';
        echo $this->table->generate();
    echo '</div>';

echo '</div>';

echo '</div>';

?>

