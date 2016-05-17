<?php


$this->table->set_heading('Item', 'Descrição', 'Anexo');

foreach ($interpretacao as $linha):

    if( strlen($linha->dsc_file)>0){
            $file = '<a target="_blank" text-align="center" href="'.base_url('uploads/'. $linha->dsc_file) .'" >Arquivo na Íntegra</a>';
    }else{
        $file ="<center>-</center>";
    }

    $this->table->add_row(
    $linha->dsc_tratado, 
    $linha->dsc_interpretacao, 
    $file 
    );
endforeach;

echo '<div class="buttons-controle">';
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
echo '</div>';
echo '<div class="retrieve-table">';

if ($interpretacao) {
    echo '<h2> Interpretação - '. $interpretacao[0]->dsc_assunto . ' - '.$interpretacao[0]->dsc_planta . ' - '. $interpretacao[0]->dsc_periodo .'</h2>';	
}else{
    echo '<h2>Não Disponivel</h2>';   
}

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

echo '</div>';

?>



