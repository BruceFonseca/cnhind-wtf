<div class='row content-form'>
<?php
echo '<div class="buttons-controle">';


if(isset($interpretacao[0]->id_assunto)){
echo 
        '
        <a class="btn-print"  data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"  target="_blank" href= "'. base_url('pdfgerar/pdf_plantas_acordo/'. $interpretacao[0]->id_assunto ). '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';

    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF"  target="_blank" href= "'. base_url('pdfgerar/pdf_plantas_acordo/'. $interpretacao[0]->id_assunto) . '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
}
echo '</div></div>';

echo '<div class="row">';
echo '<div class="row content-form">';
echo '<div class="row title-form"><h2>Interpretações Disponíveis</h2></div><hr>'; 
echo '<div class="row content-table">';

   echo '
  <!-- Table -->
  <table id="retrieve-usuario" cellpadding="2" cellspacing="1" class="table table-striped table-hover">
  <thead>
      <tr>
      <th>Acordo</th>
      <th>Planta</th>
      <th>Período</th>
      <th>Anexo</th>
      <th>Interpretação</th>
      </tr>
  </thead>
  <tbody>';

$ult_planta = NULL;
foreach ($interpretacao as $linha):
  echo '<tr>
        <td>'. $linha->dsc_assunto .'</td> 
        <td>'. $linha->dsc_planta .'</td> 
        ';
        if( strlen($linha->dsc_file)>0){
            $file = '<a target="_blank" href="'.base_url('uploads/'. $linha->dsc_file) .'" >Arquivo na Íntegra</a>';
        }else{
            $file ="<center>-</center>";
        }
  echo ' 
            
        <td>'. $linha->dsc_periodo .'</td>
        <td >'. $file .'</td>
        <td><a href="'.base_url('ocorrencia/interpretacao_planta/'.$linha->id_ocorrencia).'" title="" >Visualizar</a></td>
        </tr>';

        $ult_planta = $linha->dsc_planta;
endforeach;

  echo '</tbody></table>
';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
?>

