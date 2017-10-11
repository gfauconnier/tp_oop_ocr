<?php

class Personnage
{
  private $_nom;
  private $_degats;

  public function __construct() {
    $this->setDegats(0);
  }

  public function hydrate(array $donnees)
  {
    # code...
  }

  // setters
  public function setNom($nom)
  {
    if(is_string($nom) && strlen($nom) <= 30) {
      $this->_nom = $nom;
    }
  }

  public function setDegats($degats) {
    $degats = (int) $degats;
    if($degats >= 0 && $degats <= 100) {
      $this->_degats = $degats;
    }
  }

  //getters
  public function nom()
  {
    return $this->_nom;
  }

  public function degats()
  {
    return $this->_degats;
  }

}
