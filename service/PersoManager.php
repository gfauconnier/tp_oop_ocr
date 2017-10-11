<?php

class PersoManager {

  private $_db;

  // construct
  public function __construct($db)
  {
    $this->setDb($db);
  }

  //methods
  public function getPerso($id)
  {
    $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE id = :id');
    $query->execute(array('id'=>$id));
    $data = $query->fetch();
    return new Personnage($data);
  }

  public function addPerso(Personnage $perso)
  {
    $query = $this->_db->prepare('INSERT INTO personnages(nom, degats) VALUES(:nom, :degats)');
    $query->execute(array('nom'=>$perso->nom(), 'degats'=>$perso->degats()));
  }

  public function updatePerso(Personnage $perso)
  {
    $query = $this->_db->prepare('UPDATE personnages SET nom = :nom, degats = :degats WHERE id = :id');
    $query->execute(array('id'=>$perso->id(),'nom'=>$perso->nom(), 'degats'=>$perso->degats()));
  }

  public function deletePerso($id)
  {
    $query = $this->_db->prepare('DELETE FROM personnages WHERE id = ?');
    $query->execute(array($id));
  }

  //setters
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}


 ?>
