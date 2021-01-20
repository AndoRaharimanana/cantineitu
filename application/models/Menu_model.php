<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{
	public function getMenuJour($date){
		 $request = "select menuClient.*, plat.* 
					 from plat 
					 join menuClient 
					 on plat.idPlat = menuClient.idPlat 
					 where menuClient.idMenu in (select idMenu from menu where idMenu in(select max(idmenu) as idMenu from menu where dateMenu<='%s'))";
		 $request = sprintf($request, $date);
		 $query = $this->db->query($request); 
		 return $query->result_array();
	}
}