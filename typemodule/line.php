<?php

class LineChart extends baseChart
{
    
    protected $_typeId = 'Line';
    
    public $extendsDataAction = array('get_trendLines');
    
            
    function __construct() {
        parent::__construct();
        $this->set3D(false);
    }
    
    public function getType() 
    { 
        return $this->_typeId;  
    }
}

