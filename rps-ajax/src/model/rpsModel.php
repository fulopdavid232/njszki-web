<?php
  // model
  // minden logik�ja ide ker�l egy vagy t�bb oszt�lyba foglalva

  // RPS - rock-paper-scissor a k�-pap�r-oll�hoz tartoz� oszt�ly
  class RPS{
    var $options = Array('rock', 'paper', 'scissor');
    
    // a konstruktor param�tere a user v�laszt�sa
    function __construct($userText){
      // kikeresem, hogy melyiket v�lasztotta -> 0, 1, 2 (-1 ha nem tal�lja)
      $this->user = array_search($userText, $this->options);
      // magamnak sorsolok egyet
      $this->me = rand(0,2);
      
      $this->userText = $userText;
      $this->meText = $this->options[$this->me];
      // kisz�m�tom az eredm�nyt egy k�l�n f�ggv�nnyel
      $this->resultText = $this->computeResultText($this->user, $this->me);
    }
    
    // visszaad minden sz�ks�ges inform�ci�t
    function getResults(){
      return Array(
        'user'   => $this->userText,
        'me'     => $this->meText,
        'result' => $this->resultText
      );
    }
    
    // kisz�m�tja, hogy ki nyert
    private function computeResultText($user, $me){
      if($user == -1){
        return 'CHEATING';
      } elseif($user == $me){
        return 'DRAW';
      } elseif($user-1 == $me || $user+2 == $me){
        return 'WIN';
      } else {
        return 'LOSE';
      }
    }
  }

?>
