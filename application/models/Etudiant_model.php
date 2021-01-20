<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etudiant_model extends CI_Model{
	public function insert($numEtu, $pwd, $nom, $dateNaissance){
		$request="insert into etudiant (numETU, pwd, nom, dateNaissance) values('%s', sha1('%s'), '%s', '%s')";
		$request=sprintf($request, $numEtu, $pwd, $nom, $dateNaissance);
		$this->db->query($request);		
	}

	public function createToken($etu, $pwd){
		date_default_timezone_set("Africa/Nairobi");
		return SHA1("token".rand(0, 1000).$pwd.$etu.date("Y-m-d h:m:s"));
	}

	public function checkToken($token){
		$requete = "select * from token where token ='%s'";
		$requete=sprintf($requete, $token);
		$query = $this->db->query($requete);
		return $query->result_array();
	}
	
	public function authentification($etu, $pwd){
		$requete = "select * from etudiant where numETU ='%s' and pwd = '%s'";
		$requete=sprintf($requete,$etu, sha1($pwd));
		$query = $this->db->query($requete);
		return $query->result_array(); 		
	}
	
	public function insertToken($id, $token){
		$request="insert into token (idEtudiant, token) values('%d', '%s')";
		$request=sprintf($request, $id, $token);
		$this->db->query($request);		
	}
	
	public function modificationProfil($id, $nom, $dateNaissance){
		$request="update etudiant set nom='%s', dateNaissance='%s' where idEtudiant='%d'";
		$request=sprintf($request, $nom, $dateNaissance, $id);
		$this->db->query($request);			
	}

	public function getToken(){
		$auth = $this->input->get_request_header("authorization", true);
		$exploded = explode(' ', $auth);
		if(count($exploded)<2){
			return ;
		}
		return $exploded[1];
	}
}