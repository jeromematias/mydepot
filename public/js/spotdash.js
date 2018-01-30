$(document).ready(function() {
    var customTooltip = {
        trigger: 'axis',
        axisPointer: {
            type: 'cross'
        },
        backgroundColor: 'rgba(245, 245, 245, 0.8)',
        borderWidth: 1,
        borderColor: '#ccc',
        padding: 10,
        textStyle: {
            color: '#000'
        },
        position: function(pos, params, el, elRect, size) {
            var obj = {
                top: 10
            };
            obj[['left', 'right'][+(pos[0] < size.viewSize[0] / 2)]] = 30;
            return obj;
        },
        extraCssText: 'width: 170px;height: 80px'
    }
    fluidSwitch();
    //init_chart()
    init_GRP()
    init_BarNegative()
    init_PIE()

    function fluidSwitch() {
        $('#swtich-fluid').click(function(e) {
            e.preventDefault();
            var fluidClass = $(this).attr('class');
            if (fluidClass == 'fa fa-toggle-off') {
                $('#main').removeClass('container');
                $('#main').addClass('container-fuild');
                $('#switch').html('<i class="fa fa-toggle-on" id="swtich-fluid" aria-hidden="true"></i> fluid On');
            } else {
                $('#main').removeClass('container-fuild');
                $('#main').addClass('container');
                $('#switch').html('<i class="fa fa-toggle-off" id="swtich-fluid" aria-hidden="true"></i> fluid Off');
            }
            $('#main').css('padding', '15px');
            fluidSwitch();          

            var resize_all = AsyncResize('initchart');
            resize_all
              .then(AsyncResize('init_GRP'))
              .then(AsyncResize('init_NegBar'))
              .then(AsyncResize('init_PIE'));                      

            function AsyncResize(id){
              var promise = new Promise(function (resolve, reject) {
                var dom = document.getElementById(id);
                var myChart = echarts.init(dom);
                myChart.resize();
              })
              console.log(id);
              return promise;                          
            }            
        })
    }

    function init_chart() {
        var dom = document.getElementById("initchart");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        app.title = 'SPOT DASH';

        option = {
            title: {
                text: 'SPOT DASH',
                subtext: ''
            },
            tooltip: customTooltip,
            legend: {
                data: ['2011年', '2012年']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: {
                type: 'value',
                boundaryGap: [0, 0.01]
            },
            yAxis: {
                type: 'category',
                data: ['巴西', '印尼', '美国', '印度', '中国', '世界人口(万)']
            },
            series: [{
                name: '2011年',
                type: 'bar',
                data: [18203, 23489, 29034, 104970, 131744, 630230]
            }, {
                name: '2012年',
                type: 'bar',
                data: [19325, 23438, 31000, 121594, 134141, 681807]
            }]
        };
        window.onresize = function() {
            myChart.resize();
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }

    function init_GRP() {
        var dom = document.getElementById("init_GRP");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        var dataAxis = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'];
        var data = [220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90, 149, 210, 122, 133, 334, 198, 123, 125, 220];
        var yMax = 500;
        var dataShadow = [];

        for (var i = 0; i < data.length; i++) {
            dataShadow.push(yMax);
        }

        option = {
            title: {
                text: 'GRP by Week',
                subtext: ''
            },
            tooltip: customTooltip,
            xAxis: {
                data: dataAxis,
                axisLabel: {
                    inside: true,
                    textStyle: {
                        color: '#fff'
                    }
                },
                axisTick: {
                    show: false
                },
                axisLine: {
                    show: false
                },
                z: 10
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',                
                containLabel: true
            },
            yAxis: {
                axisLine: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    textStyle: {
                        color: '#999'
                    }
                }
            },
            dataZoom: [{
                type: 'inside'
            }],
            series: [{ // For shadow
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                barGap: '-100%',
                barCategoryGap: '40%',
                data: dataShadow,
                animation: false
            }, {
                type: 'bar',
                itemStyle: {
                    normal: {
                        barBorderWidth: 0,
                        barBorderColor: '#ED7D31',
                        color: '#ED7D31'
                    },
                    emphasis: {
                        barBorderColor: '#ED7D31',
                        color: '#ED7D31'
                    }
                },
                data: data
            }]
        };
        window.onresize = function() {
            myChart.resize();
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }

    function init_BarNegative() {
        var dom = document.getElementById("init_NegBar");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        var labelRight = {
            normal: {
                position: 'right'
            }
        };
        var NegBarProperty = {
            normal: {
                barBorderWidth: 0,
            }
        }
        var PosBarProperty = {
            normal: {
                barBorderWidth: 0,
                barBorderColor: '#00B050',
                color: '#00B050'
            }
        }
        option = {
            title: {
                text: 'Benchmark',
                subtext: '',
                sublink: '',
            },
            tooltip: customTooltip,
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: {
                type: 'value',
                position: 'bottom',
                splitLine: {
                    lineStyle: {
                        type: 'dashed'
                    }
                },
            },
            yAxis: {
                type: 'category',
                axisLine: {
                    show: false
                },
                axisLabel: {
                    show: false
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                data: [-0.07, -0.09, 0.2, 0.44, -0.23, 0.08, -0.17, 0.47, -0.36, 0.18]
            },
            series: [{
                name: 'Value',
                type: 'bar',
                stack: 'tile',
                label: {
                    normal: {
                        show: true,
                        formatter: '{b}'
                    }
                },
                data: [{
                    value: -0.07,
                    itemStyle: NegBarProperty
                }, {
                    value: -0.09,
                    itemStyle: NegBarProperty
                }, {
                    value: 0.2,
                    itemStyle: PosBarProperty
                }, {
                    value: 0.44,
                    itemStyle: PosBarProperty
                }, {
                    value: -0.23,
                    itemStyle: NegBarProperty
                }, {
                    value: 0.08,
                    itemStyle: PosBarProperty
                }, {
                    value: -0.17,
                    itemStyle: NegBarProperty
                }, {
                    value: 0.47,
                    itemStyle: PosBarProperty
                }, {
                    value: -0.36,
                    itemStyle: NegBarProperty
                }, {
                    value: 0.18,
                    itemStyle: PosBarProperty
                }]
            }]
        };
        window.onresize = function() {
            myChart.resize();
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }

    function init_PIE() {
        var dom = document.getElementById("init_PIE");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;

        option = {
            title: {
                text: 'Share',
                subtext: '',
                left: 'left'
            },
            tooltip: {
                trigger: 'item',
                formatter: "SHARE <br/>{b} : {c} ({d}%)",
                backgroundColor: 'rgba(245, 245, 245, 0.8)',
                borderWidth: 1,
                borderColor: '#ccc',
                padding: 10,
                textStyle: {
                    color: '#000'
                },
                position: function(pos, params, el, elRect, size) {
                    var obj = {
                        top: 10
                    };
                    obj[['left', 'right'][+(pos[0] < size.viewSize[0] / 2)]] = 30;
                    return obj;
                },
                extraCssText: 'width: 170px;height: 60px'
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            legend: {
                orient: 'vertical',
                // top: 'middle',
                x : 'left',
                y : 'bottom',
                data: ['Brand A', 'Brand B', 'Brand C', 'Brand D', 'Brand E']
            },
            series: [{
                type: 'pie',
                radius: '65%',
                center: ['50%', '50%'],
                roseType : 'area',
                selectedMode: 'single',
                data: [{
                    value: 403,
                    name: 'Brand A'
                }, {
                    value: 535,
                    name: 'Brand B'
                }, {
                    value: 510,
                    name: 'Brand C'
                }, {
                    value: 634,
                    name: 'Brand D'
                }, {
                    value: 735,
                    name: 'Brand E'
                }],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };
        window.onresize = function() {
            myChart.resize();
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }
})