<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SensorDataModel
 *
 * @author andre
 */
class SensorDataModel extends CI_Model {

    public function __construct() {
        $this->load->model('SensorDAO');
        $this->load->model('SensorDataDAO');
    }
    
    public function get_all_sensor_data($sensor) {
        $data = array();
        
        $sql = "SELECT * FROM SensorDaten WHERE SensorID = ?";
        $query = $this->db->query($sql, array($sensor->get_SensorID()));
        
        $data = $query->result('SensorDataDAO');
        
        return($data);
    }
    
    public function get_sensor_data_from_to($sensor, $from, $to) {
        $data = array();
        
        $sql = "SELECT * FROM SensorDaten WHERE SensorID = ? AND SensorZeit BETWEEN ? AND ?";
        $query = $this->db->query($sql, array($sensor->get_SensorID(), $from, $to));
        
        $data = $query->result('SensorDataDAO');
        
        return($data);
    }
    
}
