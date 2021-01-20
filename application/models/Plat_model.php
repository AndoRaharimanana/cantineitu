<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plat_model extends CI_Model{	
	public function insert($idEtudiant, $idPlat){
		$request="insert into favoris (idEtudiant, idPlat) values('%d', '%d')";
		$request=sprintf($request, $idEtudiant, $idPlat);
		$this->db->query($request);		
	}

	public function getFavoris($idEtudiant){
		$requete = "select * from favoris where idEtudiant ='%d'";
		$requete=sprintf($requete,$idEtudiant);
		$query = $this->db->query($requete);
		return $query->result_array(); 			
	}
}