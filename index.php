<?php
require 'core/Excepcion.php';
require 'core/JuegoUI.php';
require 'core/Tablero.php';
require 'core/Tricky.php';
require 'core/Jugadores/InterfazJugador.php';
require 'core/Jugadores/Jugador.php';

echo <<<Titulo
*******************************************
*     Tricky Vs Jeremy               *
*******************************************\n
Titulo;

// Asignar el primer jugador
print("Digite nombre del jugador \n");
$jugador1nombre = trim(fgets(fopen('php://stdin', 'r')));
$jugador1nombre = (empty($jugador1nombre)
    ? 'Jugador 1'
    : $jugador1nombre
);

$jugador1 = new Jugador($jugador1nombre);


    require 'core/Jugadores/Ai.php';
    $jugador2 = new Ai();





// empieza el juego
$tablero = new Tablero();
$ui = new JuegoUI();
$juego = new Tricky($tablero, $ui, $jugador1, $jugador2);

$juego->comenzar();
