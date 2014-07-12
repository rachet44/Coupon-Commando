<?php

        //may need to subindex this
        include("../../lib/view.inc");
        $view = new View();

        //If the generated code is disabled, this routine will cause the runtime
        //to cease any further processing
        $view->doGeneratedCodeCheck();

        //Gets the onetimeoffer, or whatever user specfies should happen for
        //people who come in off web
        $view->getNextActionForGeneratedCode("samurai_fish_fry");

      ?>

