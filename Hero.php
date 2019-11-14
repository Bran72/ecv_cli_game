<?php


class Hero extends Personnage
{
    private $name;
    private $lvl;

    public function __construct($name, $pv, $force, $lvl)
    {
        parent::__construct($pv, $force);
        $this->name = $name;
        $this->lvl = $lvl;
    }

    public function sayHello()
    {
        echo "Hello, my name is ".$this->name.". PV: $this->pv\n";
    }

    public function seSoigner()
    {
        $this->pv += $this->pv*0.25;
        //pv++
    }

    public function lvlUp()
    {
        $this->lvl ++;
        $this->pv += $this->pv*0.25;
        $this->force += $this->force*0.25;
        //lvl++
        //update pv
        //update force
    }

}