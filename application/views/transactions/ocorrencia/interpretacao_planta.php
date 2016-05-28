<?php


$this->table->set_heading('Item', 'Descrição');

foreach ($interpretacao as $linha):

    $this->table->add_row(
    $linha->dsc_tratado, 
    $linha->dsc_interpretacao
    );
endforeach;

echo '<div class="row content-form">
        <div class="buttons-controle">';
echo 
        '
        <a class="btn-print" data-toggle="tooltip" data-placement="top" data-original-title="Imprimir" target="_blank" href= "'. base_url('pdfgerar/pdf_ocorrencia/'. $interpretacao[0]->id_ocorrencia) . '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';
    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF" target="_blank" href= "'. base_url('pdfgerar/pdf_ocorrencia/'. $interpretacao[0]->id_ocorrencia) . '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
echo '</div></div>';

echo '<div class="row">';
echo '<div class="row content-form">';
echo '<div class="row title-form">';

if ($interpretacao) {
    echo '<h2>'. $interpretacao[0]->dsc_assunto . ' - '.$interpretacao[0]->dsc_planta . ' - '. $interpretacao[0]->dsc_periodo .'</h2>';    
}else{
    echo '<h2>Não Disponivel</h2>';   
}

echo '</div><hr>'; 
echo '<div class="row content-table">';
echo '<div class="retrieve-table">';

$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

echo '</div>';

?>



