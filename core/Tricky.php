<?php
class Tricky {

  private $tablero;
  private $ui;
  private $ultimo;
  private $jugador1;
  private $jugador2;

  public function __construct(
      Tablero $tablero,
      JuegoUI $ui,
      InterfazJugador $jugador1,
      InterfazJugador $jugador2
  )
  {
      $this->tablero = $tablero;
      $this->ui = $ui;

      $jugador1->simbolo = 'x';
      $jugador2->simbolo = 'o';
      $jugador1->color = 'yellow';
      $jugador2->color = 'blue';

      $this->jugador1 = $jugador1;
      $this->jugador2 = $jugador2;
  }

  public function comenzar()
  {
      $estado = -1;
      $this->ui->dibujarTablero($this->tablero->getGrid());

      while ($estado === -1) {
          $jugador = $this->getjugador();

          $this->ui->notificarTurno(
              $jugador->nombre,
              $jugador->simbolo,
              $jugador->color,
              true
          );

          try {
              $estado = $jugador->moverFicha($this->tablero);
              $this->ultimo = $jugador;
          } catch (\GameException $e) {
              $this->ui->printException($e);
          }

          $this->ui->dibujarTablero($this->tablero->getGrid());
      }

      if ($estado === 0) {
          $this->ui->imprimirResultado('El juego empató');
      }

      if ($estado === 1) {
          $this->ui->imprimirResultado("{$this->ultimo->nombre} ganó!!!");
      }
  }

  private function getjugador():InterfazJugador
  {
      if ($this->tablero->movimiento === 0) {
          return ((rand(0, 1) === 0)
              ? $this->jugador1
              : $this->jugador2
          );
      }

      return (($this->ultimo === $this->jugador2)
          ? $this->jugador1
          : $this->jugador2
      );
  }
}
