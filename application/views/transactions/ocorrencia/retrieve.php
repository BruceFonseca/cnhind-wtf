<?php


foreach ($dados_periodo as $key => $value) {
    $periodos[$value['id_periodo']] = $value['dsc_periodo'];
}

foreach ($dados_planta as $key => $value) {
    $plantas[$value['id_planta']] = $value['dsc_planta'];
}

// insere dentro do array o item "", na primeira posição do array
$plantas[0]= '';
$periodos[0]='';

$this->table->set_heading('#ID', 'Planta', 'Assunto',  'Período', 'Ações');

foreach ($status as $linha):
    $id = array('data'=> $linha->id_ocorrencia, 'class'=>'id-ocorrencia');
    $acoes = array('data' => '  <button type="button" class="btn btn-default btn-xs ver">
                                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button>
                                <button type="button" class="btn btn-default btn-xs editar">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                                <button type="button" class="btn btn-default btn-xs excluir">
                                   <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
                                ', 
                  'class' => 'botoes_td');
    
    $this->table->add_row(
    $id, 
    $linha->dsc_planta, 
    $linha->dsc_assunto, 
    $linha->dsc_periodo, 
    $acoes
    );
endforeach;

echo '<div class="retrieve-table">';
if($this->session->flashdata('cadastrook')):
    echo '<div class="alert alert-success">Ocorrência excluída com sucesso.</div>';
endif;
echo '<h2>Administrar Interpretações</h2>';	

echo '<div class="filtar">';
echo '<div class="set_form">';
    echo '<div class="set_com">';
        echo form_label('Planta')."<br>";
        echo form_dropdown('id_planta',  $plantas, 0);
    echo '</div>';
    echo '<div class="set_com">';
        echo form_label('Acordo')."<br>";
        echo form_input('dsc_assunto');
    echo '</div>';

    echo '<div class="set_com">';
        echo form_label('Período')."<br>";
        echo form_dropdown('id_periodo',  $periodos, 0);
    echo '</div>';
    echo '<div class="set_com">';
    echo form_label(' ')."<br>";
    echo'    <button type="button" class="btn btn-default filtrar">
          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrar
        </button>';
    echo '</div>';
echo '</div>';
echo '</div>';



$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
echo $this->table->generate();

echo '</div>';

?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>

$('.filtrar').click(function(){
    var id_planta = $(this).closest('.set_form').find('select[name="id_planta"]').val();
    var id_periodo = $(this).closest('.set_form').find('select[name="id_periodo"]').val();
    var dsc_assunto = $(this).closest('.set_form').find('input[name="dsc_assunto"]').val();
    var thisTab = $(this).closest('.conteudo').attr('numtab'); //numero da tab atual
    var controller = 'ocorrencia/retrieve_condition';
    
    $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id_planta='+ id_planta 
                   + ' & id_periodo=' + id_periodo
                   + ' & dsc_assunto=' + dsc_assunto,
            
            success: function( response ){
                $('div[numtab="'+ thisTab +'"] .retrieve-table').remove();
                $('div[numtab="'+ thisTab +'"] script').remove();
                $('div[numtab="'+ thisTab +'"]').append(response);
            }
        });
});

$('.retrieve-table tr td button').click(function(){
	
    //encontra o id do usuário que será atualizado
	var id_ocorrencia = $(this).closest('tr').find('td[class="id-ocorrencia"]').text();
	var numTran = numTab(); //é o numero da proxima tab a ser criada
    var thisTab = $(this).closest('.conteudo').attr('numtab'); //numero da tab atual

    if($(this).hasClass('ver')== true){

        var desc = 'Interpretação';
        var controller = 'ocorrencia/interpretacao_planta/'+ id_ocorrencia;
        acao(controller, desc, numTran,id_ocorrencia);

    }else if($(this).hasClass('editar')== true){

        var desc = 'Atualizar Interpretação';
        var controller = 'ocorrencia/update/'+ id_ocorrencia;
        acao(controller, desc, numTran,id_ocorrencia);

    }else if($(this).hasClass('excluir')== true){
        
        if (confirm("Tem certeza que deseja excluir esta interpretação") == true) {
            var desc = 'Atualizar Interpretação';
            var controller = 'ocorrencia/delete/'+ id_ocorrencia;
            // acao(controller, desc, numTran,id_ocorrencia);
            excluir_ocorrencia(controller, thisTab);
        }
        
        
    }else{
        return false;
    }


});

function acao(controller, desc, numTran,id_ocorrencia){
	criarNovaAbaSemConteudo(controller, desc, numTran);

	 $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id='+ id_ocorrencia,
            
            success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
			}
        });

}

function excluir_ocorrencia(controller, thisTab){

    $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            
            success: function( response ){
                $('div[numtab="'+ thisTab +'"] .retrieve-table').remove();
                $('div[numtab="'+ thisTab +'"] script').remove();
                $('div[numtab="'+ thisTab +'"]').append(response);
                $('body,html').animate({scrollTop:0},600);
            }
        });
}



</script>

