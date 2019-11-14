<?php


abstract class Personnage
{
    protected $pv;
    protected $force;

    public function __construct($pv, $force)
    {
        $this->pv = $pv;
        $this->force = $force;
    }

    public function isAlive() {
        return $this->pv > 0;
    }

    public function attack(Personnage $personnage)
    {
        $personnage->pv -= $this->force;
    }

    public function setPv($pv)
    {
        $this->pv = $pv;
    }

    //abstract function specialAttack();
}