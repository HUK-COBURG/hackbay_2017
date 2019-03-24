<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class SensorDAO extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('SensorDTO');
    }
    
    public function getAllSensors() {     
        $query = $this->db->get_where('sensors', array('active' => TRUE));
        $alerts = $query->result('SensorDTO');
        
        return $alerts;
    }
    
    public function getSensorsByRoom($room) {     
        $query = $this->db->get_where('sensors', array('room' => $room->getId(), 'active' => TRUE));
        $sensors = $query->result('SensorDTO');
        
        $room->setSensors($sensors);
        return $sensors;
    }
    
    public function getSensorById($id) {
        $query = $this->db->get_where('sensors', array('id' => $id));
        $sensor = $query->result('SensorDTO')[0];
        
        return $sensor;
    }
    
    public function getRoomIdBySensor($sensor) {
        $query = $this->db->get_where('sensors', array('id' => $sensor->getId()));
        return $query->result()[0]->room;
    }
}
