<?php
include_once 'column.php';
class mscolumnChart extends columnChart
{
    
    protected $_typeId = 'MSColumn';
    
    
    private $_categories = array();
            
    public $extendsDataAction = array('get_categories');
    
    function __construct() {
        parent::__construct();
    }
    
 
    
    public function set_categories($val)
    {
        $this->categories = array($val);
    }
    
    
    public function set_dataset($val)
    {
        $this->dataset = $val;
    }
    
    
    
    public function f_categories($data = array())
    {
        $this->_categories[] = $data;
        
    }
    
    
    public function get_categories()
    { 
        if (empty($this->_categories))
            return array();
        
        return array('categories' => $this->_categories);
    }
    
    
    
            
    
    
}

