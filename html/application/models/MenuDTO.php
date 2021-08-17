<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MenuDTO
 *
 * @author andre
 */
class MenuDTO {
    
    private $liClass;
    private $aClass;
    private $aHref;
    private $aIcon;
    private $aSpan;
    private $submenus;
    
    public function __construct($liClass = null, $aHref = null, $aIcon = null, $aSpan = null) {
        $this->liClass = $liClass;
        $this->aHref = $aHref;
        $this->aIcon = $aIcon;
        $this->aSpan = $aSpan;
    }
    
    public function getHtml() {
        $html = '';
        $html .= ($this->getLiClass() !== null) ? '<li class="' . $this->getLiClass() . '">' : '<li>';
        $html .= $this->getA();
        if (is_array($this->getSubmenus()) && count($this->getSubmenus()) > 0 ) {
            $html .= '<ul class="collapse">';
            foreach($this->getSubmenus() as $submenu) {
                $html .= $submenu->getHtml();
            }
            $html .= '</ul>';
        }
        $html .= '</li>';
        
        return $html;
    }
    
    public function getA() {
        $a = '';
        $a .= '<a href="#" class="smarte-menu ajax-get-content"';
        $a .= ' data-href="' . $this->getAHref() . '">';
        $a .= ($this->getAIcon() !== null) ? '<i class="' . $this->getAIcon() . '"></i>' : '';
        $a .= ($this->getASpan() !== null) ? '<span>' . $this->getASpan() . '</span>' : '';
        $a .= '</a>';
        
        return $a;
    }
    
    public function getLiClass() {
        return $this->liClass;
    }

    public function getAHref() {
        return $this->aHref;
    }

    public function getAIcon() {
        return $this->aIcon;
    }

    public function getASpan() {
        return $this->aSpan;
    }

    public function getSubmenus() {
        return $this->submenus;
    }

    public function setLiClass($liClass) {
        $this->liClass = $liClass;
        return $this;
    }

    public function setAHref($aHref) {
        $this->aHref = $aHref;
        return $this;
    }

    public function setAIcon($aIcon) {
        $this->aIcon = $aIcon;
        return $this;
    }

    public function setASpan($aSpan) {
        $this->aSpan = $aSpan;
        return $this;
    }

    public function setSubmenus($submenus) {
        $this->submenus = $submenus;
        return $this;
    }

}
