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
		$('#footer').html("<p>" + a + " was chosen </p>");
		$('#scale').css('background-image','linear-gradient(90deg, yellow '+(parseFloat(a)/5*100)+'%, gray)');
		$('#scale').css('width','125px');
	},
	function() {
		$(this).attr("src","images/graystar50.png");
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
		<li><span><img src="images/graystar50.png" id='1'></span></li>
		<li><span><img src="images/graystar50.png" id='2'></span></li>
		<li><span><img src="images/graystar50.png" id='3'></span></li>
		<li><span><img src="images/graystar50.png" id='4'></span></li>
		<li><span><img src="images/graystar50.png" id='5'></span></li>
	</ul>
	  </div>
	</div>
    <div class="row">
      <div class="twelve columns">
      </div>
	<p id="scale">show stuff</p>
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
