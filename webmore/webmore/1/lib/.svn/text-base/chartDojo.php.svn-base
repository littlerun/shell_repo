<?php
    include_once '/header.html';    //Include the pulbic header.

?>
<script>

makeObjects = function()
{
    var arr = [1000, 276, 370, 500, 290, 1000, 750, 1100];
    var chart = new dojox.charting.Chart2D("test");
    chart.addAxis("x", {fixLower: "major", fixUpper: "major"});
    chart.addAxis("y", {vertical: true, fixLower: "major",
                        fixUpper: "minor", includeZero: true});
    chart.addPlot("default", {type: "StackedLines", markers: true,
                              shadows: {dx: 2, dy: 2, dw: 2}});
    chart.addSeries("My Values", arr, {stroke: {color: "blue",
                     width: 2}, fill: "white", marker: "m-3,0 c0,-46,-4 6,0 m-6,0 c0,4 6,4 6,0"});
    chart.render();

    function update()
    {
        var newseries = [];
        for(var i = 0; i < 8; i++)

        {
            var id = i+1;
            id = "v"+id;
            var x = dojo.byId(id).value;
            newseries.push(x);
        }
        chart.updateSeries("My Values", newseries);
        chart.render();
    }

    dojo.connect(dojo.byId("button"), "onclick", update);
};
dojo.addOnLoad(makeObjects);
</script>
</head>
<body>
<h1>Diagram</h1>
<br/>
<div id="test" style="width: 760px; height: 250px;"></div>
<div style="margin-left:50px;">
<input type="text" id="v1" size="8" value="1000"/>
<input type="text" id="v2" size="8" value="276"/>
<input type="text" id="v3" size="8" value="370"/>
<input type="text" id="v4" size="8" value="500"/>
<input type="text" id="v5" size="8" value="290"/>
<input type="text" id="v6" size="8" value="1000"/>
<input type="text" id="v7" size="8" value="750"/>
<input type="text" id="v8" size="8" value="1100"/>
<button id="button">Update</button>
</div>
