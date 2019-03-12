<link href="https://fonts.googleapis.com/css?family=Exo|Ubuntu+Condensed" rel="stylesheet">
<style>
body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  background-image: url(Images/policebackground.png);
  background-position: center;
  background-repeat:no-repeat;
  background-size: cover;
}
.title {
	color: #FFFFFF;
	font-size: 50px;
    text-shadow: 2px 2px #000BFF;
	font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", "monospace";
}
.logo {
	width: 450px;
	height: 220px;
	margin-top: -35px ;
}
.sggov
	{
		width: 350px;
		height: 70px;
		margin-top: 45px;
		margin-right: 20px;
		float: right;
	}
.spacer{
	margin-top: 17px;	
	}
* {box-sizing: border-box}

.navbar {
  width: 100%;
  background-color: #ACA7A7;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: #2AF5F7;
  font-family: 'Exo', sans-serif;
  text-decoration: none;
  font-size: 25px;
  width: 25%; /* Four links of equal widths */
  text-align: center;
  border: 2px solid white;
}

.navbar a:hover {
  background-color: #C43133;
}



@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
    width: 100%;
    text-align: left;

  }
}
</style>
	<img class="logo" src="Images/policefull.png" alt="Police Logo">
	<img class="sggov logo" src="Images/sggov.png" alt="SGGOV">
<marquee><h1 class="title spacer">Police Emergency Service System</h1></marquee>
<div class="navbar">
  <a href="logcall.php">Log Call</a> 
  <a href="update.php">Update</a> 
  <a href="signin.php">Sign In</a> 
  <a href="signout.php">Sign Out</a>
</div>

