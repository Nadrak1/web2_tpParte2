<?php
class gameModel{
    private $db;

function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=web2_tp;charset=utf8', 'root', '');//se conecta a la abse de datos (OJO CON dbname= poner el nombre de nuestra tabla)//
    }


    function getLimitAndOrderBY($sort,$order,$starAt,$endAt){
        $sentencia = $this->db->prepare("SELECT a.id,a.name,a.price,a.imagen, b.genre FROM videogame a INNER JOIN category b ON a.id_category_fk = b.id ORDER BY $sort $order LIMIT $starAt, $endAt"); 
        $sentencia->execute();
        $game = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $game;   
    }

    function orderBy($sort,$order){
        $sentencia = $this->db->prepare("SELECT a.id,a.name,a.price,a.imagen, b.genre FROM videogame a INNER JOIN category b ON a.id_category_fk = b.id ORDER BY $sort $order"); 
        $sentencia->execute();
        $game = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $game;   
    }

    public function getLimit($starAt,$endAt) {
        $query = $this->db->prepare("SELECT a.id,a.name,a.price,a.imagen, b.genre FROM videogame a INNER JOIN category b ON a.id_category_fk = b.id LIMIT $starAt, $endAt ");//selecciono toda la lista de la tabla clothes
        $query->execute();                  //envio la consulta        
        $clothes = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $clothes;  //reenvia el arreglo al controlador
    }

    function getGames(){
        $sentencia = $this->db->prepare("SELECT a.id,a.name,a.price,a.imagen, b.genre FROM videogame a INNER JOIN category b ON a.id_category_fk = b.id"); 
        $sentencia->execute();  
        $game = $sentencia->fetchAll(PDO::FETCH_OBJ);   
        return $game;
    }

    function insertGame($name,$price,$id_category_fk,$imagen = null){ 
        $pathImg = null;
        if($imagen){
            $pathImg = $this->uploadImage($imagen);
        }
        $sentencia = $this->db->prepare("INSERT INTO videogame(name,price,id_category_fk,imagen) VALUES(?,?,?,?)");    
        $sentencia->execute(array($name,$price,$id_category_fk,$pathImg));
    }

    private function uploadImage($imagen){
        $target = "imgs/" . uniqid() . ".jpg";
        move_uploaded_file($imagen, $target);
        return $target;
    }

    function deleteGameFromDB($id){
        $sentencia = $this->db->prepare("DELETE FROM videogame WHERE id=?");
        $sentencia->execute(array($id)); //tiene un solo parametro 
    }

    function updategameFromDB($name,$price,$id_category_fk,$imagen = null,$id){
        $pathImg = null;
        if($imagen){
            $pathImg = $this->uploadImage($imagen);
        }
        $sentencia = $this->db->prepare("UPDATE videogame SET name=?,price=?,id_category_fk=?,imagen=? WHERE id=?");
        $sentencia->execute(array($name,$price,$id_category_fk,$pathImg,$id)); 
    }


    function getGame($id){
        $sentencia = $this->db->prepare( "select * from videogame WHERE id=?"); 
        $sentencia->execute(array($id));  
        $game = $sentencia->fetch(PDO::FETCH_OBJ);   
        return $game ;
    }

    function gameSearch($palabra,$numero,$categoria){
        $sentencia = $this->db->prepare( "SELECT a.*, b.genre FROM videogame a INNER JOIN category b ON a.id_category_fk = b.id WHERE name LIKE ? OR price LIKE ? OR genre LIKE ? "); 
        $sentencia->execute(["%${palabra}%" , "%${numero}%" , "%${categoria}"]);  
        return $sentencia->fetchAll(PDO::FETCH_OBJ);  
    }
    

}