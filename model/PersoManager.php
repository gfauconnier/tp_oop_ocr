<?php

class PersoManager
{
    private $_db;

    // construct
    public function __construct($db)
    {
        $this->setDb($db);
    }

    //methods
    public function persoExists($val)
    {
        $selector = is_numeric($val) ? 'id' : 'nom';
        $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE '.$selector.' = :val');
        $query->execute(array('val'=>$val));
        $data = $query->fetch();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function getPerso($val)
    {
        $selector = is_numeric($val) ? 'id' : 'nom';
        if ($this->persoExists($val)) {
            $query = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE '.$selector.' = :val');
            $query->execute(array('val'=>$val));
            $data = $query->fetch();
            return new Personnage($data);
        }
        return false;
    }

    public function getAllPersos()
    {
      $persos = [];
      $query = $this->_db->query('SELECT id, nom, degats FROM personnages');
      $data = $query->fetchAll();
      foreach ($data as $value) {
        $persos[] = new Personnage($value);
      }
      return $persos;
    }

    public function addPerso($nom)
    {
        if (!$this->persoExists($nom)) {
            $query = $this->_db->prepare('INSERT INTO personnages(nom, degats) VALUES(:nom, 0)');
            $query->execute(array('nom'=>$nom));
            $perso = $this->getPerso($nom);
            return $perso->getNom().' créé.';
        }
        return false;
    }

    public function updatePerso(Personnage $perso)
    {
        $query = $this->_db->prepare('UPDATE personnages SET nom = :nom, degats = :degats WHERE id = :id');
        $query->execute(array('id'=>$perso->getId(),'nom'=>$perso->getNom(), 'degats'=>$perso->getDegats()));
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
