<?php


class Soldat extends Ennemi
{
    public function __construct($pv, $force, $xp)
    {
        //$pv = rand();
        parent::__construct($pv, $force, $xp);
    }

    public function getStats()
    {
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
        parent::getStats();
    }

}