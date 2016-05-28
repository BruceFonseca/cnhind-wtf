
<?php

echo "<div class='row content-form'>";

echo '<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
    </button>';

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;

if($msg != NULL){
	echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
	echo 
		    '<div id="hide_last_assunto">
		    <li class="btn btn-primary ui-sortable-handle" id="'. $last_id->id_tratado .'">
		    <span class="id">'. $last_id->id_tratado .'</span>
		  	<span class="name">'. $last_id->dsc_tratado .'</span>
		  	<textarea name="" class="dsc_interpretacao form-control"></textarea>
		    </li></div>';
}

echo '<form method="post" action="" class="ajax_form_fast">';

echo "<h2>Adicionar novo Assunto</h2><hr>";

echo form_label('Título / Descrição do Assunto');
echo form_input(array('name'=>'dsc_tratado', 'class'=>'form-control'),  '')."<br>";

echo form_button(array('name'=>'cadastrar', 'id'=>'submit_create','class'=>'btn btn-success', 'content'=>'Cadastrar', 'type'=>''))."<br>";

echo form_close();

?>

<script>

 var url_base = window.location.origin + '/cnhind-wtf/';

 $("#submit_create").on('click', function(event){
 // event.preventDefault();
	
	$('.ajax_form_fast').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url:  url_base+"tratado/create_fast",
				data: dados,
				success: function( data )
				{
					$('#tratado div').remove();
				$('#tratado').append(data);
				}
			});

			return false;
		});
	});

$('#tratado #fechar-apontamento-componente').on('click', function(){

    var last_assunto= $('#hide_last_assunto').html();

    $('#background').hide();
    $('#tratado').hide();
    $('#tratado div').remove();
    $('.sortable1').append(last_assunto);
    $('textarea').mousedown(function(e){ e.stopPropagation(); });
  });

</script>

<?php echo "</div>"; ?>