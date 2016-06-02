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
			$linha[$valor->dsc_tratado][$per] = '-';
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

//define o header da tabela
$this->table->set_heading($plan_per);

$new_list = $this->table->make_columns($linha);


echo '<div class="row content-form">';
echo '<div class="buttons-controle">';
echo 
        '
        <a class="btn-print"  data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"  target="_blank" href= "'. base_url().'pdfgerar/pdf_comparacao/'. $plantas. '/'.$periodos.'/'.$tratados. '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            </button>
        </a>
        ';
    
    echo 
        '
        <a class="btn-download" data-toggle="tooltip" data-placement="top" data-original-title="Salvar em PDF"  target="_blank" href= "'. base_url().'pdfgerar/pdf_comparacao/'. $plantas. '/'.$periodos.'/'.$tratados. '">
            <button type="button" class="btn btn-default" id="">
                <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
            </button>
        </a>
        ';  
echo '</div></div>';
echo '<div class="row content-form">';
echo '<div class="row title-form"><h2>Tabela de Comparação</h2><hr></div>';

$tmpl = array ( 'table_open'  => '<table id="retrieve-usuario"  cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
echo '<div class="row content-table">';
       echo $this->table->generate($new_list);
    echo '</div>';
?>

<script>
// tooltips Bootstrap
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="dropdown"]').tooltip();


//data table
$('#retrieve-usuario').DataTable({
	"iDisplayLength": 50,
    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
    } );

//summernote WYSIWYG Editor
$('#editoWYSIWYG').summernote({
      height: 300,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,
      toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear']],
              // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],
              //['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              // ['height', ['height']],
              // ['table', ['table']],
              ['insert', ['link', 'picture', 'hr']],
              // ['view', ['fullscreen'/*, 'codeview' */]],   // remove codeview button 
              ['help', ['help']]
            ],
            lang: "pt-BR",
    });


</script>