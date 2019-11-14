<?php

require 'Personnage.php';
require 'Hero.php';
require 'Soldat.php';

$hero = new Hero("James", 10, 8, 4);
$ennemi = new Soldat(16, 2, 8);

$hero->sayHello();
echo "\n";
cli_action($hero, $ennemi);

echo "\n";

function cli_action($hero, $ennemi)
{
    //CLI: 1 = attaquer, 2 = se soigner
    $handleFirstGlad = fopen ("php://stdin","r");
    echo "Que voulez-vous faire ?\n1: Attaquer\n2: Se soigner\n-> ";
    $result = trim(fgets($handleFirstGlad));
    if ($result === '1' || $result === '2') {
        switch ($result) {
            case '1':
                $hero->attack($ennemi);
                $ennemi->getStats();
                if($ennemi->isAlive()) {
                    $ennemi->attack($hero);
                    echo "\n";
                    echo "Ennemi vous attaque !\n";
                    echo "\n";
                    $hero->sayHello();
                    echo "\n";
                    cli_action($hero, $ennemi);
                } else{
                    //toto
                    echo "You win !";
                }
                break;
            case '2':
                echo "Tu te soignes Jaquie !";
                break;
        }
    }
    else {
        echo "\n/!\\ Vous devez saisir 1 ou 2 ! /!\\\n\n";
        cli_action($hero, $ennemi);
    }
}




/*
 * //
 * //
 * //
 * 1:
 * 2:
 * _
 *
 * */

//$gladiateur->fightPersonnage($mage);

/*
$arrayGladiateurs = [
    "Sparta" => [
        "lvl" => 12,
        "pv" => 10,
        "attack" => 2
    ],
    "Kratos" => [
        "lvl" => 15,
        "pv" => 15,
        "attack" => 3
    ],
    "Hades" => [
        "lvl" => 50,
        "pv" => 300,
        "attack" => 1
    ]
];

$handleFirstGlad = fopen ("php://stdin","r");
echo "Choisir le premier gladiateur par son nom (ou créez-en un nouveau): ";
$idFirstUser = trim(fgets($handleFirstGlad));

if(!isset($arrayGladiateurs[$idFirstUser])) {
    $arrayGladiateurs = newGladiator($idFirstUser);
}

$handleSecondGlad = fopen ("php://stdin","r");
echo "Choisir le deuxième gladiateur par son nom (ou créez-en un nouveau): ";
$idSecondUser = trim(fgets($handleSecondGlad));

if(!isset($arrayGladiateurs[$idSecondUser])) {
    $arrayGladiateurs = newGladiator($idSecondUser);
}

function newGladiator($name){
    global $arrayGladiateurs;

    $handleFirstGlad = fopen ("php://stdin","r");
    echo "Quel est le niveau de votre personnage ? ";
    $lvlUser = trim(fgets($handleFirstGlad));

    $handleFirstGlad = fopen ("php://stdin","r");
    echo "Quelle est l'attaque niveau de votre personnage ? ";
    $attUser = trim(fgets($handleFirstGlad));

    $handleFirstGlad = fopen ("php://stdin","r");
    echo "Quels sont les pv de votre personnage ? ";
    $pvUser = trim(fgets($handleFirstGlad));

    $newGladiator = [
        $name => [
            "lvl" => (int) $lvlUser,
            "pv" => (int) $pvUser,
            "attack" => (int) $attUser
        ]
    ];

    return array_merge($arrayGladiateurs, $newGladiator);
}

fight($idFirstUser, $idSecondUser);

function fight($player1, $player2) {
    global $arrayGladiateurs;
    while (true) {
        $arrayUsers = [$player1, $player2];

        $first_key = array_rand($arrayUsers);
        $first = $arrayUsers[$first_key];
        unset($arrayUsers[$first_key]);

        $second_key = array_rand($arrayUsers);
        $second = $arrayUsers[$second_key];

        $pv1 = $arrayGladiateurs[$first]['pv'];
        $pv2 = $arrayGladiateurs[$second]['pv'];
        $attack1 = $arrayGladiateurs[$first]['attack'];

        $fight = $pv2 - $attack1;
        $arrayGladiateurs[$second]['pv'] = $fight;

        if($pv1 <= 0){
            echo $second.' est gagnant avec '.$arrayGladiateurs[$second]['pv'].' !';
            break;
        } else if($pv2 <= 0) {
            echo $first.' est gagnant avec '.$arrayGladiateurs[$first]['pv'].' !';
            break;
        }
    }
}*/









