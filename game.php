<?php

require 'Personnage.php';
require 'Hero.php';
require 'Soldat.php';

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
    echo exec('clear');

    if ($action === '1' || $action === '2') {
        switch ($action) {
            case '1':
                $hero->attack($ennemi);
                $ennemi->getStats();
                //printf '|%4s|\n' a ab abc abcd abcde (align to right)
                if ($ennemi->isAlive()) {
                    $ennemi->attack($hero);
                } else {
                    winGame($hero);
                }
                if($hero->isAlive()) {
                    echo "\n";
                    $hero->getHerostats();
                    echo "\n";
                    cli_action($hero, $ennemi);
                } else {
                    gameOver();
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
                    gameOver();
                }
                break;
        }
    } else {
        echo "\n/!\\ Vous devez saisir 1 ou 2 ! /!\\\n\n";
        cli_action($hero, $ennemi);
    }
}

function initGame()
{
    $start = fopen("php://stdin", "r");
    echo exec('clear');
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
    echo exec('clear');
    echo "Tu es attaqué en duel, que le combat commence !\n";
    $ennemiPV = $hero->getLvl() > 3 ? rand($hero->getPV()*1, $hero->getPV()*1.75) : rand($hero->getPV()-2, $hero->getPV()+2);
    $ennemiForce = $hero->getLvl() > 3 ? rand($hero->getForce()*1, $hero->getForce()*1.75) : rand($hero->getForce()-2, $hero->getForce()+2);
    $ennemiXP = $hero->getLvl() > 3 ? rand($hero->getLvl()*1.25, $hero->getLvl()*1.75) : $hero->getLvl();
    $ennemi = new Soldat($ennemiPV, $ennemiForce, $ennemiXP);
    echo "\n";
    $ennemi->getStats();
    echo "\n";
    echo str_pad("", 50,"=",STR_PAD_BOTH)."\n";
    echo "\n";
    $hero->getHerostats();
    cli_action($hero, $ennemi);
}

function winGame($hero) {
    //lvlUp
    $hero->levelUp();
    $choiceInput = fopen("php://stdin", "r");
    echo "\n";
    echo "Bravo !!! Vous avez gagné ce combat !\n\n";
    echo "Voulez-vous continuer et passer au duel suivant ?\n1: Continuer\n2: Quitter\n-> ";
    $choice = trim(fgets($choiceInput));
    if ($choice === '1' || $choice === '2') {
        switch ($choice) {
            case '1':
                return startCombat($hero);
            case '2':
                echo exec('exit');
                exit();
        }
    } else {
        echo "\n/!\\ Vous devez saisir 1 ou 2 ! /!\\\n\n";
        winGame($hero);
    }

}

function gameOver()
{
    echo "\e[31m
  _____          __  __ ______    ______      ________ _____  
 / ____|   /\   |  \/  |  ____|  / __ \ \    / /  ____|  __ \ 
| |  __   /  \  | \  / | |__    | |  | \ \  / /| |__  | |__) |
| | |_ | / /\ \ | |\/| |  __|   | |  | |\ \/ / |  __| |  _  / 
| |__| |/ ____ \| |  | | |____  | |__| | \  /  | |____| | \ \ 
 \_____/_/    \_\_|  |_|______|  \____/   \/   |______|_|  \_\ \e[0m";
    echo exec('exit');
    exit();
}