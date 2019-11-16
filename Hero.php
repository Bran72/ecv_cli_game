<?php


class Hero extends Personnage
{
    private $name;
    private $lvl = 1;
    private $countSoldat;
    private $countChef;

    public function __construct($name, $pv, $force)
    {
        parent::__construct($pv, $force);
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPV()
    {
        return $this->pv;
    }

    public function getLvl()
    {
        return $this->lvl;
    }

    public function getForce()
    {
        return $this->force;
    }

    public function getHeroDesign()
    {
        return '       ___------__
 |\__-- /\       _-
 |/    __      -
 //\  /  \    /__
 |  o|  0|__     --_
 \\\\____-- __ \   ___-
 (@@    __/  / /_
    -_____---   --_
     //  \ \\\\   ___-
   //|\__/  \\\\  \
   \_-\_____/  \-\
        // \\\\--\|
   ____//  ||_
  /_____\ /___\ ';
    }

    public function getHeroStats()
    {
        echo "---".str_pad(strtoupper($this->name), 23,"-",STR_PAD_RIGHT)."\n";
        echo "|  LVL  |  PV  |  FORCE  |\n";
        echo "|".str_pad($this->lvl, 7," ",STR_PAD_BOTH)."|";
        echo str_pad($this->pv > 0 ? $this->pv : 0, 6," ",STR_PAD_BOTH);
        echo "|".str_pad($this->force, 9," ",STR_PAD_BOTH)."|\n";
        echo str_pad("-", 26,"-",STR_PAD_BOTH)."\n\n";
    }

    public function seSoigner()
    {
        //$this->pv += $this->pv*0.25;
        echo "\n\e[32m".$this->name." choisit de se soigner et restaure sa santé !\e[0m\n\n";
        $this->pv = $this->pvInitial;
    }

    public function levelUp()
    {
        $this->lvl ++;
        $this->pv = round($this->pvInitial + $this->pv*0.25, 2);
        $this->force = round($this->force + $this->force*0.25, 2);
        //lvl++
        //update pv
        //update force
    }

}