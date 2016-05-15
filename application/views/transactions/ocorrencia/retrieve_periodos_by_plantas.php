<?php

foreach ($periodos as $periodo) {

      echo 
      '<li class="ui-state-default list-group-item" id="'. $periodo->id_periodo .'">
        <span class="name">'. $periodo->dsc_periodo .'</span>
      </li>';
  }


