
<div class='form'>
	
	<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
	 	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
	</button>

<?php
        echo form_open_multipart('ocorrencia/importar', array('class' => 'upload-esturtura-produto'));
        echo form_fieldset('Carregar arquivo');
        if($id){ echo form_hidden('fihd', $id);}
    ?>
		<!-- AJAX Response will be outputted on this DIV container -->
	    <div class = "upload-messages-esturtura-produto"></div>
        <input type="file" multiple = "multiple"  class = "form-control" name="uploadfile[]" /><br />
        <input type="submit" name = "submit" value="Carregar" class = "submit-form" />
       </fieldset>
    </form>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    
    jQuery(document).ready(function($) {


        var options = {
            beforeSend: function(){
                // Replace this with your loading gif image
                $(".upload-messages-esturtura-produto").html('<p><img src = "./img/sistema/background/loading.gif" class = "loader" /> &nbsp  Aguarde, arquivo sendo carregado...</p>');
            },
            complete: function(response){
                // Output AJAX response to the div container
                $(".upload-messages-esturtura-produto").html(response.responseText);
            }
        };  
        // Submit the form
        $(".upload-esturtura-produto").ajaxForm(options);  


        return false;
        
    });

    $('#fechar-apontamento-componente').on('click', function(){
        var name_file= $('input[name="atach-file"]').val();
        if ($('.upload-esturtura-produto input[name="fihd"]').length) {
            var id = $('.upload-esturtura-produto input[name="fihd"]').val();
            insere_nome_ocorrencia(name_file, id);
        }else{
            $('.dsc_file').val(name_file);
        };

        $('.apontamento').hide();
        $('.dados_componente').hide();
        $('.dados_componente .form').remove();
        // $('.dados_componente .body-table-abastecimento').remove();
        $('.dados_componente script').remove();

    });

    function insere_nome_ocorrencia(name_file, id){

        $('#sortable2 #'+id+' a span').text(name_file);
    }
    
</script>

