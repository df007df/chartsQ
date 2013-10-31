<?php

class columnChart extends baseChart
{
    
    protected $_typeId = 'Column';
    
    
    
            
    function __construct() {
        parent::__construct();
    }
    
    
    
    public $extendsDataAction = array('get_trendLines');
    
    /*设置chart 属性*/
    
    public function set_xAxisName($val)
    {
        $this->xAxisName = $val;
    }
    
    public function set_yAxisName($val)
    {
        $this->yAxisName = $val;
    }
    
    
    public function set_numberPrefix($val)
    {
        $this->numberPrefix = $val;
    }
    
    
    public function set_showValues($val)
    {
        $this->showValues = $val;
    }
    
    
    
    
    
            
    
    
}

