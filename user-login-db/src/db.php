<?php
  class DB{
    
    // l�trehoz egy �j adatb�ziskapcsolatot a db.config.php param�terei alapj�n
    // kapcsol�dik a megfelel� adatb�zishoz �s be�ll�tja, hogy utf-8 k�dol�st haszn�ljon
    
	  function __construct(){
      include('db.config.php');
    
      $this->conn = mysql_connect($host, $user, $pass);
      $this->isError($this->conn);
      $db = mysql_select_db($database);
      $this->isError($db);
      $res = mysql_query("SET names utf8;");
      $this->isError($res);
    }
    
    // elv�gez egy lek�r�st �s visszaadja az adatokat t�mb�s t�mbben
    
    function query($queryString){
      $res = $this->doQuery($queryString);
      
      $ret = Array();
      while($record = mysql_fetch_assoc($res)){
        $ret[] = $record;
      }      
      return $ret;
    }
    
    // elv�gez egy lek�r�st �s csak a visszaadott sorok sz�m�t adja vissza
    
    function count($queryString){
      $res = $this->doQuery($queryString);      
      return mysql_num_rows($res);
    }
    
    private function doQuery($queryString){
      $this->isError($this->conn);
      $res = mysql_query($queryString, $this->conn);
      $this->isError($res);
      
      return $res;
    }
    
    // lez�rja az adatb�ziskapcsolatot
    
    function close(){
      return mysql_close($this->conn);
    }
    
    // hiba kezel�s, tetsz�leges v�ltoz� igazs�g�rt�k�t vizsg�lja
    // ha hamis, null, stb... akkor hiba t�rt�nt �s lek�ri a mysql.t�l
    // az utols� hib�t �s dob egy kiv�telt vele
    
    function isError($p){
      if(!$p){
        throw new Exception('Mysql exception: '.mysql_error());
      }
    }
    
    // statikus met�dusok, p�ld�nyos�t�s n�lk�l m�k�dnek
    // akkor haszn�ld, ha csak egyszem sql-t akarsz �rni az eg�sz f�jlban
    
    // csak megsz�molja egy lek�r�s sorait
    
    static function justCount($queryString){
      return DB::justSomething("count", $queryString);
    }
  
    // csak elv�gez egy lek�r�st �s t�mb�s t�mbben visszaadja az eredm�nyt
  
    static function justQuery($queryString){
      return DB::justSomething("query", $queryString);
    }
    
    private static function justSomething($what, $queryString){
      $db = new DB();
      $ret = $db->$what($queryString);
      $db->close();
      return $ret;
    }
  }
?>
