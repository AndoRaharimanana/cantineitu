<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Menu extends REST_Controller {

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
public function index_get($year = 0, $month = 0, $day = 0)
 {
	 try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		date_default_timezone_set("Africa/Nairobi");
		$date ="";
		if((empty($year))||(empty($month))||(empty($day))){
			$date = date("Y-m-d");
		}else{
			$date = $year."-".$month."-".$day;
		} 	 
		$this->load->model('menu_model');
		$response["status"] = "200";
		$response["message"] = "OK";
		$response["data"] = $this->menu_model->getMenuJour($date);
		$this->response($response, REST_Controller::HTTP_OK);
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
		$input = $this->input->post();
		$this->db->insert('menu',$input);
		$response["status"] = "200";		
		$response["message"] = "Menu created successfully.";
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
 public function index_put($id)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$input = $this->put();
		$this->db->update('menu', $input, array('idMenu'=>$id));
		$response["status"] = "200";		
		$response["message"] = "Menu updated successfully.";
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
 public function index_delete($id)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->db->delete('menu', array('idMenu'=>$id));
		$response["status"] = "200";		
		$response["message"] = "Menu deleted successfully.";
		$this->response($response, REST_Controller::HTTP_OK
		);
	}catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}
 }

 public function menuPlat_post()
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$input = $this->input->post();
		$this->db->insert('menuClient',$input);
		$response["status"] = "200";		
		$response["message"] = "Ajout plat dans le menu avec succes.";
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
 public function menuPlat_put($id)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$input = $this->put();
		$this->db->update('menuClient', $input, array('idMenu'=>$id));
		$response["status"] = "200";		
		$response["message"] = "Update was successfully.";
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
 public function menuPlat_delete($id)
 {
	try{
		$response["status"] = "";
		$response["message"] = "";
		$response["data"] = array();
		$this->db->delete('menuClient', array('idMenu'=>$id));
		$response["status"] = "200";		
		$response["message"] = "Delete was successfully.";
		$this->response($response, REST_Controller::HTTP_OK
		);
	}catch(Exception $ex){
		$response["status"] = "404";
		$response["message"] = "Une erreur est survenue lors du chargement";
		$this->response($response, REST_Controller::HTTP_OK);
	}
 }

}