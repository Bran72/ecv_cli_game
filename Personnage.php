<?php


abstract class Personnage
{
    protected $pv;
    protected $force;
    protected $pvInitial; // variable pour conserver les pv à la création de l'instance

    public function __construct($pv, $force)
    {
        $this->pv = $pv;
        $this->pvInitial = $pv;
        $this->force = $force;
    }

    public function isAlive() {
        return $this->pv > 0;
    }

    public function attack(Personnage $personnage)
    {
        $personnage->pv = round($personnage->pv - $this->force, 2);
        if(is_a($personnage, Hero::class)) {
            echo "\n\e[31mOuch ! ".get_class($this)." vous attaque et vous retire \e[91m$this->force\e[31m points de vie !\e[0m\n\n";
        } else {
            echo "\n\e[32mTouché ! Vous retirez\e[92m $this->force\e[32m points de vie au ".get_class($personnage)." !\e[0m\n\n";
        };
    }

    public function setPv($pv)
    {
        $this->pv = $pv;
    }

    //abstract function specialAttack();
}