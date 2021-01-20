<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Plat extends REST_Controller {

 /**
 * Get All Data from this method.
 *
 * @return Response
 */
 public function __construct() {
 parent::__construct();
 $this->load->database();
 }

 /**
 * Get All Data from this method.
 *
 * @return Response
 */
    public function index_get($idPlat = 0)
    {
        try{
            $response["status"] = "";
            $response["message"] = "";
            $response["data"] = array();
            if(!empty($idPlat)){
                $response["data"] = $this->db->get_where("plat", ['idPlat' => $idPlat])->row_array();
            }else{
                $response["data"] = $this->db->get("plat")->result();
            }
            $response["status"] = "200";		
            $response["message"] = "Succes.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }catch(Exception $ex){
            $response["status"] = "404";
            $response["message"] = "Une erreur est survenue lors du chargement";
            $this->response($response, REST_Controller::HTTP_OK);
        }
    }
public function favoris_get()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
        $info = $this->etudiant_model->checkToken($token);	
        if(!empty($info)){	 
            $response["data"] = $this->db->get_where("favoris", ['idEtudiant' => $info[0]['idEtudiant']])->row_array();   
            $response["status"] = "200";		
            $response["message"] = "Succes.";
            $this->response($response, REST_Controller::HTTP_OK
            );	 
        }else{
            $response["status"] = "200";		
            $response["message"] = "Acces non autorise pour les users authentifies.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }
    }catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}
 }

 /**
 * Get All Data from this method.
 *
 * @return Response
 */
 public function favoris_post()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
        $this->load->model('plat_model');
		$token = $this->etudiant_model->getToken();
        $info = $this->etudiant_model->checkToken($token);	
        if(!empty($info)){     
            $this->load->model('plat_model');     
            $input = $this->input->post();
            $this->plat_model->insert($info[0]['idEtudiant'], $input['idPlat']);
            $response["status"] = "200";		
            $response["message"] = "Ajout favoris was successfully.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }else{
            $response["status"] = "200";		
            $response["message"] = "Acces non autorise pour les users authentifies.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }
    }catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}
 }

 /**
 * Get All Data from this method.
 *
 * @return Response
 */


 public function favoris_delete($idPlat)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
        $this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
        $info = $this->etudiant_model->checkToken($token);
        if(!empty($info)){      
            $this->db->delete('favoris', array('idEtudiant'=>$info[0]["idEtudiant"], 'idPlat'=>$idPlat));
            $response["status"] = "200";		
            $response["message"] = "Favoris deleted successfully.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }else{
            $response["status"] = "200";		
            $response["message"] = "Acces non autorise pour les users authentifies.";
            $this->response($response, REST_Controller::HTTP_OK
            );
        }
    }catch(Exception $ex){
        $response["status"] = "404";
        $response["message"] = "Une erreur est survenue lors du chargement";
        $this->response($response, REST_Controller::HTTP_OK);
    }
}