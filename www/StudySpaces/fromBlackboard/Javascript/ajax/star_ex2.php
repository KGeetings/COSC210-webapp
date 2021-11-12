<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>A 5 star review example</title>
<link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">
<style>
ul {
	display: inline-block;
	list-style-type: none;
	background-color: gray;
	}
ul li {
	float: left;
}
</style>
<script src="js/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
 $('img')
	.hover(function() {
		$(this).attr("src","images/goldstar50.png");
		var a = $(this).attr('id');
		$('#panel').css('background-image','linear-gradient(90deg, yellow '+(parseFloat(a)/5*100)+'%, gray)');
	},
	function() {
		$(this).attr("src","images/reversestar.png");
	});
}); // end ready
</script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="twelve columns">
	<p class="logo">COSC 210 Database and the Web</p>
	  </div>
	</div>
   </div>
  <div class="container">
    <div class="row">
      <div class="twelve columns">
	<h1>Review Star Example</h1>
	<ul id="panel">
		<li><span><img src="images/reversestar.png" id='1'></span></li>
		<li><span><img src="images/reversestar.png" id='2'></span></li>
		<li><span><img src="images/reversestar.png" id='3'></span></li>
		<li><span><img src="images/reversestar.png" id='4'></span></li>
		<li><span><img src="images/reversestar.png" id='5'></span></li>
	</ul>
	  </div>
	</div>
   <div class="container">
  	<div class="row">
      <div class="twelve columns">
      	<p id="footer">Examples by me</p>
      </div>
  	</div>
   </div>

</body>
</html>
