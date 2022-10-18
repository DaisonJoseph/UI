<script>   
    var colors = ['#0070AD', '#12ABDB', '#95E616', '#FF304C', '#C8FF16', '#6D64CC', '#FF6327', '#7E39BA', '#FF7E83', '#00C37B', '#4701A7', '#CB2980', '#01D1D0', '#860864', '#0F999C', '#15636B', '#80B8D6', '#88D5ED']
    var mydiv = document.getElementById("myBreadCrumb");
    var testData = [{
        "testCases":[{
            "Cases":"Unit Testing",
            "Value": 62.74%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 29.30%,
            "color": colors[0]
        },{
            "Type": "Failed",
            "Value": 59.78%,
            "color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 10.29%
            "color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 100,
        }, {
            "Status": "Not Executed",
            "Value": 1500,
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 4025,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 1882,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1809,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1322,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1122,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defectPriority": "Critical Defects Count",
            "Value": 72,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 98,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 123,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 300,
            "color": colors[3]
        }
        ]
    },

      "testCases":[{
            "Cases":"Technical Integration Testing",
            "Value": 10.6%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 32%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 59%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 9%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 90,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1600,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 4025,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 1782,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1909,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1522,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1322,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 62,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 88,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 113,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 200,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"Performance Testing",
            "Value": 7.23%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 19%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 58%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 23%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 120,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1800,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 4000,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 1500,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 2000,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1300,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1020,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 52,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 92,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 150,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 250,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"Load Testing",
            "Value": 5.6%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 32.30%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 56.78%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 10.92%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 400,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1000,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 3500,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 2010,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1600,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1300,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1100,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 70,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 100,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 120,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 290,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"SIT",
            "Value": 4.02%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 35%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 50%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 15%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 180,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1200,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 4025,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 1990,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1500,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1200,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1100,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 85,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 90,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 135,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 270,
            "color": colors[3]
        }
        ]
    },
      "testCases":[{
            "Cases":"E2E",
            "Value": 1.9%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 27.30%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 59.78%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 12.92%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 120,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1300,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 3025,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 2082,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1709,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1422,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1200,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 50,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 88,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 100,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 325,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"Parallel",
            "Value": 7.62%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 40%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 50%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 10%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 135,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1100,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 3000,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 2502,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 2000,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1700,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1500,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 30,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 78,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 110,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 335,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"NRT",
            "Value": 7.62%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 32%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 60%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 8%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 160,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1200,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 3505,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 2020,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1809,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1622,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1100,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 55,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 80,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 110,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 355,
            "color": colors[3]
        }
        ]
    },
    "testCases":[{
            "Cases":"UAT",
            "Value": 7.62%,
            "color": colors[0]
        }],
        "passedCases":[{
            "Type": "Passed",
            "Value": 27.30%,
            "Color": colors[0]
        },{
            "Type": "Failed",
            "Value": 59.78%,
            "Color": colors[1]
        }
        {
            "Type": "Blocked",
            "Value": 12.92%
            "Color": colors[2]
        }
        ],
        "Completion": [{
            "Status": "Executed",
            "Value": 140,
            "color": colors[0]
        }, {
            "Status": "Not Executed",
            "Value": 1200,
            "color": colors[0]
        }],
        "Failed": [{
            "Defect": "Defect1",
            "Value": 3005,
            "color": colors[3]
        },
        {
            "Defect": "Defect2",
            "Value": 2302,
            "color": colors[4]
        },
        {
            "Defect": "Defect3",
            "Value": 1909,
            "color": colors[5]
        },
        {
            "Defect": "Defect4",
            "Value": 1592,
            "color": colors[6]
        },
        {
            "Defect": "Defect5",
            "Value": 1300,
            "color": colors[7]
        }
        ],
        "Priority":[{
            "defect Priority": "Critical Defects Count",
            "Value": 40,
            "color": colors[0]
        }, {
            "defect Priority": "High Defects Count",
            "Value": 98,
            "color": colors[1]
        }, {
            "defect Priority": "Medium defects Count",
            "Value": 130,
            "color": colors[2]
        },
        {
            "defect Priority": "Low defects Count",
            "Value": 350,
            "color": colors[3]
        }
        ]
    }];
  
    var testCasesData = [];
    var testPassedCasesData = [];
    var testCompletionData = [];
    var testFailedData = [];
    var testPriorityData = [];
    // var employeeDiversityData = [];
    // var employeeIpsData = [];
    // var employeeDollarsData = [];
    for (var i = 0; i < testData.length; i++) {
        var dataPoint = testData[i];
        for (var y in dataPoint.testCases) {
            testCasesData.push({
                "Billing": dataPoint.testCases[y].Cases,
                "Value": dataPoint.testCases[y].Value,
                "color": dataPoint.testCases[y].color
            });
        }
        for (var y in dataPoint.passedCases) {
            var hasMatch = false;
            for (var index = 0; index < testPassedCasesData.length; ++index) 
            {
                if(testPassedCasesData[index].Type === dataPoint.passedCases[y].Type)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                testPassedCasesData[foundIndex].Value += dataPoint.passedCases[y].Value;
            }
            else
            {
                testPassedCasesData.push({
                    "Type": dataPoint.passedCase[y].Type,
                    "Value": dataPoint.passedCase[y].Value,
                    "color": dataPoint.passedCase[y].color
                });
            }
        }
        for (var y in dataPoint.Completion) {
            var hasMatch = false;
            for (var index = 0; index < testCompletionData.length; ++index) 
            {
                if(testCompletionData[index].Status === dataPoint.Completion[y].Status)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                testCompletionData[foundIndex].Value += dataPoint.Completion[y].Value;
            }
            else
            {
                testCompletionData.push({
                    "Status": dataPoint.Completion[y].Status,
                    "Value": dataPoint.Completion[y].Value
                });
            }
        }
        for (var y in dataPoint.Failed) {
            var hasMatch = false;
            for (var index = 0; index < testFailedData.length; ++index) 
            {
                if(testFailedData[index].Defect === dataPoint.Failed[y].Defect)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                testFailedData[foundIndex].Value += dataPoint.Failed[y].Value;
                
            }
            else
            {
                testFailedData.push({
                    "Defect": dataPoint.Failed[y].Defect,
                    "Value": dataPoint.Failed[y].Value,
                    "color": dataPoint.Failed[y].color,
                });
            }
        }
        for (var y in dataPoint.Priority) {
            var hasMatch = false;
            for (var index = 0; index < testPriorityData.length; ++index) 
            {
                if(testPriorityData[index].defectPriority === dataPoint.Priority[y].defectPriority)
                {
                    hasMatch = true;
                    var foundIndex = index;
                    break;
                }
            }
            if(hasMatch)
            {
                testPriorityData[foundIndex].Value += dataPoint.Priority[y].Value;
                
            }
            else
            {
                testPriorityData.push({
                    "defectPriority": dataPoint.Priority[y].defectPriority,
                    "Value": dataPoint.Priority[y].Value,
                    "color": dataPoint.Priority[y].color,
                });
            }
        }
    
    // var chart_employee_Billability = AmCharts.makeChart("employee_Billability", {
    //     "theme": "light",
    //     "type": "serial",
    //     "startDuration": 2,
    //     "dataProvider": employeeBillingData,
    //     "valueAxes": [{
    //         "position": "left",
    //         "title": "Employees"
    //     }],
    //     "graphs": [{
    //         "balloonText": "[[category]]: <b>[[value]]</b>",
    //         "fillColorsField": "color",
    //         "fillAlphas": 1,
    //         "lineAlpha": 0.1,
    //         "type": "column",
    //         "valueField": "Value"
    //     }],
    //     "depth3D": 20,
    //     "angle": 30,
    //     "chartCursor": {
    //         "categoryBalloonEnabled": false,
    //         "cursorAlpha": 0,
    //         "zoomable": false
    //     },
    //     "categoryField": "Billing",
    //     "categoryAxis": {
    //         "gridPosition": "start"
    //     },
    //     "export": {
    //         "enabled": true
    //     }
    // });
    
    // var chart_employee_Presales = AmCharts.makeChart("employee_Presales", {
    //     "type": "pie",
    //     "theme": "light",
    //     "colors": colors,
    //     "dataProvider": employeePresalesData,
    //     "titleField": "Type",
    //     "valueField": "Value",
    //     "labelRadius": 5,
    //     "radius": "42%",
    //     "innerRadius": "60%",
    //     "labelText": "[[title]]",
    //     "legend": {
    //         "maxColumns": 3,
    //         "divId": "legend_employee_Presales",
    //         "position": "center"
    //     },
    //     "export": {
    //       "enabled": true
    //     }
    // } );
    // 9
    // var chart_employee_Techs = AmCharts.makeChart("employee_Techs", {
    //     "theme": "light",
    //     "type": "serial",
    //     "startDuration": 2,
    //     "dataProvider": employeeTechData,
    //     "valueAxes": [{
    //         "position": "left",
    //         "title": "Employees"
    //     }],
    //     "graphs": [{
    //         "balloonText": "[[category]]: <b>[[value]]</b>",
    //         "fillColorsField": "color",
    //         "fillAlphas": 1,
    //         "lineAlpha": 0.1,
    //         "type": "column",
    //         "valueField": "Value"
    //     }],
    //     "depth3D": 20,
    //         "angle": 30,
    //     "chartCursor": {
    //         "categoryBalloonEnabled": false,
    //         "cursorAlpha": 0,
    //         "zoomable": false
    //     },
    //     "categoryField": "Technology",
    //     "categoryAxis": {
    //         "gridPosition": "start"
    //     },
    //     "export": {
    //         "enabled": true
    //      }
    // });
    
    // var chart_employee_Visa = AmCharts.makeChart( "employee_Visa", {
    //     "type": "pie",
    //     "theme": "light",
    //     "colors": colors,
    //     "dataProvider": employeeVisaData,
    //     "titleField": "Country",
    //     "valueField": "Value",
    //     "labelRadius": 5,
    //     "radius": "42%",
    //     "innerRadius": "60%",
    //     "labelText": "[[title]]",
    //     "legend": {
    //         "maxColumns": 3,
    //         "divId": "legend_employee_Visa",
    //         "position": "center"
    //     },
    //     "export": {
    //       "enabled": true
    //     }
    // } );
    
    // var chart_employee_Account = AmCharts.makeChart("employee_Account", {
    //     "theme": "light",
    //     "type": "serial",
    //     "startDuration": 2,
    //     "dataProvider": employeeAccountData,
    //     "valueAxes": [{
    //         "position": "left",
    //         "title": "Employees"
    //     }],
    //     "graphs": [{
    //         "balloonText": "[[category]]: <b>[[value]]</b>",
    //         "fillColorsField": "color",
    //         "fillAlphas": 0.85,
    //         "lineAlpha": 0.1,
    //         "type": "column",
    //         "topRadius":1,
    //         "valueField": "Value"
    //     }],
    //     "depth3D": 40,
    //     "angle": 30,
    //     "chartCursor": {
    //         "categoryBalloonEnabled": false,
    //         "cursorAlpha": 0,
    //         "zoomable": false
    //     },
    //     "categoryField": "Account",
    //     "categoryAxis": {
    //         "gridPosition": "start",
    //         "axisAlpha":0,
    //         "gridAlpha":0
    //     },
    //     "export": {
    //         "enabled": true
    //     }
    // }, 0);
    
    // var chart_employee_Diversity = AmCharts.makeChart( "employee_Diversity", {
    //     "type": "pie",
    //     "theme": "light",
    //     "colors": colors,
    //     "dataProvider": employeeDiversityData,
    //     "titleField": "Gender",
    //     "valueField": "Count",
    //     "labelRadius": 5,
    //     "radius": "42%",
    //     "innerRadius": "60%",
    //     "labelText": "[[title]]",
    //     "legend": {
    //         "maxColumns": 3,
    //         "divId": "legend_employee_Diversity",
    //         "position": "center"
    //     },
    //     "export": {
    //       "enabled": true
    //     }
    // } );
    
    // var chart_employee_Ips = AmCharts.makeChart("employee_Ips", {
    //     "theme": "light",
    //     "type": "serial",
    //     "startDuration": 2,
    //     "dataProvider": employeeIpsData,
    //     "valueAxes": [{
    //         "position": "left",
    //         "title": "Employees"
    //     }],
    //     "graphs": [{
    //         "balloonText": "[[category]]: <b>[[value]]</b>",
    //         "fillColorsField": "color",
    //         "fillAlphas": 0.85,
    //         "lineAlpha": 0.1,
    //         "type": "column",
    //         "topRadius":1,
    //         "valueField": "Count"
    //     }],
    //     "depth3D": 40,
    //     "angle": 30,
    //     "chartCursor": {
    //         "categoryBalloonEnabled": false,
    //         "cursorAlpha": 0,
    //         "zoomable": false
    //     },
    //     "categoryField": "Ip",
    //     "categoryAxis": {
    //         "gridPosition": "start",
    //         "axisAlpha":0,
    //         "gridAlpha":0
    //     },
    //     "export": {
    //         "enabled": true
    //     }
    // }, 0);
    
    // var chart_employee_Dollars = AmCharts.makeChart( "employee_Dollars", {
    //     "type": "pie",
    //     "theme": "light",
    //     "colors": colors,
    //     "dataProvider": employeeDollarsData,
    //     "titleField": "Account",
    //     "valueField": "Dollars",
    //     "labelRadius": 5,
    //     "radius": "42%",
    //     "innerRadius": "60%",
    //     "labelText": "[[title]]",
    //     "balloonText": "[[title]]: [[percents]]% ($[[value]])",
    //     "legend": {
    //         "maxColumns": 3,
    //         "divId": "legend_employee_Dollars",
    //         "position": "center"
    //     },
    //     "export": {
    //       "enabled": true
    //     }
    // } );
    
    chart_test_cases.addListener("clickGraphItem", function (event) {
        onClickCases(event.item.dataContext.Cases);
    });
    
    chart_passed_Cases.addListener("pullOutSlice", function (event) {
        onClickPassedCases(event.dataItem.dataContext.Type);
    });
    
    chart_Completion.addListener("clickGraphItem", function (event) {
        onClickCompletion(event.item.dataContext.Status);
    });
    
    chart_Failed.addListener("pullOutSlice", function (event) {
        onClickFailed(event.dataItem.dataContext.Defect);
    });
    
    chart_Priority.addListener("clickGraphItem", function (event) {
        onClickPriority(event.item.dataContext.defectPriority);
    });
    
    function onClickCases(value)
    {
    
        var testPassedCasesData = [];
        var testCompletionData = [];
        var testFailedData = [];
        var testPriorityData = [];
        for (var i = 0; i < testData.length; i++) {
            var dataPoint = testData[i];
            for (var y in dataPoint.testCases) {
                if(dataPoint.testCases[y].cases === value)
                {
                    testPassedCasesData.push({
                        "Type": dataPoint.passedCases[y].Type,
                        "Value": dataPoint.passedCases[y].Value,
                        "color": dataPoint.passedCases[y].color
                    });
                    testCompletionData.push({
                        "Status": dataPoint.Completion[y].Status,
                        "Value": dataPoint.Completion[y].Value
                    });
                    testFailedData.push({
                        "Country": dataPoint.Failed[y].Defect,
                        "Value": dataPoint.Failed[y].Defect
                    });
                    testPriorityData.push({
                        "Account": dataPoint.Priority[y].defectPriority,
                        "Value": dataPoint.Priority[y].Value,
                        "color": dataPoint.Priority[y].color
                    });
                }
            }
        }
        chart_passed_Cases.dataProvider = testPassedCasesData;
        chart_passed_Cases.validateData();
        chart_passed_Cases.animateAgain();
        chart_Completion.dataProvider = testCompletionData;
        chart_Completion.validateData();
        chart_Completion.animateAgain();
        chart_Failed.dataProvider = testFailedData;
        chart_Failed.validateData();
        chart_Failed.animateAgain();
        chart_Priority.dataProvider = testPriorityData;
        chart_Priority.validateData();
        chart_Priority.animateAgain();
        document.getElementById("phasediv1").style.display = "none";
        var node = document.createElement("LI");
        var aTag = document.createElement('a');
            aTag.setAttribute('href',"#");
            aTag.setAttribute('class',"tag");
            aTag.innerHTML = "Test Case: " + value;

        // Have to ask for this id myList and the phsediv1 used above 

        // node.appendChild(aTag);
        // if(document.getElementById("myList").style.display === "none")
        // {
        //     document.getElementById("myList").style.display = "block";
        // }
        // document.getElementById("myList").appendChild(node);
        // document.getElementById('myList').scrollIntoView();
    }
    
    function onClickPassedCases(value)
    {
        var testCasesData = [];
        var testCompletionData = [];
        var testFailedData = [];
        var testPriorityData = [];
        for (var i = 0; i < testData.length; i++) {
            var dataPoint = testData[i];
            for (var y in dataPoint.passedCases) {
                if(dataPoint.passedCases[y].Type === value)
                {
                    testCasesData.push({
                        "Cases": dataPoint.testCases[y].Cases,
                        "Value": dataPoint.testCases[y].Value,
                        "color": dataPoint.testCases[y].color
                    });
                    testCompletionData.push({
                        "Status": dataPoint.Completion[y].Status,
                        "Value": dataPoint.Completion[y].Value,
                        "color": dataPoint.Completion[y].color
                    });
                    testFailedData.push({
                        "Defect": dataPoint.Failed[y].Defect,
                        "Value": dataPoint.Failed[y].Value,
                        "Value": dataPoint.Failed[y].color
                    });
                    testPriorityData.push({
                        "Account": dataPoint.Priority[y].defectPriority,
                        "Value": dataPoint.Priority[y].Value,
                        "color": dataPoint.Priority[y].color
                    });
                }
            }
        }
        chart_test_Cases.dataProvider = testCasesData;
        chart_test_Cases.validateData();
        chart_test_Cases.animateAgain();
        chart_Completion.dataProvider = testCompletionData;
        chart_Completion.validateData();
        chart_Completion.animateAgain();
        chart_Failed.dataProvider = testFailedData;
        chart_Failed.validateData();
        chart_Failed.animateAgain();
        chart_Priority.dataProvider = testPriorityData;
        chart_Priority.validateData();
        chart_Priority.animateAgain();

        document.getElementById("pfbdiv").style.display = "none";
        var node = document.createElement("LI");
        var aTag = document.createElement('a');
            aTag.setAttribute('href',"#");
            aTag.setAttribute('class',"tag");
            aTag.innerHTML = "Passed Cases : " + value;
        node.appendChild(aTag);
        if(document.getElementById("myList").style.display === "none")
        {
            document.getElementById("myList").style.display = "block";
        }
        document.getElementById("myList").appendChild(node);
        document.getElementById('myList').scrollIntoView();
    }
    
    function onClickCompletion(value)
    {
        var testCasesData = [];
        var testPassedCasesData = [];
        var testFailedData = [];
        var testPriorityData = [];
        for (var i = 0; i < testData.length; i++) {
            var dataPoint = testData[i];
            for (var y in dataPoint.Completion) {
                if(dataPoint.Completion[y].Status === value)
                {
                    testCasesData.push({
                        "Cases": dataPoint.testCases[y].Cases,
                        "Value": dataPoint.testCases[y].Value,
                        "color": dataPoint.testCases[y].color
                    });
                    testPassedCasesData.push({
                        "Type": dataPoint.passedCases[y].Type,
                        "Value": dataPoint.passedCases[y].Value,
                        "color": dataPoint.passedCases[y].color
                    });
                    testFailedData.push({
                        "Country": dataPoint.Failed[y].Defect,
                        "Value": dataPoint.Failed[y].Value,
                        "color": dataPoint.Failed[y].color
                    });
                    testPriorityData.push({
                        "Account": dataPoint.Priority[y].defectPriority,
                        "Value": dataPoint.Priority[y].Value,
                        "color": dataPoint.Priority[y].color
                    });
                }
            }
        }
        chart_test_Cases.dataProvider = testCasesData;
        chart_test_Cases.validateData();
        chart_test_Cases.animateAgain();
        chart_passed_Cases.dataProvider = testPassedCasesData;
        chart_passed_Cases.validateData();
        chart_passed_Cases.animateAgain();
        chart_Failed.dataProvider = testFailedData;
        chart_Failed.validateData();
        chart_Failed.animateAgain();
        chart_Priority.dataProvider = testPriorityData;
        chart_Priority.validateData();
        chart_Priority.animateAgain();

        document.getElementById("statuschart").style.display = "none";
        var node = document.createElement("LI");
        var aTag = document.createElement('a');
            aTag.setAttribute('href',"#");
            aTag.setAttribute('class',"tag");
            aTag.innerHTML = "Completion Status : " + value;
        node.appendChild(aTag);
        if(document.getElementById("myList").style.display === "none")
        {
            document.getElementById("myList").style.display = "block";
        }
        document.getElementById("myList").appendChild(node);
        document.getElementById('myList').scrollIntoView();
    }
    
    function onClickFailed(value)
    {
        var testCasesData = [];
        var testPassedCasesData = [];
        var testCompletionData = [];
        var testPriorityData = [];


        for (var i = 0; i < testData.length; i++) {
            var dataPoint = testData[i];
            for (var y in dataPoint.Failed) {
                if(dataPoint.Failed[y].Defect === value)
                {
                    testCasesData.push({
                        "Cases": dataPoint.testCases[y].Cases,
                        "Value": dataPoint.testCases[y].Value,
                        "color": dataPoint.testCases[y].color
                    });
                    testPassedCasesData.push({
                        "Type": dataPoint.passedCases[y].Type,
                        "Value": dataPoint.passedCases[y].Value,
                        "color": dataPoint.passedCases[y].color
                    });
                    testCompletionData.push({
                        "Status": dataPoint.Completion[y].Status,
                        "Value": dataPoint.Completion[y].Value,
                        "color": dataPoint.Completion[y].color
                    });
                    testPriorityData.push({
                        "Account": dataPoint.Priority[y].defectPriority,
                        "Value": dataPoint.Priority[y].Value,
                        "color": dataPoint.Priority[y].color
                    });
                }
            }
        }
        chart_test_Cases.dataProvider = testCasesData;
        chart_test_Cases.validateData();
        chart_test_Cases.animateAgain();
        chart_passed_Cases.dataProvider = testPassedCasesData;
        chart_passed_Cases.validateData();
        chart_passed_Cases.animateAgain();
        chart_Completion.dataProvider = testCompletionData;
        chart_Completion.validateData();
        chart_Completion.animateAgain();
        chart_Priority.dataProvider = testPriorityData;
        chart_Priority.validateData();
        chart_Priority.animateAgain();



        document.getElementById("purdefect").style.display = "none";
        var node = document.createElement("LI");
        var aTag = document.createElement('a');
            aTag.setAttribute('href',"#");
            aTag.setAttribute('class',"tag");
            aTag.innerHTML = "Defects : " + value;
        node.appendChild(aTag);
        if(document.getElementById("myList").style.display === "none")
        {
            document.getElementById("myList").style.display = "block";
        }
        document.getElementById("myList").appendChild(node);
        document.getElementById('myList').scrollIntoView();
    }
    
    function onClickPriority(value)
    {
        var testCasesData = [];
        var testPassedCasesData = [];
        var testCompletionData = [];
        var testFailedData = [];
        for (var i = 0; i < testData.length; i++) {
            var dataPoint = testData[i];
            for (var y in dataPoint.Priority) {
                if(dataPoint.Priority[y].defectPriority === value)
                {
                    testCasesData.push({
                        "Billing": dataPoint.testCases[y].Cases,
                        "Value": dataPoint.testCases[y].Value,
                        "color": dataPoint.testCases[y].color
                    });
                    testPassedCasesData.push({
                        "Type": dataPoint.passedCases[y].Type,
                        "Value": dataPoint.passedCases[y].Value,
                        "color": dataPoint.passedCases[y].color
                    });
                    testCompletionData.push({
                        "Status": dataPoint.Completion[y].Status,
                        "Value": dataPoint.Completion[y].Value,
                        "color": dataPoint.Completion[y].color
                    });
                    testFailedData.push({
                        "Account": dataPoint.Failed[y].Defect,
                        "Value": dataPoint.Failed[y].Value,
                        "color": dataPoint.Failed[y].color
                    });
                }
            }
        }
      chart_test_Cases.dataProvider = testCasesData;
        chart_test_Cases.validateData();
        chart_test_Cases.animateAgain();
        chart_passed_Cases.dataProvider = testPassedCasesData;
        chart_passed_Cases.validateData();
        chart_passed_Cases.animateAgain();
        chart_Completion.dataProvider = testCompletionData;
        chart_Completion.validateData();
        chart_Completion.animateAgain();
        chart_Failed.dataProvider = testFailedData;
        chart_Failed.validateData();
        chart_Failed.animateAgain();

        document.getElementById("priority").style.display = "none";
        var node = document.createElement("LI");
        var aTag = document.createElement('a');
            aTag.setAttribute('href',"#");
            aTag.setAttribute('class',"tag");
            aTag.innerHTML = "Defect Priority : " + value;
        node.appendChild(aTag);
        if(document.getElementById("myList").style.display === "none")
        {
            document.getElementById("myList").style.display = "block";
        }
        document.getElementById("myList").appendChild(node);
        document.getElementById('myList').scrollIntoView();
    }
    
</script>