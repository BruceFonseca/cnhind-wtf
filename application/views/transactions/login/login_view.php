<?php
/*atributos para o form_open*/

    $attributes = array(
            'role'=>"form",
            'id' => 'login-form',
            'method' => "post",
            'autocomplete' => "off",
    );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src=<?php echo base_url("js/jquery-2.1.0.js" )?>></script>
    <script type="text/javascript" src=<?php echo base_url('js/bootstrap.min.js') ?>></script>
    <script type="text/javascript" src=<?php echo base_url('js/login.js') ?>></script>

    <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/bootstrap.min.css" )?> />
    <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/login.css" )?> />

    <meta charset="UTF-8">
    <title>Working Time Flexibility</title>
</head>
<body>
<div class="container-fluid">
<div class="ror">

<div class="col-md-5  col-md-offset-3">
    <div class="row login-container">
        <di class="col-md-6">
            <div class="row superior">
                <img id="logo-login" src="<?php echo base_url('img/sistema/logotipo/logo.png' )?>" alt=""/>
                <h3>Working Time Flexibility</h3>
            </div>
            <div class="row inferior">
                <div class="marcas">
                    <ul> 
                        <li><img src=<?php echo base_url('img/sistema/background/case_ih.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/steyr.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/case.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/nh_agricolture.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/nh_construction.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/iveco.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/iveco_astra.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/iveco_bus.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/heuliez_bus.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/iveco_magirus.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/iveco_defence.png' )?> ></li>
                        <li><img src=<?php echo base_url('img/sistema/background/fpt.png' )?> ></li>
                    </ul>
                </div>
            </div>
        </di>
        <di class="col-md-6">
            <div class="form-login">
            <h1>LOGIN</h1>
                    <?php 
                        echo  validation_errors('<div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">Error:</span>','</div>');
                    ?>

                    <?php echo form_open('verifylogin', $attributes); ?>
                        
                        <div class="reset-senha">
                            <div class="alert alert-info" role="alert">
                              <span></span>
                            </div>
                        </div>

                            <label for="userid" class="sr-only">UserID</label>
                            <input type="userid" id="username" name="username" class="form-control" placeholder="Usuário" autofocus>

                            <label for="key" class="sr-only">Senha</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Senha">

                        <input type="submit" id="btn-login" class="form-control btn btn-custom btn-lg btn-block" value="ENTRAR">
                        <div class="checkbox">
                            <a class="lembrar-senha" href="#" title=""><span class="label">Lembrar senha</span></a>
                        </div>
                    </form>
            </div>
        </di>
    </div>
</div>
</div>
</div>

</body>
<nav class="navbar-default navbar-fixed-bottom" id='fixed'>
    <div class="col-md-6  col-md-offset-4">
        <span>Desenvolvido por <a href="http://www.bflabs.com.br/" target="_blank"> bf labs - soluções web</a></span>
  </div>
</nav>

<script>
                $(function(){
                    // função que altera cor do menu
                    var url = window.location.href;
                    
                    
                });

                $('.reset-senha').hide();

                $('.lembrar-senha').on('click', function(){
                    $('.reset-senha').show();
                    reset_senha();
                });

                function addIconClasses() {
                    $(".slide_item").each(function(){
                        var scre = $("body").width();
                        $(".slide_item").width(scre);
                        $(".slide_item h1").width(scre);
                        $(".slide_item p").width(scre);
                        $(".slide_item img").width(scre);
                    });
                }

                function reset_senha(){

                    var id   = $("input[name='username']").val();

                    if (id.length > 0) {

                        var controller = 'verifylogin/lembrar_senha/'+ id;
                        $.ajax({
                                type      : 'post',
                                url       : controller, //é o controller que receberá
                                
                                success: function( response ){
                                    $('.reset-senha span').text('');
                                    $('.reset-senha span').append(response);
                                }
                        });

                    } else{
                        $('.reset-senha span').text('');
                        $('.reset-senha span').append(' Favor informar usuário');
                    };


                }

            </script>