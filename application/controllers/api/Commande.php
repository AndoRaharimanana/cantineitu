<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Commande extends REST_Controller {

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
public function index_get($id = 0)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){
			if(!empty($id)){
				$response["data"] = $this->db->get_where("commande", ['idCommande' => $id])->row_array();
			}else{
				$response["data"] = $this->db->get("commande")->result();
			}
			$response["status"] = "200";		
			$response["message"] = "Succes.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}
		else{
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
 public function index_post()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		date_default_timezone_set("Africa/Nairobi");
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){	 
			$this->load->model('commande_model');
			$this->commande_model->insertCommande($info[0]["idEtudiant"], date("Y-m-d"));
			$response["status"] = "200";		
			$response["message"] = "Commande created successfully.";
			$this->response($response, REST_Controller::HTTP_OK
			);
			}
		else{
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
 public function index_put($id)
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
			$this->db->update('commande', $input, array('idCommande'=>$id));
			$response["status"] = "200";		
			$response["message"] = "Commande updated successfully.";
			$this->response($response, REST_Controller::HTTP_OK
			);
			}
		else{
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
 
public function commandePlat_get($id = 0)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){		 
			if(!empty($id)){
				$response["data"] = $this->db->get_where("commandePlat", ['idCommande' => $id])->row_array();
			}else{
				$response["data"] = $this->db->get("commandePlat")->result();
			}
			$response["status"] = "200";		
			$response["message"] = "Succes.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}
		else{
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
 
  public function commandePlat_post()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){	 
			$input = $this->input->post();
			$this->db->insert('commandePlat',$input);
			$response["status"] = "200";		
			$response["message"] = "Plat commande avec succes.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}
		else{
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
 
 public function commandePlat_put()
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
			$this->db->update('commandePlat', $input, array('idCommande'=>$input["idCommande"], 'idPlat'=>$input["idPlat"]));
			$response["status"] = "200";		
			$response["message"] = "Commande plat updated successfully.";
			$this->response($response, REST_Controller::HTTP_OK
			);
		}
		else{
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
 
 public function commandePlat_delete($idCommande, $idPlat=0)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('etudiant_model');
		$token = $this->etudiant_model->getToken();
		$info = $this->etudiant_model->checkToken($token);	
		if(!empty($info)){	 
			if(!empty($idPlat)){
				$this->db->delete('commandePlat', array('idCommande'=>$idCommande, 'idPlat'=>$dPlat));	 
			}else{
				$this->db->delete('commandePlat', array('idCommande'=>$idCommande));	  
			}
			$response["status"] = "200";		
			$response["message"] = "Delete was successfully.";
			$this->response($response, REST_Controller::HTTP_OK
			);			
		}
		else{
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

public function nbPlatAPreparer_get($year = 0, $month = 0, $day = 0)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->load->model('commande_model');
		date_default_timezone_set("Africa/Nairobi");
		$date ="";
		if((empty($year))||(empty($month))||(empty($day))){
			$date = date("Y-m-d");
		}else{
			$date = $year."-".$month."-".$day;
		} 
			$response["data"] = $this->commande_model->getNbrPlatAPreparer($date);
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
}