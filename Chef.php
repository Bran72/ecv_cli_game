<?php


class Chef extends Ennemi
{
    private $boostDefense;
    protected $chefDesign;

    public function __construct($pv, $force, $xp)
    {
        parent::__construct($pv, $force, $xp);
        $this->boostDefense = .25;
        $this->pv = $this->pv + ($this->pv * $this->boostDefense);

        $design1 = "
                       .-.
                      |_:_|
                     /(_Y_)\
.                   ( \/M\/ )
 '.               _.'-/'-'\-'._
   ':           _/.--'[[[[]'--.\_
     ':        /_'  : |::\"| :  '.\\
       ':     //   ./ |oUU| \.'  :\
         ':  _:'..' \_|___|_/ :   :|
           ':.  .'  |_[___]_|  :.':\
            [::\ |  :  | |  :   ; : \
             '-'   \/'.| |.' \  .;.' |
             |\_    \  '-'   :       |
             |  \    \ .:    :   |   |
             |   \    | '.   :    \  |
             /       \   :. .;       |
            /     |   |  :__/     :  \\
           |  |   |    \:   | \   |   ||
          /    \  : :  |:   /  |__|   /|
          |     : : :_/_|  /'._\  '--|_\
          /___.-/_|-'   \  \
                         '-'\n\n";

        $design2 = "
              .-\"'\"-.
             |       |  
           (`-._____.-')
        ..  `-._____.-'  ..
      .', :./'.== ==.`\.: ,`.
     : (  :   ___ ___   :  ) ;
     '._.:    |0| |0|    :._.'
        /     `-'_`-'     \\
      _.|       / \       |._
    .'.-|      (   )      |-.`.
   //'  |  .-\"`\"`-'\"`\"-.  |  `\\\ 
  ||    |  `~\":-...-:\"~`  |    ||
  ||     \.    `---'    ./     ||
  ||       '-._     _.-'       ||
 /  \       _/ `~:~` \_       /  \
||||\)   .-'    / \    `-.   (/||||
\|||    (`.___.')-(`.___.')    |||/
 '\"'     `-----'   `-----'     '\"'\n\n";
        $chefDesigns = [$design1, $design2];
        $design = $chefDesigns[array_rand($chefDesigns, 1)];
        $this->chefDesign = $design;
    }

    public function getStats()
    {
        echo $this->chefDesign;
        parent::getStats();
    }
}