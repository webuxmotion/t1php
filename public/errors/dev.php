<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Error for developers</title>

<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="/errors/css/style.css" />

<style>
td {
  padding: 5px 10px;
}
</style>


<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
<div id="notfound">
<div class="notfound">
<div class="notfound-404">
<h1>Err<span></span>r</h1>
</div>
<h2>Hi, Developer!</h2>
<p>It is a little problem here:</p>
<table style="margin: 0 auto;text-align: left;">
<tr>
  <td>Exception</td>
  <td><?=$errno?></td>
</tr>
<tr>
  <td>String</td>
  <td><?=$errstr?></td>
</tr>
<tr>
  <td>File</td>
  <td><?=$errfile?></td>
</tr>
<tr>
  <td>Line</td>
  <td><?=$errline?></td>
</tr>
</table>
</div>
</div>

</html>
