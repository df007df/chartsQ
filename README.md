charts_download
===============

quickly create a chart (php to js) and support for export for FusionCharts;


## Usage Examples

```php
include_once 'typemodule/base.php';

$type = 'column';
$chart = baseChart::factory($type)
        
$chart->set_xAxisName('xxx');
$chart->set_yAxisName('yy');
$chart->set_numberPrefix('@');
        
$chart->f_trendLines(66, 'bigo！');
        
        
$data = array(
   array('label' => 'jan', 'value' => '100'),
   array('label' => 'sdd', 'value' => '12'),
   array('label' => 'duan', 'value' => '54'),
);
$chart->setData($data);
$dataSource = $chart->getDataSource(); //dataSource is params of $.insertFusionCharts()

//index.html

echo $chart->renderInit();

```

###So 
   render to html for script.

```js

<div id="chart_679def56_div" class="">xx</div>
        
        <script>
        $("#chart_679def56_div").insertFusionCharts({
               type: 'Column3D', id: 'chart_679def56',
               dataFormat: 'json', width: '60%', height: '60%',
               dataSource: {"chart":{"xAxisName":"xxx","yAxisName":"yy","numberPrefix":"@"},"trendlines":{"line":[{"startValue":66,"displayvalue":"\u4f60\u5988\uff01","color":"009933"}]},"data":[{"label":"jan","value":"100"},{"label":"sdd","value":"12"},{"label":"duan","value":"54"}]}
    
         });
</script> 

```

####Only completed 'Colunm' charts, welcome to Fork! (*^__^*) 
