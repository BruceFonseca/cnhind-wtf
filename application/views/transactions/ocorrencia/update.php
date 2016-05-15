
<div class='form'>
	

<?php

// pd($dados_ocorrencia->id_assunto);
// pd($assuntos_disp);

for($i=0; $i < count($dados_assunto); $i++){ 
    $id = $dados_assunto[$i]['id_assunto'];
    $assuntos[$id] = $dados_assunto[$i]['dsc_assunto'];
}

for($i=0; $i < count($dados_planta); $i++){ 
    $id = $dados_planta[$i]['id_planta'];
    $plantas[$id] = $dados_planta[$i]['dsc_planta'];
}

for($i=0; $i < count($dados_periodo); $i++){ 
    $id = $dados_periodo[$i]['id_periodo'];
    $periodos[$id] = $dados_periodo[$i]['dsc_periodo'];
}

echo '<form method="post" action="" class="ajax_form_ocorrencia">';

echo form_fieldset('Atualizar interpretação');

if($flash_data):
	echo $flash_data;
endif;

echo '<div class="set_form">';
echo form_hidden('id_ocorrencia', $dados_ocorrencia->id_ocorrencia);

	echo '<div class="set_com">';
		echo form_label('Planta')."<br>";
		echo form_dropdown('id_planta',  $plantas, $dados_ocorrencia->id_planta);
	echo '</div>';

	echo '<div class="set_com">';
		echo form_label('Período')."<br>";
		echo form_dropdown('id_periodo',  $periodos, $dados_ocorrencia->id_periodo);
	echo '</div>';
echo '</div>';

echo '<div class="set_assunto">';
	echo form_label('Acordo')."<br>";
	echo form_dropdown('id_assunto',  $assuntos, $dados_ocorrencia->id_assunto );
echo '</div>';

echo "<a href='#' class='atach-file'> Anexar arquivo " .'<span class="glyphicon glyphicon-paperclip" aria-hidden="true">'."</span></a>";

echo form_input(array('name'=>'dsc_file', 'class'=>'dsc_file file'), set_value('dsc_file', $dados_ocorrencia->dsc_file))."<br>";

echo '
 	<div class="set_assunto">
	<label>Assuntos Disponíveis </label> <a href="#"> Adicionar assuntos <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
	<br>
	<ul class="sortable1 connectedSortable list-group">';

  		for($i=0; $i < count($assuntos_disp); $i++){ 
		    $id = $assuntos_disp[$i]['id_tratado'];
		    $tratado = $assuntos_disp[$i]['dsc_tratado'];

		    echo 
		    '<li class="ui-state-default list-group-item" id="'. $id .'">
		    <span class="id">'. $id .'</span>
		  	<span class="name">'. $tratado .'</span>
		  	<a href="#"><span class="file"></span></a>
		  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
		  	<textarea name="" class="dsc_interpretacao form-control"></textarea>
		    </li>';
		}
echo '</ul>';
 
 
 	echo '<label>Assuntos Utilizados</label>
	<ul class="sortable2 connectedSortable list-group">';
	  
	  for($i=0; $i < count($assuntos_util); $i++){ 
		    $id = $assuntos_util[$i]['id_tratado'];
		    $tratado = $assuntos_util[$i]['dsc_tratado'];
		    $file = $assuntos_util[$i]['dsc_file'];
		    $dsc_interpretacao = $assuntos_util[$i]['dsc_interpretacao'];
		    // $file = isset($assuntos_util[$i]['dsc_file'])     ? $assuntos_util[$i]['dsc_file']    : 'Não disponível';

		    echo 
		    '<li class="ui-state-default list-group-item" id="'. $id .'">
		    <span class="id">'. $id .'</span>
		  	<span class="name">'. $tratado .'</span>
		  	<a href="#"><span class="file">'. $file .'</span></a>
		  	<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
		  	<textarea name="" class="dsc_interpretacao form-control">'. $dsc_interpretacao .'</textarea>
		    </li>';
		}
	
	echo '</ul>

	</div>';

echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'content'=>'Salvar', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	
	$(".submit").click(function(event){
		// event.preventDefault();
        var id_planta  = $(this).closest('.conteudo').find('select[name="id_planta"]').val();
    	var id_periodo = $(this).closest('.conteudo').find('select[name="id_periodo"]').val();
    	var id_assunto = $(this).closest('.conteudo').find('select[name="id_assunto"]').val();
    	var dsc_file   = $(this).closest('.conteudo').find("input[name='dsc_file']").val();
    	var thisTab    = $(this).closest('.conteudo').attr('numtab'); //numero da tab atual

		var id = $('.set_form input[name="id_ocorrencia"]').val();
		var dadosAssuntos = {};
		
		$('div[numtab="'+ thisTab +'"] div .sortable2 li').each(function(){
            var self = $(this);
            	dadosAssuntos[self.attr('id')] = {            
                id : self.find('.id').text(),
                name  : self.find('.name').text(),
                file  : self.find('.file').text(),
                interpretacao  : self.find('textarea.dsc_interpretacao').val()
            };            
        });

		dadosAssuntos['dados_acordo'] = {            
            id_assunto  : id_assunto,
            id_planta   : id_planta,
            id_periodo  : id_periodo,
            dsc_file    : dsc_file
        };

		var dados = JSON.stringify(dadosAssuntos);

		var numtab = $(this).closest("div.conteudo").attr("numtab");
		
		$('.ajax_form_ocorrencia').submit(function(){

			$.ajax({
				type: "POST",
				url: "ocorrencia/update/"+ id,
				data: 'data=' + dados,
				success: function( data )
				{
					$('div[numtab="'+ thisTab +'"] div').remove();
					$('div[numtab="'+ thisTab +'"]').append(data);
					$('body,html').animate({scrollTop:0},600);
				}
			});

			return false;
		});
	});

	$('.glyphicon.glyphicon-paperclip').on('click',function(){
		var id = $(this).closest("li").attr("id");
		var controller = 'ocorrencia/carregar/'+ id;
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


	$('.set_assunto a').on('click', function(){
	    var controller = 'tratado/create/fast';
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

	$(function() {
	    $( ".sortable1, .sortable2" ).sortable(
	    {
	      	connectWith: ".connectedSortable",
	      	start: function(event, ui) {
		        // alert('start');
		    },
			update: function (event, ui) {
					// alert('update');
			    }
	    }).disableSelection();
	    update_menu_sidebar();
  	});

	//resolve o problema do sortable, que não permite selecionar textarea dentro de sortable
	$('textarea').mousedown(function(e){ e.stopPropagation(); });


</script>