<?php

abstract class baseChart
{
    
    public $chartAttr = array();
    
    protected $_typeId = '';
    
    protected $_is3D = true;
    
    protected $_pendingData = array();//待处理数据
    
    
    private $_trendLinesData = array();
    
    
    /**
     * 每个图形 唯一的配置数据回调方法
     * @var type
     */
    public $extendsDataAction = array(); 
    
    /**
     * 前端初始化基本参数
     * @var type 
     */
    public $insertChartsAttr = array(
        'dataFormat' => 'json', 
        'width' => '60%',
        'height' => '90%'
    );


    private static $_typeobj = array();
            
    function __construct() {
        ;
    }
   
    
    
    public static function factory($type) 
    {
        if (empty(self::$_typeobj[$type])) {
            $class = $type . 'Chart';
            self::$_typeobj[$type] = new $class();
        }
        return self::$_typeobj[$type];
    }
    
    
    /**
     * 获取前端渲染唯一id
     * @return type
     */
    protected function getChartId()
    {
        return 'chart_' . substr(md5(time()), 3, 8 );
    }


    public function setInsertChartsAttr($key, $value) 
    {
        $this->insertChartsAttr[$key] = $value;
    }


    public function setData($data = array()) 
    {
        $this->_pendingData = $data;
    }   
    
    /**
     * 返回 不同类型chart前端渲染需要的数据格式
     * @param type $data
     */
    public function getData($data = array()) 
    {
        return $this->_pendingData;
    } 


    public function set3D($bool = true)
    {
        $this->_is3D = $bool;
    }   
    
    
    public function loadStyle($style = '')
    {   
     
        $styleClass = str_replace('Chart', '', get_class($this))
            . 'Style';
   
        $styleObj = new $styleClass();
        if (method_exists($styleObj, $style)) {
            $styleObj->$style($this);
        }
        
    }




    public function getType() 
    { 
        
        if ($this->_is3D) {
            return $this->_typeId . '3D';
        } else {
            return $this->_typeId . '2D';
        }
        
    }


    public function getChartAttr()
    {
        return $this->chartAttr;
    }  
    
    
    
    public function parseChartAttr($attrs = array())
    {
        return $attrs;
    }
    
    
    public function getExtendsDataAction()
    {
        $exts = array();
        foreach ($this->extendsDataAction as $extaction) {
            if (method_exists($this, $extaction)) {
                $exts = array_merge($exts, $this->$extaction());
            }
        }
        return $exts;
    }        

    
    

    /**
     * 解析，组合图形配置参数
     */
    public function getAttr()
    {
        $attr = array();
        $attr['chart'] = $this->getChartAttr();
        return array_merge($attr, $this->getExtendsDataAction()); 
    }  
    
    
    /**
     * 解析，组合图形配置参数
     */
    public function getDataSource()
    {
        $attr = $this->getAttr();
        $data = $this->getData();
        return array_merge($attr, array('data' => $data));
    } 


    
    /**
     * 渲染 js 初始化代码
     */
    public function renderInit()
    {
        $chartId = $this->getChartId();
        $chartIdDiv = $chartId . '_div';
        $type = $this->getType();
        
        $insterAttr = array();
        foreach ($this->insertChartsAttr as $key => $attr) {
            $insterAttr[] = "{$key}: '{$attr}'";  
        }
        
        $insterAttr = implode(', ', $insterAttr);
        
        $params = "type: '{$type}', id: '{$chartId}'";
        $dataSource = json_encode($this->getDataSource());
        
        $html = <<<INSTER
       
        <div id="{$chartIdDiv}" class="">xx</div>
        
        <script>
        $("#{$chartIdDiv}").insertFusionCharts({
               {$params},
               {$insterAttr},
               dataSource: {$dataSource}
    
         });
         </script>    
                    
INSTER;
        
        return $html;
      
    }
    
    
    
    /*特性类型属性方法*/
    
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
    
    
    
    
    

    public function set_caption($val)
    {
        $this->caption = $val;
    }


    public function __set($name, $value) {
        $this->chartAttr[$name] = $value;
    }
    
    
    public function __call($name, $arg = array())
    {   
        $preg = "/^set_(.*)/is";
        if (preg_match($preg, $name, $get) &&
            isset($arg[0]) &&
            !empty($get[1])    
        ) {

            $this->$get[1] = $arg[0];
        }
     
    }






    public static function auto_load($class) 
    {   
        
        if (preg_match("/Chart$/is", $class)) {
            $f = str_replace('Chart', '', $class);
            include_once dirname(__FILE__) . '/' . strtolower($f) . '.php';   
        } 
        
        if (preg_match("/Style$/is", $class)) {
            $f = str_replace('Style', '', $class);
            include_once dirname(__FILE__) . '/stylemodule/' . strtolower($f) . '.php';   
        }
  
    }
    
}

function pr($data) {
    
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


spl_autoload_register('baseChart::auto_load');



