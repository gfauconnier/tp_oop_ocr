<?php

class Personnage
{
    private $_id;
    private $_nom;
    private $_degats;

    const PERSO_SELFATK = 1;
    const PERSO_MORT = 2;
    const PERSO_ATK = 3;

    // constructor
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // hydrates the object
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
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
        if (is_string($nom) && strlen($nom) <= 30) {
            $this->_nom = $nom;
        }
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    //getters

    public function __get($value)
    {
      $value = '_'.$value;
        if (isset($this->$value)) {
            return $this->$value;
        }
    }

    //methods

    // takes a Personnage as parameter and calls takeDamage of it
    public function frapperPerso(Personnage $perso)
    {
        if ($perso->__get('nom') != $this->__get('nom')) {
            return $perso->takeDamage();
        } else {
            return self::PERSO_SELFATK;
        }
    }

    // adds degats to this object
    public function takeDamage()
    {
        $this->_degats += 50;
        if ($this->_degats < 100) {
            return self::PERSO_ATK;
        } else {
            return self::PERSO_MORT;
        }
    }
}
