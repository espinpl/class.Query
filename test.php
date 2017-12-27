<?php

// test INSERT 

require_once 'connect.php'; // dołączamy połączenie z bazą
require_once 'class.Query.php'; // dołączamy klasę
 
// tworzymy nowy obiekt klasy podając w nawiasie nazwę tabeli
$insert = new Query("users"); 
 
// ustawiamy nazwy pól tabeli i wartości do zapisu
$insert->setField("login","Tester"); 
$insert->setField("password",sha1(md5("hasło")));
$insert->setField("firstname","John");
$insert->setField("lastname","Doe");
 
$insert->Insert(); // wykonujemy instrukcje