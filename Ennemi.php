<?php


class Ennemi extends Personnage {
    private $xp;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force);
        $this->xp = $xp;
    }

    public function getStats() {
        $pvRatio = round(($this->pv/$this->pvInitial)*22); // pour remettre les pv sur 22 (taille de la barre de vie)
        $pv = str_repeat("=", $pvRatio > 0 ? $pvRatio : 0);
        echo str_pad(get_class($this), 23,"-",STR_PAD_BOTH)."\n";
        echo "|‎\e[31m".str_pad($pv, 21, " ",STR_PAD_RIGHT)."‎\e[0m|\n";
        echo str_pad("_", 23,"_",STR_PAD_BOTH)."\n";
        echo "|  PV  | FORCE |  XP  |\n";
        echo "|".str_pad($this->pv > 0 ? $this->pv : 0, 6," ",STR_PAD_BOTH)."|";
        echo str_pad($this->force, 7," ",STR_PAD_BOTH);
        echo "|".str_pad($this->xp, 6," ",STR_PAD_BOTH)."|\n";
        echo str_pad("-", 23,"-",STR_PAD_BOTH)."\n";
    }
}