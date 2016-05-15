<?php

foreach ($acordos as $acordo) {

      echo 
      '<li class="ui-state-default list-group-item" id="'. $acordo->id_assunto .'">
        <span class="name">'. $acordo->dsc_assunto .'</span>
      </li>';
  }


