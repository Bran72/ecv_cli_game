<?php

require 'Personnage.php';
require 'Hero.php';
require 'Ennemi.php';
require 'Soldat.php';
require 'Chef.php';
require 'Boss.php';

// Ideal terminal size: 90x60

initGame();
$name = selectUser();
if($name === '') {
    do {
        $name = selectUserError();
    } while($name === '');
}

if(strtolower($name) === 'sonic')
    echo "\e[31mWaw, quelle originalité pour ce nom... Bref...\e[0m\n";

$hero = new Hero($name, 10, 3);

startGame($hero);
startCombat($hero);

echo "\n";

function cli_action($hero, $ennemi)
{
    // Open CLI to select what to do
    $selectAction = fopen("php://stdin", "r");
    echo "Que voulez-vous faire ?\n1: Attaquer\n2: Se soigner\n-> ";
    $action = trim(fgets($selectAction));
    shellDetectClear();

    if ($action === '1' || $action === '2') {
        switch ($action) {
            case '1':
                $hero->attack($ennemi);
                $ennemi->getStats();

                if ($ennemi->isAlive()) {
                    $ennemi->attack($hero);
                } else {
                    winGame($hero, $ennemi);
                }
                if($hero->isAlive()) {
                    echo "\n";
                    $hero->getHerostats();
                    echo "\n";
                    cli_action($hero, $ennemi);
                } else {
                    gameOver($hero);
                }
                break;
            case '2':
                $hero->seSoigner();
                $ennemi->getStats();
                $ennemi->attack($hero);
                if($hero->isAlive()) {
                    echo "\n";
                    $hero->getHerostats();
                    echo "\n";
                    cli_action($hero, $ennemi);
                } else {
                    gameOver($hero);
                }
                break;
        }
    } else {
        echo "\n\e[31m/!\\ Vous devez saisir 1 ou 2 ! /!\\\e[0m\n\n";
        cli_action($hero, $ennemi);
    }
}

