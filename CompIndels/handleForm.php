<!DOCTYPE html>

<html>

<head>
	<title>Home</title>
	<style>
	p.big {line-height:140%;}
	div#main{
		padding: 30px 40px;
		background: #FFFFFF;
		border-radius:25px;
		box-shadow: 10px 10px 5px #888888;
	}
	#loading {
		display: block;
		
		z-index: 99;
		text-align: center;
	}
	#loading-image {
		padding: 30px 40px;
		background: #FFFFFF;
		border-radius:25px;
		box-shadow: 10px 10px 5px #888888;
		margin-left: auto;
		margin-right: auto;
		z-index: 100;
	}
	</style>
</head>

<body bgcolor="#C0C0C0">

<center><div id="main" style="width:800px">
<table cellspacing="4" cellpadding="4" align="center">
	<tr>
	<td><img src="DNA1.jpg" alt="A strand of DNA" width="250" height="125" /></td>
	<td><font size="30">CompIndel</font></td>
	<td><img src="DNA3.png" alt="A strand of DNA" width="250" height="125" /></td>
	</tr>
	<tr>
		<center><table cellspacing="4" cellpadding="4"><tr><td width="50">
		<a href="index.php" style="text-decoration: none"><b><font size="4">Home</font></b></a>
		</td>
		<td width="50">
		<a href="about.html" style="text-decoration: none"><b><font size="4">About</font></b></a>
		</td>
		<td width="50">
		<a href="species.html" style="text-decoration: none"><b><font size="4">Species</font></b></a>
		</td>
		<td width="50">
		<a href="contact.html" style="text-decoration: none"><b><font size="4">Contact</font></b></a>
		</td></tr></td></center>
	<tr></table></div></center>

<?php 		

	if (isset($_POST['submit'])) {	
		
		$query = "";

		if (isset($_POST['chromosome'])) {
			$chromosome = $_POST['chromosome'];
			$query1 = $chromosome;
		} else {
			$query1 = "1";
		}

		if (!empty($_POST['range1'])) {
			$range1 = $_POST['range1'];
		} else {
			$range1 = 0;
		}

		if (!empty($_POST['range2'])) {
			$range2 = $_POST['range2'];
		} else {
			$range2 = 250000000;
		}

		if (!empty($_POST['email'])) {
			if (!eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", stripslashes(trim($_POST['email'])))) {
				$problem = TRUE;
				echo '<br /><br /><center><div id="main" style="width:600px"><p class="big">Please enter a <b>valid</b> email address on the previous page if you would like to recieve the complete set of the query results. Only 100 rows will be displayed below.</p></div></center>';
			} else {
				$email = TRUE;
			}
		} else{
			$email = FALSE;
			echo '<br /><br /><center><div id="main" style="width:600px"><p>Please enter an email address on the previous page if you would like to recieve the complete set of the query results. Only 100 rows will be displayed below.</p></div></center>';
		}

		// creating query string
		$query = "SELECT * FROM hg19chr".$query1.", alignment".$query1." WHERE hg19chr".$query1.".humanpos BETWEEN ".$range1." AND ".$range2." AND hg19chr".$query1.".alignment = alignment".$query1.".count order by hg19chr".$query1.".humanpos;";
	
		require_once('../mysql_connect.php');
		$result = @mysql_query($query);
		$number = mysql_num_rows($result);
		if ($result) {	
			echo 'Is this working?';

			$output = "<br /><br /><center><div id=\"main\"><p align=\"left\"><b>Query:</b> ".$query." <br /><br />There are <b>".$number."</b> mutations.</p>
			<table align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" >
			<tr>
			<td align=\"left\">Species</td>
			<td align=\"left\">Chromosome</td>
			<td align=\"left\">Strand</td>
			<td align=\"left\">Sequence</td>
			</tr><hr />";
			
			$num = 0;
			while ($row = mysql_fetch_array($result,MYSQL_NUM) and $num<99) {
				// get rid of the "-1" below to add the sequences again
				$length = count($row) - 1;
				$rowColor = 0;
				$seqs = explode(":", $row[36]);
				$refSeq = $seqs[0];
				$output .= "	<tr bgcolor='#FFFFFF'>
					<td align=\"left\">".$row[0]."</td>
					<td align=\"left\">".$row[1]."</td>
					<td align=\"left\">".$row[2]."</td>
					<td align=\"left\">".$refSeq."</td>
					</tr>";
				echo "<center><div id=\"main\"><table><tr>
					<td align=\"left\">".$row[0]."</td>
					<td align=\"left\">".$row[1]."</td>
					<td align=\"left\">".$row[2]."</td>
					<td align=\"left\">".$row[3]."</td></tr>";
				$i = 3;
				$j = 1;
				while ($i < $length){
					if ($row[$i] != '0' and $i != 33 and $i != 34 and $i != 35) {
						$output .= "<tr bgcolor='#E0E0E0'><td align=\"left\">".$row[$i]."</td>";
						$i++;
						$output .= "<td align=\"left\">".$row[$i]."</td>";
						$i++;

						$param1 = $seqs[$j];
						$command="/~jobrooker/public-html/CompIndels/ unpack.py ".$param1;
						$buffer='';
						on_start();
						passthru($command);
						$buffer=ob_get_contents();
						ob_end_clean();

						$output .= "<td align=\"left\">".$row[$i]."</td>
						<td align=\"left\">".$buffer."</td></tr>";
						$j++;
					}
					$i++;
				}
				$num++;
			}
			echo "</table></div></center>";

			$output .= "</table></div></center>";
			echo $output;
			if ($email) {
				$headers = 'MIME-Version: 1.0'."\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
				$headers .= 'From: CompIndel <jrdnbrkr@gmail.com>'."\r\n";
				mail($_POST['email'],'Results!', $output, $headers);
			}
			mysql_free_result ($result);
		
		} else { 
			echo " Something didn't work!<br />".$query;
		}
		mysql_close();
		
	} else {
		echo "Something didn't work! <br />".$query;
}
?>

<center><p>&copy; 2014 Jordan Brooker | Contact at jrdnbrkr@gmail.com</p></center>

</body>

</html>
