<?php


class Hero extends Personnage
{
    private $name;
    private $lvl = 1;
    private $countSoldat;
    private $countChef;
    private $countVictory;
    private $countDefeat;

    public function __construct($name, $pv, $force)
    {
        parent::__construct($pv, $force);
        $this->name = $name;
        $this->countVictory = 0;
        $this->countDefeat = 0;
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
        echo $this->getHeroDesign();
        echo "\n\n";
        echo "-".str_pad(strtoupper($this->name), 25,"-",STR_PAD_RIGHT)."\n";
        echo "|  LVL  |  PV  |  FORCE  |\n";

        echo "|".str_pad($this->lvl, 7," ",STR_PAD_BOTH)."|";
        echo $this->pv <= $this->pvInitial/3 ? "\e[31m" : "";
        echo str_pad($this->pv > 0 ? $this->pv : 0, 6," ",STR_PAD_BOTH);
        echo "\e[0m";

        echo "|".str_pad($this->force, 9," ",STR_PAD_BOTH)."|\n";
        echo str_pad("-", 26,"-",STR_PAD_BOTH)."\n\n";
    }

    public function seSoigner()
    {
        //$this->pv += $this->pv*0.25;
        echo "\n\e[32m".$this->name." choisit de se soigner et restaure sa santé !\e[0m\n\n";
        $this->pv = $this->pvInitial;
    }

    public function levelUp($ennemi)
    {
        $this->lvl ++;
        if($this->lvl > 3) {
            $this->pv = round($this->pvInitial + $this->pv * 0.25, 2);
            $this->force = round($this->force + $this->force * 0.15, 2);
        } else {
            $this->pv = round($this->pvInitial + $this->pv*1.25, 2);
            $this->force = round($this->force + $this->force * 0.75, 2);
        }
        $this->pvInitial = $this->pv;
        switch ($ennemi) {
            case 'Soldat':
                $this->countSoldat++;
                break;
            case 'Chef':
                $this->countChef++;
                break;
        }
    }

    public function getEnnemiCounter()
    {
        return [
            "soldat" => $this->countSoldat,
            "chef" => $this->countChef
        ];
}

    public function getVictories()
    {
        return $this->countVictory;
    }

    public function getDefeats()
    {
        return $this->countDefeat;
    }

    public function incrementDefeat()
    {
        $this->countDefeat++;
    }

    public function incrementVictory()
    {
        $this->countVictory++;
    }
}