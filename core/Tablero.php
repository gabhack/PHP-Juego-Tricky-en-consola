<?php
class Tablero {

  public $movimiento = 0;
  private $grid;

  public function __construct()
  {
      $this->grid = [
        ['_','_','_'], ['_','_','_'], ['_','_','_']
      ];
  }

  public function getGrid():array
  {
      return $this->grid;
  }

  public function repintar($simbolo, $input):int
  {
      if (! ctype_digit($input) || strlen($input) !== 2) {
          throw new Excepcion('La jugada debe incluir solo 2 digitos, sin espacios');
      }

      list($x, $y) = str_split($input);

      $x -= 1; 
      $y -= 1;

      if (! isset($this->grid[$x][$y])) {
          throw new Excepcion('No es valida');
      }

      if ($this->grid[$x][$y] !== '_') {
          throw new Excepcion('Ya jugaron ahí');
      }

      $this->grid[$x][$y] = $simbolo;
      $this->movimiento += 1;
      return $this->evaluar($this->grid);
  }

  private function evaluar($grid):int
  {
    //evaluo si ganó en cada caso segun la ficha central
      if ($grid[0][0] !== '_') {
                  
          if ($grid[0][0] === $grid[0][1] && $grid[0][1] === $grid[0][2]) {
              return 1;
          }

          if ($grid[0][0] === $grid[1][0] && $grid[1][0] === $grid[2][0]) {
              return 1;
          }

          if ($grid[0][0] === $grid[1][1] && $grid[1][1] === $grid[2][2]) {
              return 1;
          }
      }

      if ($grid[1][1] !== '_') {
          if ($grid[1][0] === $grid[1][1] && $grid[1][1] === $grid[1][2]) {
              return 1;
          }

          if ($grid[0][1] === $grid[1][1] && $grid[1][1] === $grid[2][1]) {
              return 1;
          }

          if ($grid[0][2] === $grid[1][1] && $grid[1][1] === $grid[2][0]) {
              return 1;
          }
      }

      if ($grid[2][2] !== '_') {
 
          if ($grid[2][0] === $grid[2][1] && $grid[2][1] === $grid[2][2]) {
              return 1;
          }

          if ($grid[0][2] === $grid[1][2] && $grid[1][2] === $grid[2][2]) {
              return 1;
          }
      }

      if ($this->movimiento === 9) {
          return 0;
      }

      return -1;
  }
}
