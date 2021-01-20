<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commande_model extends CI_Model{	
	public function insertCommande($idEtudiant, $dateCommande){
		$request="insert into commande (idEtudiant, dateCommande) values('%d', '%s')";
		$request=sprintf($request, $idEtudiant, $dateCommande);
		$this->db->query($request);		
	}

	public function getNbrPlatAPreparer($date){
		$requete = "select * from nbrPlatAPreparer where dateCommande <='%s'";
		$requete=sprintf($requete,$date);
		$query = $this->db->query($requete);
		return $query->result_array(); 			
	}
}