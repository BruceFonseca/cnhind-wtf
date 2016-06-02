<?php


$this->table->set_heading('Item', 'Descrição');


foreach ($interpretacao as $linha):

    if( strlen($linha->dsc_file)>0){
    }else{
        $file ="<center>-</center>";
    }

    $tratado = "<center>$linha->dsc_tratado</center>";
    
    $this->table->add_row(
    $tratado, 
    $linha->dsc_interpretacao
    );
endforeach;

echo '<div class="retrieve-table">';

if ($interpretacao) {
    echo '<h2> Interpretação - '. $interpretacao[0]->dsc_assunto . ' - '.$interpretacao[0]->dsc_planta . ' - '. $interpretacao[0]->dsc_periodo .'</h2>';	
}else{
    echo '<h2>Não Disponivel</h2>';   
}

$tmpl = array ( 'table_open'  => '<table width = "100%" border="1" cellpadding="2" cellspacing="1" class="table">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

echo '</div>';

?>


<script>
// $(function(){
    $(".table tbody tr").children().eq(0).addClass("center");

     $('.table tbody tr').find('td').each(function () {
        var test = $(this).text();

        if (test == "-") {
            $(this).css("text-align: center;");;
        };
    })

// });

</script>