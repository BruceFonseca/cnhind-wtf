<?php

echo '<div class="buttons-controle">';
echo 
        '
        <a class="btn-print" data-toggle="tooltip" data-placement="top" data-original-title="Imprimir" target="_blank" href= "'. base_url('pdfgerar/pdf_acordos_planta/'. $interpretacao[0]->id_planta ).'">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';
    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF" target="_blank" href= "'. base_url('pdfgerar/pdf_acordos_planta/'. $interpretacao[0]->id_planta) . '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
echo '</div>';

echo '<div class="retrieve-table">';
echo '<h2> Interpretações - '. $interpretacao[0]->dsc_planta .'</h2>';   

   echo '
  <!-- Table -->
  <table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">
  <thead>
      <tr>
      <th>Acordo</th>
      <th>Período</th>
      <th>Anexo</th>
      <th>Interpretação</th>
      </tr>
  </thead>
  <tbody>';

$ult_assunt = NULL;
foreach ($interpretacao as $linha):
  echo '<tr>';
        if($ult_assunt != $linha->dsc_assunto){
            echo  '<td colspan="" rowspan="'. $linha->cont .'" headers="">'. $linha->dsc_assunto  .'</td>';
        }
        if( strlen($linha->dsc_file)>0){
            $file = '<a target="_blank" href="'.base_url().'uploads/'. $linha->dsc_file .'" >Arquivo na Íntegra</a>';
        }else{
            $file ="-";
        }
  echo '      
        <td>'. $linha->dsc_periodo .'</td>
        <td >'. $file .'</td>
        <td><a href="'. base_url('ocorrencia/interpretacao_planta/'.$linha->id_ocorrencia).'" title="" >Visualizar</a></td>
        </tr>';

        $ult_assunt = $linha->dsc_assunto;
endforeach;

  echo '</tbody></table>
';

echo '</div>';
?>

