<?php

$this->table->set_heading('Planta', 'Assunto',  'Período', 'Ação');

foreach ($status as $linha):
    $acoes = array('data' => '  
     <a href="'.base_url('ocorrencia/update/'.$linha->id_ocorrencia).'">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Editar">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    </button></a>
    <a href="'.base_url('ocorrencia/delete/'.$linha->id_ocorrencia).'" class="delete-event">
    <button type="button" class="btn btn-default"  data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Excluir">
       <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
    </button></a>
                                ', 
    'class' => 'botoes_td');;
    
    $this->table->add_row(
    $linha->dsc_planta, 
    $linha->dsc_assunto, 
    $linha->dsc_periodo, 
    $acoes
    );
endforeach;


$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario"  cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo '<div class="row">';

echo '<div class="row title-form"><h2>Administrar Interpretações</h2></div>'; 

    echo '<div class="row content-form">';
    

if($this->session->flashdata('excluirok')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('excluirok').'</div>';
endif;

if($this->session->flashdata('excluirNOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('excluirNOK').'</div>';
endif;

//exibe as menssagens de sessions definitivas. estão separadas porque após exibi-las, elas são destruidas
if($this->session->userdata('ocorrencia-OK')):
    echo '<div class="alert alert-success" role="alert">'.$this->session->userdata('ocorrencia-OK').'</div>';
    $this->session->unset_userdata('ocorrencia-OK');
endif;
if($this->session->userdata('ocorrencia-NOK')):
    echo '<div class="alert alert-danger" role="alert">'.$this->session->userdata('ocorrencia-NOK').'</div>';
    $this->session->unset_userdata('ocorrencia-NOK');
endif;

        echo'<a href="'.base_url('ocorrencia/create').'"><label>Nova interpretação</label>
            <button type="button" class="btn btn-default" data-toggle="tooltip" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Adicionar nova interpretação">
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
            </button></a><hr>';
    
    echo '<div class="row content-table">';
        echo $this->table->generate();
    echo '</div>';

echo '</div>';

echo '</div>';

?>
