<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SensorModel
 *
 * @author andre
 */
class SensorModel extends CI_Model {
    
    public function __construct() {
        $this->load->model('SensorDAO');
    }
    
    public function get_active_sensors() {
        $data = array();
        
        $query = $this->db->get_where('Sensoren', array('SensorAktiv' => TRUE));
        $data = $query->result('SensorDAO');
     
        return $data;
    }
    
    public function get_sensor_by_name($name) {
        $query = $this->db->get_where('Sensoren', array('SensorBezeichnung' => $name));
        return $query->row(0, 'SensorDAO'); 
    }
    
}
