<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Etudiant extends REST_Controller {

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
public function index_get($numETU = 0)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		if(!empty($numETU)){
			$response["data"] = $this->db->get_where("etudiant", ['numETU' => $numETU])->row_array();
		}else{
			$response["data"] = $this->db->get("etudiant")->result();
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

 /**
 * Get All Data from this method.
 *
 * @return Response
 */
 public function index_post()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$input = $this->input->post();
		//$this->db->insert('etudiant',$input);
		$this->etudiant_model->insert($input['numETU'], $input['pwd'], $input['nom'], $input['dateNaissance']);
		$response["status"] = "200";		
		$response["message"] = "Inscription was successfully.";
		$this->response($response, REST_Controller::HTTP_OK
		);
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
 public function index_put()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){
			$input = $this->put();
			$this->etudiant_model->modificationProfil($info[0]['idEtudiant'], $input['nom'], $input['dateNaissance']);		
			$response["status"] = "200";		
			$response["message"] = "Update was successfully.";
			$this->response($response, REST_Controller::HTTP_OK
			);	 
		}else{
			$response["status"] = "200";		
			$response["message"] = "Acces non autorise pour les users authentifies .";
			$this->response($response, REST_Controller::HTTP_OK
			);			
		}
	}catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}

 }
 
public function montantTotalPlat_get()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){	 
			$response["data"] = $this->db->get_where("etudiantMontant", ['idEtudiant' => $info[0]['idEtudiant']])->row_array();
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

public function connect_post(){
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$input = $this->input->post();
		$data = $this->etudiant_model->authentification($input["numETU"], $input["pwd"]);
		if(!empty($data)){
			$token = $this->etudiant_model->createToken($input["numETU"], $input["pwd"]);
			$this->etudiant_model->insertToken($data[0]["idEtudiant"], $token);
			$response["status"] = "200";		
			$response["message"] = "Authentification reussie.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}else{
			$response["status"] = "200";		
			$response["message"] = "Mot de passe ou etu incorrecte.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}		 
	}catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}
}
}