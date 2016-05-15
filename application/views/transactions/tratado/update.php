<div class='form'>
	

	<?php

		echo '<form method="post" action="" class="ajax_form">';

		echo form_fieldset('Atualizar Assunto');
			
		if($flash_data):
	        echo $flash_data;
	    endif;

		echo  validation_errors('<div class="alert alert-danger" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>','</div>');

		echo form_label('ID Assunto');
		echo form_input(array('name'=>'id_tratado', 'class'=>'id-tratado'),  set_value('id', $query->id_tratado),'bloqued')."<br>";

		echo form_label('Nome da Planta');
		echo form_input(array('name'=>'dsc_tratado'),  set_value('dsc_tratado',$query->dsc_tratado))."<br>";

		echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Salvar', 'type'=>'submit'));

		echo form_fieldset_close();
		echo form_close();

	?>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	$(".submit").click(function(){
		// var numtab = $(this).closest("div").attr("numtab");
		// var numtab = $(this).closest("div").attr("numtab");
		var id_assunto = $(this).closest('fieldset').find('input.id-tratado').val();

		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "tratado/update/"+ id_assunto,
				data: dados,
				success: function( data )
				{
					$('div[numtab="'+ numTran +'"] div').remove();
					$('div[numtab="'+ numTran +'"]').append(data);
				}
			});

			return false;
		});
	});
</script>