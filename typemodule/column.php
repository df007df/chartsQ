<?php

class columnChart extends baseChart
{
    
    protected $_typeId = 'Column';
    
    
    private $_trendLinesData = array();
            
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
    
    
    
    
    public function f_trendLines($val, $title, $color = '009933')
    {
        $this->_trendLinesData[] = array(
            'startValue' => $val, 
            'displayvalue' => $title, 
            'color' => $color
        );
        
    }
    
    
    public function get_trendLines($val, $title, $color = '009933')
    { 
        if (empty($this->_trendLinesData))
            return array();
        
        return array('trendlines' => array(
            'line' => $this->_trendLinesData
        ));
    }
            
    
    
}

