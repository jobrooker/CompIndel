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
<!--<?php 		

	if (isset($_POST['submit'])) {	
		
		
		
		$query = "";

		if (isset($_POST['chromosome'])) {
			$chromosome = $_POST['chromosome'];
			if ($chromosome == 'All') {
				$query1 = "";
			} else {
				$query1 = " AND reference IN ('hg19.$chromosome')";
			}
		} else {
			$query1 = "";
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
				echo '<br /><br /><center><div id="main" style="width:600px"><p>Please enter a <b>valid</b> email address if you would like to recieve the complete set of the query results. Only 100 rows will be displayed below.</p></div></center>';
			} else {
				$email = TRUE;
			}
		} else{
			$email = FALSE;
			echo '<br /><br /><center><div id="main" style="width:600px"><p>Please enter an email address if you would like to recieve the complete set of the query results. Only 100 rows will be displayed below.</p></div></center>';
		}

		// creating query string
		$query = "SELECT hg19chr".$chromosome.".humanchr,hg19chr".$chromosome.".humanpos,hg19chr".$chromosome.".humanstrand,alignment".$chromosome.".alignstr FROM hg19chr".$chromosome.", alignment".$chromosome." WHERE hg19chr".$chromosome.".humanchr BETWEEN ".$range1." AND ".$range2." AND hg19chr".$chromosome.".alignment = alignment".$chromosome.".count;";
		echo $query;

		require_once('../mysql_connect.php');
		$result = @mysql_query($query);
		$num = mysql_num_rows($result);
		if ($result) {
			if ($email) {
				mail($_POST['email'],'Results!', 'Number of results: '.$num, 'From: jrdnbrkr@gmail.com');
			}
			
			echo '<br /><br /><center><div id="main"><p><b>Query:</b> '.$query.' <br /><br />There are <b>'.$num.'</b> mutations.</p>
			<table align="center" border="0" cellspacing="2" cellpadding="2">
			<tr>
			<td align="left">Species</td>
			<td align="left">Chromosome</td>
			<td align="left">Strand</td>
			<td align="left">Sequence</td>
			</tr><hr />';

			while ($row = mysql_fetch_array($result,MYSQL_NUM)) {
				// only show columns that are not NULL...?
				echo "	<tr>
					<td align=\"left\">$row[0]</td>
					<td align=\"left\">$row[1]</td>
					<td align=\"left\">$row[2]</td>
					<td align=\"left\">$row[3]</td>
					</tr>";
			}

			echo '</table></div></center>';
			mysql_free_result ($result);
		
		} else { 
			echo " Something didn't work!<br />".$query;
		}
		mysql_close();
		
	} else {
		?>
-->

	<br /><br />

	<center>
	<div id="main" style="width:600px"><table>
		<tr>
			<td>
			<p>A maximum of 100 rows will be displayed on this site after the form is submitted. To obtain the full set of query results, please enter your email address below.<br /><br /><b>Note:</b> The random chromosome contigs have not yet been added<br />
			to the database.<br /><br /></p>

			<form action="handleForm.php" method="post">
			<!--<?php echo $_SERVER['PHP_SELF']; ?>-->
			<fieldset><legend><b>CompIndel Query Form</b></legend>

				<p><b>Human chromosome</b> (length, in nucleotides and including gaps):<br />
				<select name="chromosome">
				<option value="1">1 (249250621)</option>
				<option value="2">2 (243199373)</option>
				<option value="3">3 (198022430)</option>
				<option value="4">4 (191154276</option>
				<option value="5">5 (180915260)</option>
				<option value="6">6 (171115067)</option>
				<option value="7">7 (159138663)</option>
				<option value="8">8 (146364022)</option>
				<option value="9">9 (141213431)</option>
				<option value="10">10 (135534747)</option>
				<option value="11">11 (135006516)</option>
				<option value="12">12 (133851895)</option>
				<option value="13">13 (115169878)</option>
				<option value="14">14 (107349540)</option>
				<option value="15">15 (102531392)</option>
				<option value="16">16 (90354753)</option>
				<option value="17">17 (81195210)</option>
				<option value="18">18 (78077248)</option>
				<option value="19">19 (59128983)</option>
				<option value="20">20 (63025520)</option>
				<option value="21">21 (48129895)</option>
				<option value="22">22 (51304566)</option>
				<option value="X">X (155270560)</option>
				<option value="Y">Y (59373566)</option>
				</select>

				<p><b>Human chromosome range,</b> in nucleotides:<br />
				<input type="text" name="range1"> to 
				<input type="text" name="range2"><br />

				<hr />
				<p><b>Email:</b><br />
				<input type="text" name="email" size="40" maxlength="60"  /> </p>

			</fieldset>
			</td>
		</tr>
	<tr><td><center><input type="submit" name="submit" value="Submit" /></center></td></tr>
</table></div></center>
</form><br /><br /><br />

<!--<?php
};
?>
-->
<center><p>&copy; 2014 Jordan Brooker | Contact at jrdnbrkr@gmail.com</p></center>


</body>

</html>
