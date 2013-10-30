<html>
  <head>
    <title>My First chart using FusionCharts XT - Using JavaScript</title>

    <script type="text/javascript" src="Charts/FusionCharts.js"></script>
    <script type="text/javascript" src="Charts/FusionChartsExportComponent.js"></script>
    <script type="text/javascript" src="Charts/jquery.min.js"></script>
    <script type="text/javascript" src="Charts/FusionCharts.jqueryplugin.js"></script>

    <script type="text/javascript" src="data.js"></script>
  </head>
  <body>
    <div id="chartContainer">FusionCharts XT will load here!</div>



    <script type="text/javascript">
        var ext;

        $(document).ready(function() {
          $("#chartContainer").insertFusionCharts({
               type: "MSColumn3D",
               dataSource: data,
               dataFormat: "json",
               width: "60%",
               height: "60%",
               id: "myChartId"
         });

//        $("#chartContainer").attrFusionCharts('exportenabled', 1);
//        $("#chartContainer").attrFusionCharts('exportShowMenuItem', 0);
//        $("#chartContainer").attrFusionCharts('xaxisname', 'yewww');



        FusionChartsExportObject.debugMode = true;

        var exportAttributes = {
            exportFormat: 'PNG',
            exportFileName: 'GG12',
            exportHandler: 'http://localhost/charts_download/ExportHandlers/PHP/index.php',
            exportCallback: 'myexportCallback'
        };

        var componentAttributes = {
            message: 1,
            showMessage: 1,
            fullMode: 0,
            width: '300',
            height: '200',
            saveMode: 'both',
            showAllowedTypes: 1

        };

        ext = new FusionChartsExportObject(
            'daochu',
            'Charts/FCExporter.swf',
            componentAttributes,
            exportAttributes,
            ['myChartId'],
            1
        );

        //ext.Render('fcexpDiv');


       });



     function myexportCallback() {
         console.log('arguments', arguments);
     }

     function chartIt() {

        $("#chartContainer").updateFusionCharts({"dataSource": data2});

     }


      function ExportMyChart() {
            ext.BeginExport();

            //var chartObject = getChartFromId('myChartId');
            //if( chartObject.hasRendered() ) chartObject.exportChart();
     }


    </script>



    <input name="button" type='button' value='img' onclick="ExportMyChart();" />

    <input name="button" type='button' value='Chart it!' onclick="chartIt();" />


  </body>
</html>