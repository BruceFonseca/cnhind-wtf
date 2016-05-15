<?php
// pd($interpretacao);
echo '<div class="retrieve-table">';
echo '<h2> Interpretações - '. $interpretacao[0]->dsc_planta .'</h2>';   

   echo '
  <!-- Table -->
  <table border="1" cellpadding="2" cellspacing="1" class="table">
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
        <td><a href="#" title="" ><span id="'.$linha->id_ocorrencia .'" class="glyphicon glyphicon-file" aria-hidden="true"></span></a></td>
        </tr>';

        $ult_assunt = $linha->dsc_assunto;
endforeach;

  echo '</tbody></table>
';

echo '</div>';
?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
$('.retrieve-table tr td a span').click(function(){

	//encontra o id do usuário que será atualizado
	var id_ocorrencia = $(this).attr('id');

	var desc = 'Interpretação ';
	var controller = 'ocorrencia/interpretacao_planta/'+ id_ocorrencia;
	var numTran = numTab();

	criarNovaAbaSemConteudo(controller, desc, numTran);

	 $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id='+ id_ocorrencia,
            
            success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
			}
        });

});



</script>

