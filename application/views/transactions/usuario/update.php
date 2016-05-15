<div class='form'>
	

<?php
// var_dump($users_roles);

//transforma o array $tipo_usuario que tem outros arrays em apenas um array
for($i=0; $i < count($users_roles); $i++){
    $roles[($users_roles[$i]['id_user_roles'])] = ($users_roles[$i]['dsc_name']);
    }

	echo '<form method="post" action="" class="ajax_form">';

	echo form_fieldset('Atualizar usuário');
		
	if($flash_data):
        echo $flash_data;
    endif;

	echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');
 ?>
<div class='msg-rest-senha'></div>
<?php 


echo form_label('ID');
echo form_input(array('name'=>'id', 'class'=>'id-usuario'),  set_value('id', $query->id),'bloqued')."<br>";

echo form_label('User ID');
echo form_input(array('name'=>'username'),  set_value('username', $query->username))."<br>";

echo form_label('Nome');
echo form_input(array('name'=>'dsc_name'),  set_value('dsc_name',$query->nome))."<br>";

echo form_label('E-mail');
echo form_input(array('name'=>'email'),  set_value('dsc_name',$query->email))."<br>";

echo form_label('Matrícula');
echo form_input(array('name'=>'dsc_matricula'),    set_value('dsc_matricula', $query->dsc_matricula))."<br>";

echo form_label('Perfil');
echo form_dropdown('id_user_roles', $roles , set_value('id_user_roles', $query->id_user_roles), 1)."<br>";

echo form_label('Status');
echo form_dropdown('ativo',  array("A"=>"Ativo", "I"=>"Inativo"), set_value('ativo', $query->status), 1)."<br>";

echo form_label('');
echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Salvar', 'type'=>'submit'));
echo form_button(array('name'=>'reset-senha', 'class'=>'reset-senha', 'id'=>'reset-senha','content'=>'Reset senha', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	$(".submit").click(function(){
		// var numtab = $(this).closest("div").attr("numtab");
		// var numtab = $(this).closest("div").attr("numtab");
		var id_usuario = $(this).closest('fieldset').find('input.id-usuario').val();

		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "usuario/update/"+ id_usuario,
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

	$(".reset-senha").click(function(){
		var id_usuario = $(this).closest('fieldset').find('input.id-usuario').val();

			$.ajax({
				type: "POST",
				url: "usuario/reset_senha",
				data: 'usuario=' + id_usuario,
				success: function( response )
				{
					$('.ajax_form fieldset .msg-rest-senha').append(response);
				}
			});

			return false;
	});
</script>