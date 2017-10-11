<?php

class Personnage
{
  private $_id;
  private $_nom;
  private $_degats;

  

  public function __construct() {
    $this->setDegats(0);
  }

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value) {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }

  // setters
  public function setId($id)
  {
    $id = (int) $id;
    if ($id > 0) {
      $this->_id = $id;
    }
  }

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
  public function id()
  {
    return $this->_id;
  }
  public function nom()
  {
    return $this->_nom;
  }
  public function degats()
  {
    return $this->_degats;
  }

}