function initGame()
{
    shellDetectClear();
    $start = fopen("php://stdin", "r");
    shellDetectClear();
    echo "Bienvenue cher voyageur !\n
Nous sommes heureux de te compter parmit les joueurs de ECVFight. Dans ce tournois,
tu devras donner le meilleur de toi-même afin de triompher de tous les ennemis qui se
dresserons sur ta route !\n
Alors, prêt à relever le défi ? \n\e[32m
   ____________________
 /                      \
|       COMMENCER        |
 \ ____________________ /\n\e[0m";
    return trim(fgets($start));
}

function selectUser()
{
    $nameInput = fopen("php://stdin", "r");
    echo '       ___------__
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
        // \\\\--\|   -Han J. Lee-
   ____//  ||_
  /_____\ /___\
______________________'."\n\n";
    echo "Alors commençons !\nVoici ton personnage. \nTout d'abord, quel est son nom ? \n-> ";
    return trim(fgets($nameInput));
}

function selectUserError()
{
    $nameInput = fopen("php://stdin", "r");
    echo "Donne un nom à ton joueur voyons ! Tu peux même mettre Sonic, on ne t'en voudras pas...\n-> ";
    return trim(fgets($nameInput));
}

function startGame($hero)
{
    $startGame = fopen("php://stdin", "r");
    echo "\n";
    echo "Bienvenue dans l'aventure ".$hero->getName()." !\nSache qu'à tout moment, tu peux quitter le jeu en pressant
les touches CTRL+C.\n\n\e[33mRetrouve ci-dessous les stats de ton joueur:\e[0m\n";
    echo $hero->getHeroStats();
    echo "Appuie sur la touche 'Entrée' quand tu seras prêt à débuter ton premier combat !\n";
    return fgets($startGame);
}

function startCombat($hero)
{
    shellDetectClear();
    echo "Tu es attaqué en duel, que le combat commence !\n";
    $ennemiPV = $hero->getLvl() > 3 ? rand($hero->getPV()*1.25, $hero->getPV()*1.5) : rand($hero->getPV()-2, $hero->getPV()+2);
    $ennemiForce = $hero->getLvl() > 3 ? rand($hero->getForce()*0.5, $hero->getForce()*1.25) : rand($hero->getForce()-2, $hero->getForce()+2);
    $ennemiXP = $hero->getLvl() > 3 ? rand($hero->getLvl()*1.25, $hero->getLvl()*1.75) : $hero->getLvl();

    // + condition soldat / chef / boss
    $counterEnnemi = $hero->getEnnemiCounter();
    $rand = rand(0, 100);
    if($counterEnnemi['soldat'] >= 8) {
        if ($rand < 40) {
            $ennemi = new Chef($ennemiPV, $ennemiForce, $ennemiXP);
        } else {
            $ennemi = new Soldat($ennemiPV, $ennemiForce, $ennemiXP);
        }
    } elseif ($counterEnnemi['soldat'] >= 8 && $counterEnnemi['chef'] >= 3) {
        if ($rand < 20)
            $ennemi = new Boss($ennemiPV, $ennemiForce, $ennemiXP);
        elseif ($rand > 20 && $rand < 50 )
            $ennemi = new Chef($ennemiPV, $ennemiForce, $ennemiXP);
        else
            $ennemi = new Soldat($ennemiPV, $ennemiForce, $ennemiXP);
    } else {
        $ennemi = new Soldat($ennemiPV, $ennemiForce, $ennemiXP);
    }

    echo "\n";
    $ennemi->getStats();
    echo "\n";
    echo str_pad("", 50,"=",STR_PAD_BOTH)."\n";
    echo "\n";
    $hero->getHeroStats();
    cli_action($hero, $ennemi);
}

function winGame($hero, $ennemi) {
    $hero->levelUp(get_class($ennemi));
    $hero->incrementVictory();
    $choiceInput = fopen("php://stdin", "r");
    echo "\n";
    echo "Bravo !!! Vous avez gagné ce combat !\n\n";
    echo "Voulez-vous continuer et passer au duel suivant ?\n1: Continuer\n2: Quitter\n-> ";
    $choice = trim(fgets($choiceInput));
    if ($choice === '1' || $choice === '2') {
        switch ($choice) {
            case '1':
                startCombat($hero);
                break;
            case '2':
                leaveGame($hero);
                break;
        }
    } else {
        winGameError($hero);
    }
}

function winGameError($hero) {
    echo "\n\e[31m/!\\ Vous devez saisir 1 ou 2 ! /!\\\e[0m\n\n";
    $choiceInput = fopen("php://stdin", "r");
    echo "Voulez-vous continuer et passer au duel suivant ?\n1: Continuer\n2: Quitter\n-> ";
    $choice = trim(fgets($choiceInput));
    if ($choice === '1' || $choice === '2') {
        switch ($choice) {
            case '1':
                startCombat($hero);
                break;
            case '2':
                leaveGame($hero);
                break;
        }
    } else {
        winGameError($hero);
    }
}

function gameOver($hero)
{
    $choiceInput = fopen("php://stdin", "r");
    $hero->incrementDefeat();
    echo $hero->getHeroStats();
    echo "\e[31m
  _____          __  __ ______    ______      ________ _____  
 / ____|   /\   |  \/  |  ____|  / __ \ \    / /  ____|  __ \ 
| |  __   /  \  | \  / | |__    | |  | \ \  / /| |__  | |__) |
| | |_ | / /\ \ | |\/| |  __|   | |  | |\ \/ / |  __| |  _  / 
| |__| |/ ____ \| |  | | |____  | |__| | \  /  | |____| | \ \ 
 \_____/_/    \_\_|  |_|______|  \____/   \/   |______|_|  \_\ \e[0m\n\n";

    echo "Voulez-vous recommencer ?\n1: Recommencer\n2: Quitter\n-> ";
    $choice = trim(fgets($choiceInput));
    if ($choice === '1' || $choice === '2') {
        switch ($choice) {
            case '1':
                $hero->seSoigner();
                return startCombat($hero);
            case '2':
                leaveGame($hero);
        }
    }
}

function gameOverError()
{
    $nameInput = fopen("php://stdin", "r");
    echo "\n\e[31m/!\\ Vous devez saisir 1 ou 2 ! /!\\\e[0m\n\n";
    echo "Voulez-vous recommencer ?\n1: Recommencer\n2: Quitter\n-> ";
    return trim(fgets($nameInput));
}

function leaveGame($hero) {
    // TODO: stats du joueur, avec ses victoires / défaites, pourcentages,... (?)
    shellDetectClear();

    echo "\nAu-revoir ".$hero->getName()." !\nOn espère te revoir bientôt ;-)\n\n";
    echo str_pad('Statistiques', 28,"-",STR_PAD_BOTH)."\n";
    echo "|  \e[32mVictoires\e[0m  |  \e[31mDéfaites\e[0m  |\n";
    echo "|".str_pad($hero->getVictories(),13, " ",STR_PAD_BOTH)."|";
    echo str_pad($hero->getDefeats(), 12," ",STR_PAD_BOTH)."|\n";
    echo str_pad("-", 28,"-",STR_PAD_BOTH)."\n\n\n";

    echo exec('exit');
    exit();
}

function shellDetectClear(){
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        echo exec('cls');
    } else {
        echo exec('clear');
    }
}