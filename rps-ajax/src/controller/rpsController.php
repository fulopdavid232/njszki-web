<?php
  // Controller
  // Vez�rl�, � ir�ny�tja, hogy a user t�rt�n�sei
  // (http k�r�sek) alapj�n mi t�rt�njen 
  
  // be�ll�tom, hogy egyszer� sz�veget adjon
  // vissza a php �s ne html-t
  header("Content-type: text/plain\n");

  // 1. felhaszn�lom a user inputjait, �s sz�ks�g eset�n valid�lom
  $userChoosed = $_GET['what'];
  
  // 2. haszn�lom a kapcsol�d� model oszt�lyt 
  // �s annak egy (vagy t�bb) objektum�t
  
  // 2a. include-dal hivatkozom a k�dra
  // ha _once, akkor csak egyszer hivatkozhat�
  include_once('../model/rpsModel.php');

  // 2b. l�trehozok egy model objektumot, �s haszn�lom
  $rps = new RPS($userChoosed);
  $results = $rps->getResults();

  // 3. include-dal megjelen�tem azt a view-t, amit vissza akarok k�ldeni
  // a felhaszn�l�nak  
  include('../view/rpsView.php');
?>
