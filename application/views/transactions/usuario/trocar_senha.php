<div class='form'>
	

<?php

	echo '<form method="post" action="" class="form-trocar-senha">';

	echo form_fieldset('Alterar senha');
?>
<div class='msg-troca-senha'></div>
<?php 

echo form_label('Nova senha');
echo form_input(array('name'=>'nova-senha', 'type'=>'password'),  '','bloqued')."<br>";

echo form_label('Confirmar');
echo form_input(array('name'=>'confirmar-senha', 'type'=>'password'),  '')."<br>";

echo form_label('');
echo form_button(array('name'=>'trocar-senha', 'class'=>'trocar-senha', 'id'=>'trocar-senha','content'=>'Alterar senha', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>

	$(".trocar-senha").click(function(){
		var nova_senha = $(this).closest('fieldset').find('input[name="nova-senha"]').val();
		var confirmar_senha = $(this).closest('fieldset').find('input[name="confirmar-senha"]').val();

		// alert(nova_senha + "    asfdgsad    " + confirmar_senha);

		if( nova_senha.length > 0){//se o campo não for vazio
			$.ajax({
				type: "POST",
				url: "usuario/trocar_senha",
				data: 'nova-senha=' + nova_senha + ' & confirmar-senha= ' + confirmar_senha,
				// data: 'nova-senha=' + nova_senha + ' & confirmar-senha= '+confirmar_senha,
				// data      : 'of='+ cd_of + ' & produto= ' + cd_produto  + ' & componente= ' + cd_componente,
				success: function( response )
				{
					$('.form-trocar-senha fieldset .msg-troca-senha div').remove();
					$('.form-trocar-senha fieldset .msg-troca-senha').append(response);
				}
			});

			return false;
		}//fim if

	});
</script>