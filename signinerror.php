<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign</title>
<?php include "header.php" ?>
<style>
		h1{
			 color: black;
			 font-family: 'Patrick Hand', cursive;
			 font-size: 60px;
			 text-shadow: 1px 1px white;
			 text-align: center;
		}
		a.button5{
			 display:inline-block;
			 padding:1em 3em;
			 border:0.1em solid #000000;
			 margin:0 0.2em 0.2em 0;
			 border-radius:0.12em;
			 box-sizing: border-box;
			 text-decoration:none;
			 font-family:'Roboto',sans-serif;
			 font-weight:300;
			 color:#000000;
			 text-shadow: 0 0.04em 0.04em rgba(0,0,0,0.35);
			 background-color:#FFFFFF;
			 text-align:center;
			 transition: all 0.15s;
		}
		a.button5:hover{
			 text-shadow: 0 0 2em rgba(255,255,255,1);
			 color:#FFFFFF;
			 border-color:#FFFFFF;
		}
			 @media all and (max-width:30em){
		a.button5{
			 display:block;
			 margin:0.4em auto;
		 }
		}
	</style>
</head>

<body>
	<h1>Invalid User!</h1>
	<div align="center">
		<a href="signin.php" class="button5" style="background-color:#EB1818; color: white;">SIGN IN</a>
</div>
</body>
</html>
