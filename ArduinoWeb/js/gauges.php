<script src = 'js/gauge.js'></script>
<script src = 'http://code.jquery.com/jquery-latest.js'></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
window.onload = function () 
{
    var vlaznost_zemljista_gauge = new Gauge(
    {
        renderTo    : 'vlaznost_zemljista',
        width       : 300,
        height      : 300,
        glow        : false,
        units       : '%',
        title       : 'Vla\u017Enost zemlji\u0161ta',
        minValue    : 10,
        maxValue    : 100,
        majorTicks  : ['10','20','30','40','50','60','70','80','90','100'],
        minorTicks  : 10,
        strokeTicks : false,
        highlights  : [
            { from : 10, to : 30, color : 'brown' },
            { from : 30, to : 100, color : '' }
        ],
        colors      : {
            plate: '#222',
            majorTicks: '#f5f5f5',
            minorTicks: '#ddd',
            title: '#fff',
            units: '#ccc',
            numbers: '#eee',
            needle     : {
                start : 'rgba(240, 128, 128, 1)',
                end : 'rgba(255, 160, 122, .9)',
                circle: {
                    outerStart: '#333',
                    outerEnd: '#111',
                    innerStart: '#111',
                    innerEnd: '#222'
                },
                shadowUp: false,
                shadowDown: false
            },
            circle: {
                shadow: false,
                outerStart: '#333',
                outerEnd: '#111',
                middleStart: '#222',
                middleEnd: '#111',
                innerStart: '#111',
                innerEnd: '#333'
            },
            valueBox: {
                rectStart: '#222',
                rectEnd: '#333',
                background: '#babab2',
                shadow: 'rgba(0, 0, 0, 1)'
            }
        },
        animation : {
            delay : 25,
            duration: 1500,
            fn : 'bounce'
        }
    });

    vlaznost_zemljista_gauge.onready = function() {
        vlaznost_zemljista_gauge.setValue(<?php echo $vlaznost_zemljista;?>);
    };

    vlaznost_zemljista_gauge.draw();

   
    var vlaznost_vazduha_gauge = new Gauge(
    {
        renderTo    : 'vlaznost_vazduha',
        width       : 300,
        height      : 300,
        glow        : false,
        units       : '%',
        title       : 'Vla\u017Cnost vazduha',
        minValue    : 10,
        maxValue    : 100,
        majorTicks  : ['10','20','30','40','50','60','70','80','90','100'],
        minorTicks  : 10,
        strokeTicks : false,
        highlights  : [],
        colors      : {
            plate: '#222',
            majorTicks: '#f5f5f5',
            minorTicks: '#ddd',
            title: '#fff',
            units: '#ccc',
            numbers: '#eee',
            needle     : {
                start : 'rgba(240, 128, 128, 1)',
                end : 'rgba(255, 160, 122, .9)',
                circle: {
                    outerStart: '#333',
                    outerEnd: '#111',
                    innerStart: '#111',
                    innerEnd: '#222'
                },
                shadowUp: false,
                shadowDown: false
            },
            circle: {
                shadow: false,
                outerStart: '#333',
                outerEnd: '#111',
                middleStart: '#222',
                middleEnd: '#111',
                innerStart: '#111',
                innerEnd: '#333'
            },
            valueBox: {
                rectStart: '#222',
                rectEnd: '#333',
                background: '#babab2',
                shadow: 'rgba(0, 0, 0, 1)'
            }
        },
        animation : {
            delay : 25,
            duration: 1500,
            fn : 'bounce'
        }
    });

    vlaznost_vazduha_gauge.onready = function() {
        vlaznost_vazduha_gauge.setValue(<?php echo $vlaznost_vazduha;?>);
    };

    vlaznost_vazduha_gauge.draw();

    var temperatura_gauge = new Gauge(
    {
        renderTo    : 'temperatura',
        width       : 300,
        height      : 300,
        glow        : false,
        units       : '°C',
        title       : 'Temperatura',
        minValue    : -40,
        maxValue    : 80,
        majorTicks  : ['-40','-30','-20','-10','0','10','20','30','40','50','60','70','80'],
        minorTicks  : 10,
        strokeTicks : false,
        highlights  : [
            { from : -40, to : 0, color : '#0052cc' },
            { from : 40, to : 80, color : '' }
        ],
        colors      : {
            plate: '#222',
            majorTicks: '#f5f5f5',
            minorTicks: '#ddd',
            title: '#fff',
            units: '#ccc',
            numbers: '#eee',
            needle     : {
                start : 'rgba(240, 128, 128, 1)',
                end : 'rgba(255, 160, 122, .9)',
                circle: {
                    outerStart: '#333',
                    outerEnd: '#111',
                    innerStart: '#111',
                    innerEnd: '#222'
                },
                shadowUp: false,
                shadowDown: false
            },
            circle: {
                shadow: false,
                outerStart: '#333',
                outerEnd: '#111',
                middleStart: '#222',
                middleEnd: '#111',
                innerStart: '#111',
                innerEnd: '#333'
            },
            valueBox: {
                rectStart: '#222',
                rectEnd: '#333',
                background: '#babab2',
                shadow: 'rgba(0, 0, 0, 1)'
            }
        },
        animation : {
            delay : 25,
            duration: 1500,
            fn : 'bounce'
        }
    });

    temperatura_gauge.onready = function() {
        temperatura_gauge.setValue(<?php echo $temperatura;?>);
    };

    temperatura_gauge.draw();

    var navodnjavanje_gauge = new Gauge({
        renderTo: 'navodnjavanje',
        width: 300,
        height: 300,
        glow: false,
        units: 'Navodnjavanje',
        title: 'Isklju\u010Deno/Uklju\u010Deno',
        minValue: -0.25,
        maxValue: 1.25,
        majorTicks: ['','','',''],
        minorTicks: 0,
        strokeTicks: true,
        highlights: [
            { from : -0.25, to : 0.25, color : 'red' },
            { from : 0.75, to : 1.25, color : 'green' }
        ],
        colors: {
            plate: '#222',
            majorTicks: '#f5f5f5',
            minorTicks: '#ddd',
            title: '#fff',
            units: '#ccc',
            numbers: '#eee',
            needle     : {
                start : 'rgba(240, 128, 128, 1)',
                end : 'rgba(255, 160, 122, .9)',
                circle: {
                    outerStart: '#333',
                    outerEnd: '#111',
                    innerStart: '#111',
                    innerEnd: '#222'
                },
                shadowUp: false,
                shadowDown: false
            },
            circle: {
                shadow: false,
                outerStart: '#333',
                outerEnd: '#111',
                middleStart: '#222',
                middleEnd: '#111',
                innerStart: '#111',
                innerEnd: '#333'
            },
            valueBox: {
                rectStart: '#222',
                rectEnd: '#333',
                background: '#babab2',
                shadow: 'rgba(0, 0, 0, 1)'
            }
        },
        valueBox: {
            visible: false
        },
        valueText: {
            visible: false
        },
        animation: {
            delay: 25,
            duration: 1500,
            fn: 'bounce'
        },
        updateValueOnAnimation: true
    });

    navodnjavanje_gauge.onready = function () {
        navodnjavanje_gauge.setValue(<?php echo $navodnjavanje;?>);
    };

    navodnjavanje_gauge.draw();

   var vazdusni_pritisak_gauge = new Gauge(
    {
        renderTo    : 'vazdusni_pritisak',
        width       : 300,
        height      : 300,
        glow        : false,
        units       : 'hPa(mbar)',
        title       : 'Vazdu\u0161ni pritisak',
        minValue    : 500,
        maxValue    : 1100,
        majorTicks  : ['500','600','700','800','900','1000','1100'],
        minorTicks  : 10,
        strokeTicks : false,
        highlights  : [
            { from : 300, to : 1100, color : '' }
        ],
        colors      : {
            plate: '#222',
            majorTicks: '#f5f5f5',
            minorTicks: '#ddd',
            title: '#fff',
            units: '#ccc',
            numbers: '#eee',
            needle     : {
                start : 'rgba(240, 128, 128, 1)',
                end : 'rgba(255, 160, 122, .9)',
                circle: {
                    outerStart: '#333',
                    outerEnd: '#111',
                    innerStart: '#111',
                    innerEnd: '#222'
                },
                shadowUp: false,
                shadowDown: false
            },
            circle: {
                shadow: false,
                outerStart: '#333',
                outerEnd: '#111',
                middleStart: '#222',
                middleEnd: '#111',
                innerStart: '#111',
                innerEnd: '#333'
            },
            valueBox: {
                rectStart: '#222',
                rectEnd: '#333',
                background: '#babab2',
                shadow: 'rgba(0, 0, 0, 1)'
            }
        },
        animation : {
            delay : 25,
            duration: 1500,
            fn : 'bounce'
        }
    });

    vazdusni_pritisak_gauge.onready = function() {
    	vazdusni_pritisak_gauge.setValue(<?php echo $vazdusni_pritisak;?>);
    };

    vazdusni_pritisak_gauge.draw();
	};	
</script>
<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Vreme', 'Izmerena vrednost'],
  <?php echo $podaci_24h;?>
]);

var options = {
  title: '<?php echo $naslov;?> u poslednja 24 \u010Dasa',
  titleTextStyle: {color: 'white', fontSize: 24, bold: true},
/*            hAxis: {
      title: 'Vreme',
      titleTextStyle: {color: '#ccc'},
      textStyle: {color: 'white', fontSize: 18}
  },*/
    vAxis: {
      title: '<?php echo $naslov;?>',
      titleTextStyle: {color: '#ccc'},
      textStyle: {color: 'white', fontSize: 18}
  },
  curveType: 'function',
  colors: ['red'],
  lineWidth: 5,
  legend: {textStyle: {color: '#ccc', fontSize: 16}},
  backgroundColor : {
    fill: '#222',
    stroke: '#111',
    strokeWidth: 5
  }
};

var chart = new google.visualization.LineChart(document.getElementById('grafik'));

chart.draw(data, options);
}
</script>