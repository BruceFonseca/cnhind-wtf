
<div class='row content-form'>

    <?php 
    
    echo 
        '
        <a class="btn-print"  data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"  target="_blank" href= "'. base_url('pdfgerar/pdf_conceito/'. $status->id_assunto). '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';
    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF"  target="_blank" href= "'. base_url('pdfgerar/pdf_conceito/'. $status->id_assunto). '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
    echo 
        '
        <a data-toggle="tooltip" data-placement="top" data-original-title="Plantas com este acordo"  class="retrieve_by_acordo" href= "'. base_url('ocorrencia/retrieve_by_acordo/'. $status->id_assunto) .'">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            </button>
        </a>
        ';

 ?>
	
</div>


<?php

echo '<div class="row">';
echo '<div class="row content-form get_conceito">';

echo '<div class="row title-form"><h2>'.$status->dsc_assunto.'</h2><hr></div>'; 

    echo 
    '
        <div class="" ctr="assunto/imprimir/'. $status->id_assunto .'">
          <!-- Default panel contents -->
          <div class="dsc_conceito">
            <p>'.
                // (urldecode($status->dsc_conceito))
                $status->dsc_conceito
            .'</p>
          </div>
        </div>
    ';

echo '</div>';
echo '</div>';

?>

</div>

