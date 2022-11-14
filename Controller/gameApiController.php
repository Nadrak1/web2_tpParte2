<?php
require_once "./View/ApiView.php";
require_once "Model/gameModel.php";


class gameApiController {
    private $model;
    private $view;
    public function __construct() {
        $this->model = new gameModel();
        $this->view = new Apiview();
    }


    function showAllGames($params = null){ 
        
        /*  ==================================================================
                                        EL ORDER BY
            ===================================================================== */

        if(!empty($_GET["sort"]) && !empty($_GET["order"])){
            $sort = $_GET["sort"];
            $order = $_GET["order"];
            if($order == "DESC" || $order == "desc" || $order == "ASC" ||  $order == "asc" ){
                $game = $this->model->orderBy($sort,$order);
            }else{
                $this->view->response("es invalido el parametro",400);
            }
        }
        
        /*  ==================================================================
                                        PAGINADOR
            ===================================================================== */

        else if (!empty ($_GET ['starAt'] ) && !empty ($_GET ['endAt'])){
            $starAt = $_GET ['starAt'];
            $endAt= $_GET['endAt'];

                //traigo el array de los nombres de las columnas de las tablas
            $game =  $this->model->getLimit($starAt,$endAt);
            
        }

        /*  ==================================================================
                                        TRAER TODO
            ===================================================================== */
        else{
            $game = $this->model->getGames();
        }
        if($game)
            return $this->view->response($game, 200);  
        else{
            return $this->view->response("No se pudo encontrar", 404); 
        }
    }

    function getGame($params = null){ //referenciar al id
        $idGame = $params[':ID']; 
        $game = $this->model->getGame($idGame);
        if($game){
            return $this->view->response($game, 200); //la nueva vista 
        }else{
            return $this->view->response("Fallo,no se pudo traer el juego", 404);
        }
    }

    function deleteGame($params = null){
        $idGame = $params[':ID'];
        if(!empty($idGame)){
            $game = $this->model->deleteGameFromDB($idGame);
            return $this->view->response("Fue borrado el juego $game", 200); //la nueva vista 
        }else{
            return $this->view->response("No se pudo borrar el juego (no se encontr el id)", 500); //la nueva vista 
        }
    }

    function createGame($params = null){
        $body = $this->getBody();

        $name = $body->name;
        $price = $body->price;
        $id_category_fk = $body->id_category_fk;
        $imagen = $body->imagen;

        var_dump($name,$price,$id_category_fk);
        if(!empty($name) && !empty($price) || ($id_category_fk)){

            if($_FILES["img"]["type"] == "image/jpg" ||
            $_FILES["img"]["type"] == "image/jpeg" ||
            $_FILES["img"]["type"] == "image/png"){
                $imagen = $body->imagen;
                $id = $this->model->insertGame($name,$price,$id_category_fk,$imagen); //el $id solo nos dice 
                $this->view->response("Se inserto con el id = $id",200);
            }else{
                $this->model->insertGame($name,$price,$id_category_fk);
                $this->view->response("Se creo un nuevo videogame",200);
            }
        }else{
            $this->view->response("No se pudo insertar",500);
        }
    }

    function editGame($params = null){
        $idGame = $params[':ID'];
        
        $body = $this->getBody();

        $name = $body->name;
        $price = $body->price;
        $id_category_fk = $body->id_category_fk;
        $imagen = $body->imagen;
        if(!empty($name) && !empty($price) && !empty($id_category_fk) && !empty($idGame)){
            if( $_FILES["img"]["type"] == "image/jpg" ||
            $_FILES["img"]["type"] == "image/jpeg" ||
            $_FILES["img"]["type"] == "image/png"){

                $this->model->updategameFromDB($name,$price,$id_category_fk,$_FILES["img"]["tmp_name"],$idGame);
                $this->view->response("Se modifico y con imagen",200);
            }else{
                $this->model->updategameFromDB($name,$price,$id_category_fk,$imagen= null,$idGame);
                $this->view->response("Se modifico sin imagen",200);
            }
        }else{
            $this->view->response("No se pudo insertar",500);
        }
    }

    private function getBody(){ 
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
} 