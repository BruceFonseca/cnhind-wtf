
<div class='form'>




<?php
// var_dump($users_roles);

//transforma o array $tipo_usuario que tem outros arrays em apenas um array
// for($i=0; $i < count($users_roles); $i++){
//     $roles[($users_roles[$i]['id_user_roles'])] = ($users_roles[$i]['dsc_name']);
//     }

echo '<form method="post" action="" class="ajax_form">';

echo form_fieldset('Criar novo Conceito de Acordo');

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

echo '<div class="set_assunto">';
echo form_label('Título do Acordo')."<br>";
echo form_input(array('name'=>'dsc_assunto'),  '')."<br>";
echo '</div>';

echo '<div class="set_checkbox">';
echo form_checkbox('exibir', TRUE).'Exibir na home page';
echo '</div>';

echo '<div id="sample">';
echo form_label('Conceito do Acordo')."<br>";
echo form_textarea(array('name'=>'dsc_conceito', 'class'=>'form-control', 'id'=>""),  '')."<br>";
echo '</div>';

echo "<span><a href='#' class='atach-file'>Anexar arquivo </a> </span><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>";

echo form_input(array('name'=>'dsc_file', 'class'=>'dsc_file'),  '')."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Cadastrar', 'type'=>'submit'))."<br>";



echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	$(".submit").click(function(){
		var numtab = $(this).closest("div").attr("numtab");
		
		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "assunto/create",
				data: dados,
				success: function( data )
				{
					$('div[numtab="'+ numTran +'"] div').remove();
					$('div[numtab="'+ numTran +'"]').append(data);
					$('body,html').animate({scrollTop:0},600);
					update_container_conceito();
				}
			});

			return false;
		});
	});

	

	$('.atach-file').on('click', function(){
	    
	    var controller = 'ocorrencia/carregar';

	     $.ajax({
	            type      : 'post',
	            url       : controller, //é o controller que receberá
	            
	            success: function( response ){
	                $('.apontamento').show();

	                $('.dados_componente').css( "display", "table" );
	                $('.dados_componente').css( "position", "absolute" );
	                $('.dados_componente').append(response);
	            }
	    });
	});

	$(document).ready( function() {
		$('.form-control').summernote({
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
	});
</script>
