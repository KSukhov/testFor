<?php
/**
 * Created by PhpStorm.
 * User: geol
 * Date: 6/14/15
 * Time: 4:02 AM
 */

class Clients {

    private $filter = array();
    /**
     * @var BD::db
     */
    private $db;

    function __construct($db)
    {
       $this->db = $db;
    }

    /**
     * @param array $filter массив фильтров, формата фильтр => значение
     * @return array список данных по клиентам
     */
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

    /**
     * @param $email
     */
    function requestPhone($email)
    {
   	    if(mail( $email, 'Запрос телефона' , 'Сабж')){
            echo "Запрос отправлен";
        } else{
	        echo "Сбой запроса";
	    }
    }

    /**
     * Возвращает предикат запроса, соответствующий данным фильтра
     *
     * @return string
     */
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
	    if(!empty($this->filter['registerFrom'])){
  	        $query .= ' AND register >= "'.$this->filter['registerFrom'].'"';
	    }
	    if(!empty($this->filter['registerTo'])){
  	        $query .= ' AND register <= "'.$this->filter['registerTo'].'"';
	    }
	    if(!empty($this->filter['avgSumFrom'])){
  	        $query .= ' AND avg_sum >= "'.$this->filter['from'].'"';
	    }
	    if(!empty($this->filter['avgSumTo'])){
  	        $query .= ' AND avg_sum <= "'.$this->filter['to'].'"';
	    }
	    return $query;
    }
}
