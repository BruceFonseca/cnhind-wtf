<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('ID Assunto', 'Descrição', 'Editar');


foreach ($status as $linha):
$id = array('data'=> $linha->id_assunto, 'class'=>'id-assunto');

    $this->table->add_row(
    $id, 
    $linha->dsc_assunto, 
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-assuntos">';
echo '<h2>Administrar Acordos</h2>';	

$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
$this->table->set_template($tmpl);
echo $this->table->generate();

echo '</div>';

?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
$('.retrieve-assuntos tr td span').click(function(){

	//encontra o id do usuário que será atualizado
	var id_assunto = $(this).closest('tr').find('td[class="id-assunto"]').text();
	var desc = 'Atualizar Acordo ';
	var controller = 'assunto/update/'+ id_assunto;
	var numTran = numTab();

	criarNovaAbaSemConteudo(controller, desc, numTran);

	 $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'id='+ id_assunto,
            
            success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
			}
        });

});




</script>

