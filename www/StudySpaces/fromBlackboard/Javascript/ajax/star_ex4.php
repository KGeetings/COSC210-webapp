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
		for (var i=1; i < parseInt(a); i++) {
			$('#'+ i.toString()).attr("src","images/goldstar50.png");
		}
	},
	function() {
		$(this).attr("src","images/graystar50.png");
		var a = $(this).attr('id');
		for (var i=1; i < parseInt(a); i++) {
			$('#'+ i.toString()).attr("src","images/graystar50.png");
		}
	}); //end hover

 $('img').click(function(){
	var num = $(this).attr('id');
	var querystring = "rating="+num;
	$.post('process_rating.php',querystring,processResponse);

  }); // end click

}); // end ready

function processResponse(data) {
	var newHTML;
	newHTML = '<h2>Your rating was counted</h2>';
	newHTML += '<p>My rating for this is ';
	newHTML += data + '.</p>';
	$('#message').html(newHTML);
	}

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
	<p id="message"></p>
    </div>
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
