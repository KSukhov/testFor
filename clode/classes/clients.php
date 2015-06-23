<?php
/**
 * Created by PhpStorm.
 * User: geol
 * Date: 6/14/15
 * Time: 4:02 AM
 */

class Clients {
    private $filter = array();
    private $db;

    function __construct($db)
    {
       $this->db = $db;
    }

    function getClientList($filter)
    {
	$this->filter = $filter;
	$sql = 'SELECT clients.*,  p.avg_sum FROM clients 
		LEFT JOIN ( SELECT client_id, AVG( summ ) avg_sum
				FROM `clode`.`payments` GROUP BY client_id ) p 
			ON id = p.client_id 
		WHERE 1 '.$this->makePredict();
	return $this->db->query($sql)->fetchAll();
	 
    }
    function requestPhone($email)
    {
   	if(mail( $email, 'Запрос телефона' , 'Сабж')){
	    echo "Запрос отправлен";
	} else{
	    echo "Сбой запроса";
	}
    }
    private function makePredict(){
	$query = "";
    	if(!empty($this->filter['name'])) {
   		 $query .= ' AND name LIKE "%'.$this->filter['name'].'%"';
	}
	if(!empty($this->filter['ballance'])) {
  	  $query .= ' AND amount ';
  	  $query .= empty($this->filter['ballmore'])?' < ':' > ';
  	  $query .= $this->filter['ballance'];
	}
	if(!empty($this->filter['hasPhone'])) {
  	  $query .= ' AND phone IS NOT NULL';
	}
	if(!empty($this->filter['begin'])){
  	  $query .= ' AND register >= "'.$this->filter['begin'].'"';
	}
	if(!empty($this->filter['end'])){
  	  $query .= ' AND register <= "'.$this->filter['end'].'"';
	}
	if(!empty($this->filter['from'])){
  	  $query .= ' AND avg_sum >= "'.$this->filter['from'].'"';
	}
	if(!empty($this->filter['to'])){
  	  $query .= ' AND avg_sum <= "'.$this->filter['to'].'"';
	}
	return $query;
    }
}
