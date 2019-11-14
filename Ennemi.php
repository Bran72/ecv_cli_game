<?php


class Ennemi extends Personnage {
    private $xp;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force);
        $this->xp = $xp;
    }

    public function getStats() {
echo "               /\_[]_/\
              |] _||_ [|
       ___     \/ || \/
      /___\       ||
     (|0 0|)      ||
   __/{\U/}\_ ___/vvv
  / \  {~}   / _|_P|
  | /\  ~   /_/   []
  |_| (____)        
  \_]/______\        
     _\_||_/_           
    (_,_||_,_)\n\n";
        echo "----  ENNEMI  ----\n";
        echo "------------------\n";
        echo "| PV | FORCE | XP |\n";
        echo "| $this->pv  |  $this->force  | $this->xp |\n";
        echo "___________________\n";
    }
}