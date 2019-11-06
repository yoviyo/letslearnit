<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Begi Hotel - Добре дошли</title>
 
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/foundation.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/datepicker.css">
<link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="sunhotel/css/styles.css">
<link rel="stylesheet" media="screen and (max-width: 768px)" href="sunhotel/css/mobile.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script>
  $(document).ready(function() {
		$("#checkout").datepicker();
		$("#checkin").datepicker({
		minDate : new Date(),
		onSelect: function (dateText, inst) {
        var date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);
        $("#checkout").datepicker("option", "minDate", date);
		}
		});
  });
</script>
</head>
<body class="fontbody" style="background-image : url(img/background.jpg); no-repeat center center fixed; background-size: cover;">

    <header>
        <nav id="navbar">
            <div class="container header-wrapper">
                <h1 class="logo"><a href="sunhotel/index.html"><img src="sunhotel/img/logo.png"></a></h1>
                <ul>
                    <li><a  href="sunhotel/index.html">Начало</a></li>
                    <li><a href="sunhotel/rooms.html">Настаняване</a></li>
                    <li><a class="active" href="index.php">Резервация</a></li>
                    <li><a href="sunhotel/about.html">За хотела</a></li>
                    <li><a href="sunhotel/contact.html">Контакти</a></li>
                </ul>
            </div>
        </nav>
    </header> 
<div class="row margintop">
	<div class="large-4 columns blackblur fontcolor" style="padding-top:10px; width: 100%;">
	
	<div class="large-12 columns " >
	<p class="shrift"><b>Въведете информация за вашия престой</b></p><hr class="line">
			<form name="form" action="checkroom.php" method="post" onSubmit="return validateForm(this);">
			<div class="row">
				
					<div class="large-6 columns" style="max-width:100%;">
						<label class="fontcolor shrift1" for="checkin">Настаняване
							<input name="checkin" id="checkin" style="width:100%;"/>
						</label>
					</div>
					
					<div class="large-6 columns" style="max-width:100%;">
						<label class="fontcolor shrift1" for="checkout">Напускане
							<input name="checkout" id="checkout" style="width:100%;"/>
						</label>
					</div>
			</div>
					
			<div class="row">
				
					<div class="large-6 columns">
						<label class="fontcolor shrift1">Възрастни
							
								<select  name="totaladults" id="totaladults" style="width:100%;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								</select>
							
						</label>
					</div>
					
					<div class="large-6 columns"  style="max-width:100%;">
						<label class="fontcolor shrift1">Деца
							<select  name="totalchildrens" id="totalchildrens" style="width:100%; color:black;">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							</select>
						</label>
					</div>
			</div>	
			  <div class="row">
				<div class="large-12 columns" >
					<button name="submit" href="#" class="button small fontslabo shrift1" style="background-color:#34bfde; width:100%; margin-top: 10%;" >Търси свободна стая</button>
				</div>
			  </div>
			</form>
	</div>
</div>
</div>
<script>
	function validateForm(form) {
		var a = form.checkin.value;
		var b = form.checkout.value;
		var c = form.totaladults.value;
		var d = form.totalchildrens.value;
			if(a == null || b == null || a == "" || b == "") 
			{
			 alert("Моля изберете дата");
			 return false;
			}
			if(c == 0) 
			{
			 	if(d == 0) 
				{
				 alert("Моля изберете брой гости");
				 return false;
				}
			}
			if(d == 0) 
			{
			 	if(c == 0) 
				{
				 alert("Моля изберете брой гости");
				 return false;
				}
			}

	}
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57205452-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>