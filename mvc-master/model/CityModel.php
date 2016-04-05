<?php

class CityModel{

  public static function getList($pdo){
    $res = $pdo->query("SELECT * FROM destinations");
    $destinations = [];
    foreach ($res as $row) {
      $destinations[] = $row;
    }
    return $destinations;
  }

  public static function delete($pdo, $city_id){
    $q = $pdo->prepare('DELETE FROM destinations WHERE id = :city_id');
    $q->bindParam('city_id',$city_id);
    $reussi = $q->execute();
    return $reussi;
  }

  public static function create($pdo, $city_name){
    $q = $pdo->prepare('INSERT INTO destinations 
                          SET name = :city_name');
    $q->bindParam('city_name',$city_name);
    $q->execute();
    $city_id = $pdo->lastInsertId();
    return $city_id;
  }
  
}