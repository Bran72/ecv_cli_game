<?php


class Boss extends Ennemi
{
    private $boostForce;
    private $boostDefense;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force, $xp);
        $this->boostForce = .25;
        $this->boostDefense = .25;
        $this->pv = $this->pv * $this->boostDefense;
        $this->force = $this->force * $this->boostForce;
    }

    public function getStats() {
        echo "
             __                  __
            ( _)                ( _)
           / / \\\\              / /\_\_
          / /   \\\\            / / | \ \
         / /     \\\\          / /  |\ \ \\
        /  /   ,  \ ,       / /   /|  \ \\
       /  /    |\_ /|      / /   / \   \_\
      /  /  |\/ _ '_| \   / /   /   \    \\\\
     |  /   |/  0 \\0\    / |    |    \    \\\\
     |    |\|      \_\_ /  /    |     \    \\\\
     |  | |/    \.\ o\o)  /      \     |    \\\\
     \    |     /\\\\`v-v  /        |    |     \\\\
      | \/    /_| \\\\_|  /         |    | \    \\\\
      | |    /__/_ `-` /   _____  |    |  \    \\\\
      \|    [__]  \_/  |_________  \   |   \    ()
       /    [___] (    \         \  |\ |   |   //
      |    [___]                  |\| \|   /  |/
     /|    [____]                  \  |/\ / / ||
snd (  \   [____ /     ) _\      \  \    \| | ||
     \  \  [_____|    / /     __/    \   / / //
     |   \ [_____/   / /        \    |   \/ //
     |   /  '----|   /=\____   _/    |   / //
  __ /  /        |  /   ___/  _/\    \  | ||
 (/-(/-\)       /   \  (/\/\)/  |    /  | /
               (/\/\)           /   /   //
                      _________/   /    /
                     \____________/    (\n\n";

        parent::getStats();
    }
}