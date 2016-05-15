
<div class='form'>
	

<?php



echo '<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
    </button>	';
echo '<form method="post" action="" class="ajax_form">';

echo form_fieldset('Criar novo Assunto');
if($msg != NULL){
	echo $msg;
	// echo $last_id->dsc_tratado;
	echo 
		    '<div id="hide_last_assunto">
		    <li class="ui-state-default list-group-item" id="'. $last_id->id_tratado .'">
		    <span class="id">'. $last_id->id_tratado .'</span>
		  	<span class="name">'. $last_id->dsc_tratado .'</span>
		  	<a href="#"><span class="file"></span></a>
		  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
		  	<textarea name="" class="dsc_interpretacao form-control"></textarea>
		    </li></div>';
}

?>
<?php 
	echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');
 ?>

<?php 
if($this->session->flashdata('cadastrook')):
    echo '<div class="alert alert-success">'.$this->session->flashdata('cadastrook').'</div>';
endif;

echo form_label('Nome do Assunto');
echo form_input(array('name'=>'dsc_tratado'),  '')."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	$(".submit").click(function(){
		
		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "tratado/create/fast",
				data: dados,
				success: function( data )
				{
					$('.dados_componente .form').remove();
					$('.dados_componente script').remove();
					$('.dados_componente').append(data);
				}
			});

			return false;
		});
	});

	$('#fechar-apontamento-componente').on('click', function(){
        var last_assunto= $('#hide_last_assunto').html();

		$('.apontamento').hide();
		$('.dados_componente').hide();
		$('.dados_componente .form').remove();
		$('.dados_componente script').remove();
        $('#sortable1').append(last_assunto);
        $('textarea').mousedown(function(e){ e.stopPropagation(); });
	});
</script>

