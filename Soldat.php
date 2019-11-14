<?php

require 'Ennemi.php';


class Soldat extends Ennemi
{
    public function __construct($pv, $force, $xp)
    {
        //$pv = rand();
        parent::__construct($pv, $force, $xp);
    }

    public function attaqueSpeciale()
    {
        //rand
    }

}