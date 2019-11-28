<?php


class Ennemi extends Personnage {
    private $xp;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force);
        $this->xp = $xp;
    }

    public function getStats() {
        parent::getLifeBar();
        echo str_pad("_", 23,"_",STR_PAD_BOTH)."\n";
        echo "|  PV  | FORCE |  XP  |\n";
        echo "|".str_pad($this->pv > 0 ? $this->pv : 0, 6," ",STR_PAD_BOTH)."|";
        echo str_pad($this->force, 7," ",STR_PAD_BOTH);
        echo "|".str_pad($this->xp, 6," ",STR_PAD_BOTH)."|\n";
        echo str_pad("-", 23,"-",STR_PAD_BOTH)."\n";
    }
}