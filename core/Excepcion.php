<?php
class Excepcion extends Exception
{

  public function __construct($mensaje, $codigo = 0, Exception $anterior = null)
  {
      parent::__construct($mensaje, $codigo, $anterior);
  }

  public function __toString()
  {
      return $this->message;
  }
}
