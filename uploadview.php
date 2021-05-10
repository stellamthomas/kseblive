<?php
$key= "43628b7b";
$ret = "57StellaCryptography.pdf";
  $path="Uploads/".$key."/".$ret;

?>
<!DOCTYPE html>
<html>
<head>
	<title>View News</title>
</head>
<body>
<h4 align="center" >Call Letter</h4><br>
	<form action="viewfile.php" method="post">
		<table class="table table-bordered">
			<tr>

			<tr>
			<tr>
				<td align="center"><a target="_blank" href="<?php echo $path; ?>">Download Call Letter</a></td>
			</tr>
		</table>
	</form>
</body>
</html>
