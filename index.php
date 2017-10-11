<?php
require 'model/data.php';
require 'service/functions.php';

if (isset($_POST['Creer']) && isset($_POST['nom']) && !empty($_POST['nom'])) {
  $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);

  $perso = new Personnage(['id'=>1, 'nom'=>$nom, 'degats'=>0]);

  echo $manager->addPerso($perso);

} elseif (isset($_POST['Utiliser'])) {
  $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
  $perso = $manager->getPerso($nom);
  if ($perso){
    echo $perso->nom().' a déjà subi '.$perso->degats().' dégats.';
  }else {
    echo 'Le personnage n\'existe pas';
  }
}

include 'view/indexv.php';
