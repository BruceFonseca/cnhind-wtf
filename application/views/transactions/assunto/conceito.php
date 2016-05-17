<?php 

foreach ($status as $linha):
	
	echo 
    "
    <a href=  " . base_url('assunto/get_conceito/'.$linha->id_assunto) . "  title=''>
		<div class='panel panel-default conceitos'>
		  <div class='panel-heading'> ". $linha->dsc_assunto . "</div>
		  <div class='panel-body'>
		    <p>".
		    	$linha->dsc_conceito 
		    ."</p>
		  </div>
		</div>
    </a>
	";
endforeach;

?>

