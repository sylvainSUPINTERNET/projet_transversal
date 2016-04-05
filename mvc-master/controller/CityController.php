<?php 

class CityController extends AbstractController{

  public function createAction(){
    if(!isset($_POST['city_name']))
      return json_encode(["error"=>"city_name missing"]);

    $city_name = strip_tags($_POST['city_name']);
    $city_name = htmlentities($city_name);
    $city_name = trim($city_name);

    $city_id = CityModel::create($this->pdo, $city_name);

    return json_encode(["message"=>"Créé !", 
                        "city_id"=>$city_id,
                        "city_name" => $city_name
                        ]);

  }
  public function showAction(){
    return json_encode(["error"=>"not implemented"]);
  }
  public function updateAction(){
    return json_encode(["error"=>"not implemented"]);
  }
  public function deleteAction(){
    if(!isset($_POST['city_id']))
      return json_encode(["error"=>"city_id missing"]);
    $city_id = $_POST['city_id'];

    CityModel::delete($this->pdo, $city_id);
    
    return json_encode(["message"=>"Supprimé !", "city_id"=>$city_id]);
  }
  
}