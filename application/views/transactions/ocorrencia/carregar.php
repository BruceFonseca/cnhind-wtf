
<?php

echo "<div class='row content-form'>";

echo '<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
    </button>';

if(validation_errors()):
    echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
endif;
        echo form_open_multipart('ocorrencia/importar', array('class' => 'upload-esturtura-produto'));
        echo "<h2>Adicionar novo Anexo</h2><hr>";
    ?>
		<!-- AJAX Response will be outputted on this DIV container -->
	    <div class = "upload-messages-esturtura-produto"></div>
        <input type="file" multiple = "multiple"  class = "fileinput fileinput-new" name="uploadfile[]" /><br />
        <input type="submit" name = "submit" value="Carregar" class = "submit-form btn btn-success" />
    </form>
    <label>Arquivos anexados</label>
<ul class="list-group" id="anexos">

</ul>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script> 


    jQuery(document).ready(function($) {

        var url_base = window.location.origin;
        var options = {
            beforeSend: function(){
                // Replace this with your loading gif image
                $(".upload-messages-esturtura-produto").html('<p><img src = "'+url_base+'img/sistema/background/loading.gif" class = "loader" /> &nbsp  Aguarde, arquivo sendo carregado...</p>');
            },
            complete: function(response){
                // Output AJAX response to the div container
                $(".upload-messages-esturtura-produto").html(response.responseText);
                var name_file= $('input[name="atach-file"]').val();
              if (typeof name_file === "undefined") {
                    alert('É necessário escolher um arquivo para fazer o upload.');
                }else{
                    popular_lista(name_file);
                }
            }
        };  
        // Submit the form
        $(".upload-esturtura-produto").ajaxForm(options);  
        
        return false;
    });

    $(function() {
        //quando abre a janela, transforma os arquivos em lista
        var string = $('input[name="dsc_file"]').val();
        var array = string.split(';');

        if (string.length) {
            $.each( array, function( key, arquivo ) {
              // alert( key + ": " + value );
              var lista = '<li class="list-group-item"><button class="remover-anexo close" data-dismiss="alert" type="button">×</button>'+arquivo+'</li>';
              $('#anexos').append(lista);
            });
        };

        

    }); 


    function popular_lista(arquivo){
        var lista = '<li class="list-group-item"><button class="remover-anexo close" data-dismiss="alert" type="button">×</button>'+arquivo+'</li>';
        $('#anexos').append(lista);
    }

    function popular_input(){
        
        $('.dsc_file').val('');//limpa o input
        arquivos = "";
        $.each( $('#anexos li'), function( key, value ) {
            str = $(this).text()+';';

            arquivos = arquivos+str.slice(1);
        });
            arquivos.trim();
            fin = arquivos.length -1;

        $('.dsc_file').val(arquivos.slice(0, fin));
    }
    $('#fechar-apontamento-componente').on('click', function(){
        
        var name_file= $('input[name="atach-file"]').val();
        popular_input();

        $('#background').hide();
        $('#upload').hide();
        $('#upload div').remove();
        $('#upload script').remove();

    });

    $(document).on('click', '.remover-anexo', function(){
        $(this).parent().remove();
    });
    
</script>

