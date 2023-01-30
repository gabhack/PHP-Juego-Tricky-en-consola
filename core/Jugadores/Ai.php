<?php
class Ai implements InterfazJugador {

  public $nombre = 'Pepito';
  public $simbolo;
  private $oponente;
  private $tablero;

  public function moverFicha(Tablero $tablero):int
  {
      $this->tablero = $tablero;
      $this->oponente = $this->simbolo === 'o' ? 'x' : 'o';
      $input = $this->getBestMove();
      return $this->tablero->repintar($this->simbolo, $input);
  }

  public function isHuman():bool
  {
      return false;
  }

  private function getBestMove():string
  {
      $bestMove = [];
      $bestValue = -1000;
      $grid = $this->tablero->getGrid();
      $movimiento = $this->tablero->movimiento;

      for ($i=0; $i < 3; $i++) {
          for ($j=0; $j < 3; $j++) {
              if ($grid[$i][$j] === '_') {
                  $grid[$i][$j] = $this->simbolo;
                  $value = $this->miniMax($grid, $movimiento + 1, false);

                  $grid[$i][$j] = '_';

                  if ($value > $bestValue) {
                      $bestMove = [$i+1, $j+1];
                      $bestValue = $value;
                  }
              }
          }
      }
      return $bestMove[0] . $bestMove[1];
  }

  private function miniMax(array $grid, int $movimiento, bool $isMax):int
  {
      $puntuacion = $this->evaluar($grid, $movimiento);

      if ($puntuacion !== 1) {
          return $puntuacion;
      }

      if ($isMax) {
          $best = -1000;
          for ($i=0; $i < 3; $i++) {
              for ($j=0; $j < 3; $j++) {
                  if ($grid[$i][$j] === '_') {
                      $grid[$i][$j] = $this->simbolo;
                      $best = max($best, $this->miniMax($grid, $movimiento + 1, !$isMax));
                      $grid[$i][$j] = '_';
                  }
              }
          }
          return $best - $movimiento;
      } else {
          $best = 1000;
          for ($i=0; $i < 3; $i++) {
              for ($j=0; $j < 3; $j++) {
                  if ($grid[$i][$j] === '_') {
                      $grid[$i][$j] = $this->oponente;
                      $best = min($best, $this->miniMax($grid, $movimiento + 1, !$isMax));
                      $grid[$i][$j] = '_';
                  }
              }
          }

          return $best + $movimiento;
      }
  }

  private function evaluar(array $grid, int $movimiento):int
  {
      $puntuacion = [
        $this->simbolo => 10,
        $this->oponente => -10
      ];

      if ($grid[0][0] !== '_') {
          if ($grid[0][0] === $grid[0][1] && $grid[0][1] === $grid[0][2]) {
              return $puntuacion[ $grid[0][0] ];
          }

          if ($grid[0][0] === $grid[1][0] && $grid[1][0] === $grid[2][0]) {
              return  $puntuacion[ $grid[0][0] ];
          }
          if ($grid[0][0] === $grid[1][1] && $grid[1][1] === $grid[2][2]) {
              return $puntuacion[ $grid[0][0] ];
          }
      }

      if ($grid[1][1] !== '_') {
          if ($grid[1][0] === $grid[1][1] && $grid[1][1] === $grid[1][2]) {
              return $puntuacion[ $grid[1][1] ];
          }

          if ($grid[0][1] === $grid[1][1] && $grid[1][1] === $grid[2][1]) {
              return $puntuacion[ $grid[1][1] ];
          }

          if ($grid[0][2] === $grid[1][1] && $grid[1][1] === $grid[2][0]) {
              return $puntuacion[ $grid[1][1] ];
          }
      }

      if ($grid[2][2] !== '_') {
          if ($grid[2][0] === $grid[2][1] && $grid[2][1] === $grid[2][2]) {
              return $puntuacion[ $grid[2][2] ];
          }

          if ($grid[0][2] === $grid[1][2] && $grid[1][2] === $grid[2][2]) {
              return $puntuacion[ $grid[2][2] ];
          }
      }

      if ($movimiento === 9) {
          return 0;
      }

      return 1;
  }
}
