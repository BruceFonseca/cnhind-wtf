<html>
    <head>
        <title> COE - FLEXIBILIDADE </title>

        <meta charset="UTF-8">
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
        <meta name="viewport" content="width=device-width">
        <style type="text/css" media="screen">
/*            body    {background: #333; color: #000; font: 12pt serif;}
            a:link, a:visited   {color: #333; text-decoration: underline;}*/

            @media print {
                  body * {
                    visibility: hidden;
                  }
                  .corpo-documento, .corpo-documento * {
                    visibility: visible;
                  }
                  .corpo-documento {
                    position: fixed;
                    left: 0;
                    top: 0;

                  }
                }

                .corpo-documento img{
                    width: 70px;
                    float: right;
                }

                .corpo-documento legend{
                    border-bottom: 1px #ccc solid;
                    padding-bottom: 10px;
                    width: 100%;
                    font-size: 20px;
                    text-align: center;
                    line-height: 40px;
                }

            .corpo-documento{
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                border: 1px #ccc solid;
                background: #fff;
                height: 992px;
                width: 699px;
                margin: 0 auto;
                padding: 20px;
            }

            .conceito{
                width: 100%;
                padding-top: 20px;
            }

            fieldset{
                border: none;
            }

            h1, h2{
                font-size: 26px;
            }

          
        </style>    
    </head>

    <body onload="window.print()">


<?php

echo '<div class="corpo-documento">';

echo form_fieldset('COE - Flexibilidade  <img id="" src=" '. base_url('img/sistema/logotipo/logo.png' ).'"/>');

    echo 
    '
        <div class="conceito" ctr="assunto/imprimir/'. $status->id_assunto .'">
          <!-- Default panel contents -->
          <h1> '. $status->dsc_assunto . '</h1>
            <p>'.
                urldecode($status->dsc_conceito)
            .'</p>
        </div>
    ';

echo form_fieldset_close();
echo '</div>';


?>
