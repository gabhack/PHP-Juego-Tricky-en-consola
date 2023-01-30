<?php
class JuegoUI
{

  public function dibujarTablero(array $grid)
  {
      $output = "\n       1 2 3\n";
      $i = 1;

      foreach ($grid as $line) {
          $output .= "     $i " . implode( '|', $line) . "\n";
          $i++;
      }
      print($output);
  }

  public function notificarTurno($nombre, $simbolo, $color, bool $humano)
  {
      $this->imprimir("\n{$nombre} ({$simbolo}) Esta jugando.", $color);

      if ($humano) {
          print("Digite su jugada ");
      }
  }

  public function imprimirResultado($string)
  {
      $string = "--------------------------\n-     $string    -\n"
          . "--------------------------";

      $this->imprimir($string, 'green');
  }



  private function imprimir($string, $color)
  {
      $colors = [
        'red'     => '31',
        'yellow'  => '33',
        'green'   => '32',
        'blue'    => '36'
      ];

      print("\033[1;{$colors[$color]}m{$string}\033[0m\n");
  }
}
