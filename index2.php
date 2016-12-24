<?php

        header("Content-Type: text/html; charset=utf-8");



		?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>ChemyApp Android-приложение</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="https://cdn0.iconfinder.com/data/icons/reading/154/title-book-literature-cover-read-512.png" type="image/x-icon">
	<link rel="shortcut icon" href="https://cdn0.iconfinder.com/data/icons/reading/154/title-book-literature-cover-read-512.png" type="image/x-icon">

	<style>
		.header{
			position: fixed;
			width: 100%;
			top: 0px;
			background: #5b5b5b;
			height: 5em;
			z-index: 100;
		}
		.content{
			position: relative;
			top: 5em;
			width: 60%;
			margin-left: auto ;
			margin-right: auto ;
		}
		span{
			font-weight: normal;
		}
		h1{
			font-size: 5em;
			color: #5b5b5b;
		}
		img{
			
		}
		p{
			

		}
		.dis{
			font-size: 2.5em;
			text-align: left;
			color: #5b5b5b;
		}
		.buttonup{
			display: inline-block;
			background: #0932ff;
			color: white;
			text-align: center;
			border-radius: 0.2em;
			font-size: 3em;
			height: 1.1em;
			padding: 0.5em;
			width: 6em;
		}
	</style>

</head>
<body>

<div class="header">

</div>



<div class="content">
<p><h1><span>Chemy</span>App</h1>
		<span class="dis">Обучающее android-приложение "Неорганическая химия".
		</span>
		<br>
	<img src="/css/img/screen.png">
	
<br>
	<a href="/dowland/chemyapp.apk"  class="buttonup"> Загрузить</a>
	</p>



</div>


</body>
</html>
