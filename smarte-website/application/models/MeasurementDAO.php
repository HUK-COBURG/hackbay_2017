<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class MeasurementDAO extends CI_Model  {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('MeasurementDTO');
    }
    
    public function getLatestBySensor($sensor) {     
        $sql = sprintf('SELECT * FROM measurements WHERE sensor = %1$d AND time = (SELECT MAX(time) FROM measurements WHERE sensor = %1$d)', $this->db->escape_str($sensor->getId()));
        $measurements = $this->db->query($sql)->result('MeasurementDTO');
        
        $sensor->setMeasurements($measurements);
        
        return $measurements;
    }
    
    public function getPastSecondsBySensor($sensor, $interval) {     
        $query = $this->db->get_where('measurements', array('time >' => time() - $interval, 'sensor' => $sensor->getId()));
        $measurements = $query->result('MeasurementDTO');
        
        $sensor->setMeasurements($measurements);
        
        return $measurements;
    }
    
}
