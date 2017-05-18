<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchwellwertModel
 *
 * @author andre
 */
class SchwellwertModel extends CI_Model {
    
    public function __construct() {
        $this->load->model('SensorDAO');
        $this->load->model('SchwellwertDAO');
    }
    
    public function get_schwellwerte($sensor) {
        $data = array();
        
        $sql = "SELECT * FROM Schwellwerte WHERE SensorID = ?";
        $query = $this->db->query($sql, array($sensor->get_SensorID()));
        
        $data = $query->result('SchwellwertDAO');
        
        return($data);
    }
    
}
