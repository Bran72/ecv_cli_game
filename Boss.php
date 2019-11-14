<?php

require 'Ennemi.php';


class Boss extends Ennemi
{
    private $boostForce;
    private $boostDefense;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force, $xp);
        $this->boostForce = 0;
        $this->boostDefense = 0;
    }
}