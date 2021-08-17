<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author andre
 */
class Sensor extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('RoomDAO');
        $this->load->model('SensorDAO');
        $this->load->model('MeasurementDAO');
    }
    
    public function info($id) {
        $data['sensor'] = $this->SensorDAO->getSensorById($id);
        
        $roomId = $this->SensorDAO->getRoomIdBySensor($data['sensor']);
        $data['room'] = $this->RoomDAO->getRoomById($roomId);
        
        $this->load->view('sensor', $data);
    }
    
}
