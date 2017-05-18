<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author andre
 */
class Ajax extends CI_Controller {
    
    public function index()
    {
        show_404();
    }
    
    public function messages($name = null)
    {
        echo 'hier';
        
        
        
    }
    
}
