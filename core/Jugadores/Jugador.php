<?php
class Jugador implements InterfazJugador {

  public $nombre;
  public $simbolo;
  private $tablero;

  public function __construct(string $nombre)
  {
      $this->nombre = $nombre;
  }

  public function moverFicha(tablero $tablero)
  {
      $this->tablero = $tablero;

      $input = trim(fgets(STDIN));

      return $this->tablero->repintar($this->simbolo, $input);
  }

  
}
