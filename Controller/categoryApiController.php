<?php
require_once "View/ApiView.php";
require_once "Model/categoryModel.php";


class categoryApiController {
    private $model;
    private $view;
    public function __construct() {
        $this->model = new categoryModel();
        $this->view = new Apiview();
    }

    function orderBy($sort,$order){

        if($order == "DESC" || $order == "desc" || $order == "ASC" ||  $order == "asc" ){
                $category = $this->model->orderBy($sort,$order);
                $this->view->response($category,200);
        }else{
            $this->view->response("es invalido el parametro",400);
        }
    }
    

    function showAllCategory($params = null){ 

        /*  ==================================================================
                                        EL ORDER BY
            ===================================================================== */
        if(!empty($_GET["sort"]) && !empty($_GET["order"])){
            $sort = $_GET["sort"];
            $order = $_GET["order"];
            if($order == "DESC" || $order == "desc" || $order == "ASC" ||  $order == "asc" ){
                $this->orderBy($sort,$order);
            }else{
                $this->view->response("es invalido el parametro",400);
            }
        }

        /*  ==================================================================
                                        PAGINADOR
            ===================================================================== */

            
            
        /*  ==================================================================
                                        NO SE
            ===================================================================== */
            
        $category = $this->model->getCategorys();
        if($category)
            return $this->view->response($category, 200); //la nueva vista 
        else{
            return $this->view->response("No se pudo encontrar", 404); //la nueva vista 
        }
    }

    function getCategory($params = null){
        $idCategory = $params[':ID'];
        $category = $this->model->getCategory($idCategory);
        if($category){
            return $this->view->response($category, 200); //la nueva vista 
        }else{
            return $this->view->response("Fallo,no se pudo traer la categoria", 404);
        }
    }

    function deleteCategory($params = null){
        $idCategory = $params[':ID'];
        if(!empty($idCategory)){
            $category = $this->model->deleteCategoryFromDB($idGame);
            return $this->view->response("Fue borrado la categoria $category", 200); //la nueva vista 
        }else{
            return $this->view->response("No se pudo borrar la categoria (no se encontr el id)", 500); //la nueva vista 
        }
    }

    function createCategorys($params = null){
        $body = $this->getBody();

        $genre = $body->genre;
        $gameplay = $body->gameplay;

        if(!empty($genre) && !empty($gameplay)){
            $id = $this->model->insertCategory($genre,$gameplay); 
            $this->view->response("Se inserto con el id = $id",200);
        }else{
            $this->view->response("No se pudo insertar",500);
        }
    }

    function editCategory($params = null){
        $idCategory = $params[':ID'];
        
        $body = $this->getBody();

        $genre = $body->genre;
        $gameplay = $body->gameplay;

        if(!empty($genre) && !empty($gameplay)){
            $id = $this->model->updateCategoryFromDB($genre,$gameplay,$idCategory); 
            $this->view->response("Se modifico con el id = $id",200);
        }else{
            $this->view->response("No se pudo modificar",500);
        }
    }

    private function getBody(){
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }
} 