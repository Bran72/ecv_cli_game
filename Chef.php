<?php

require 'Ennemi.php';


class Chef extends Ennemi
{
    private $boostDefense;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force, $xp);
        $this->boostDefense = 0;
    }
}