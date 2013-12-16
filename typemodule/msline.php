<?php

class MSLineChart extends baseChart
{

    protected $_typeId = 'MSLine';

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

