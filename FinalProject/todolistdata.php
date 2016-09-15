<?php
	/* 

		This page displays a user's todo list statistics 
	*/
	
	include("common.php");
	session_start();
	if (!isset($_SESSION["name"])) {
		header("Location: start.php");
	}
	
	top();
?>

<div id="Links">
			<a href="todolist.php">Task View</a>
			<a href="todolistdata.php">Data View</a>
			<a href="todolistgame.php">Game View</a>
		</div>
		<h2><?=trim($_SESSION["name"])?>'s Productivity Point History </h2>
<style>

.bar {
  fill: steelblue;
}

.bar:hover {
  fill: brown;
}

.axis {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.x.axis path {
  display: none;
}

</style>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script>

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(10);

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.tsv("data_<?=$_SESSION[name]?>.tsv", type, function(error, data) {
  x.domain(data.map(function(d) { return d.day; }));
  y.domain([0, d3.max(data, function(d) { return d.productivity; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Productivity Points (PP)");

  svg.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.day); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.productivity); })
      .attr("height", function(d) { return height - y(d.productivity); });

});

function type(d) {
  d.productivity = +d.productivity;
  return d;
}

</script>
