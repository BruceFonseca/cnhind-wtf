<?php



$teste = array();
$linha = array();
$plan_per = array();

//ENCONTRA TODOS PERÍODOS POSSÍVEIS
$i =0;
foreach ($acordos as $indice => $valor){
  $p = $acordos[$indice]->dsc_planta . " " . $acordos[$indice]->dsc_periodo;
  if(!in_array($p, $plan_per)){
    $plan_per[$i] = $p;
    $i++;
  }
}

// ordena oarray
asort($plan_per);

//CRIA OS ARRYS COM CADA TRATADO... EX: FÉRIAS...
foreach ($acordos as $indice => $valor) {

  //SE NÃO EXISTE O ARRAY DO TRATDO, ENTÃO CRIA-O
  if(!isset($linha[$valor->dsc_tratado])){
    $linha[$valor->dsc_tratado] = array(
      'dsc_tratado'=> $valor->dsc_tratado,
      );
    $linha[$valor->dsc_tratado]['dsc_tratado'] = $valor->dsc_tratado; 

    //INSERE TODOS PERÍODOS DENTRO DO ARRAY CRIADO
    foreach ($plan_per as $key => $per) {
      $linha[$valor->dsc_tratado][$per] = ' ';
    }
  }


}
  
  //INSERE DENTRO DECADA TRATADO A INTERPRETAÇÃO PARA CADA PERIODO
  foreach ($linha as $key2 => $value2) {
    foreach ($value2 as $key3 => $value3) {
      $tratado = $value2['dsc_tratado'];
      $this_periodo =  $key3;

      foreach ($acordos as $key4 => $value4) {

        $dsc_tratado = $value4->dsc_tratado;
        $dsc_periodo = $value4->dsc_planta . " " . $value4->dsc_periodo;

        if($tratado == $dsc_tratado AND $this_periodo == $dsc_periodo){
          $linha[$dsc_tratado][$this_periodo] = $value4->dsc_interpretacao;
        }
      }
    }
  }

// ordena oarray
asort($linha);

// insere dentro do array o item "Descrição", na primeira posição do array
array_unshift($plan_per, 'Descrição');

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
//define o header da tabela
$this->table->set_heading($plan_per);

$new_list = $this->table->make_columns($linha);

echo '<div class="retrieve-table">';
echo '<h2> Comparação ' . $acordos[0]->dsc_assunto .'</h2>';  
    echo $this->table->generate($new_list);
echo '</div>';

?>

</div>