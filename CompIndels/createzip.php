<!DOCTYPE html>

<html>

<head>
	<title>Species</title>
	<style>
	p.big {line-height:140%;}
	div {
		padding: 30px 40px;
		background: #FFFFFF;
		border-radius:25px;
		box-shadow: 10px 10px 5px #888888;
	}
	</style>
</head>

<body bgcolor="#C0C0C0">

<center><div style="width:800px">
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
		</td></tr></table></center>
	</tr>
</table>
</div></center>
<br />
<br />


<?php 

function create_zip($files = array(),$destination = '',$overwrite = false) {
	
	if(file_exists($destination) && !$overwrite) { return false;}

	$valid_files = array();

	if(is_array($file)) {
	
		foreach($files as $file) {
		
			if(file_exists($file)) {
					
				$valid_files[] = $file;
				
			}
		}
	}

	if(count($valid_files)) {
			
		$zip = new ZipArchive();
			
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {

			return false;

		}
			
		foreach($valid_files as $file) {
		
			$zip->addFile($file,$file);

		}

		$zip->close();

		return file_exists($destination);

	} else {

			return false;
		
		}


	if (isset($_POST['submit'])) {

		create_zip(['tree.png'],'tree.zip');
	
	} else {
				
?>		
		<br /><br />
		<center><div><input type="submit" name="submit" value="submit" /></div></center>

<?php

};

?>

<br /><br /><br />
<center><p>&copy; 2014 Jordan Brooker | Contact at jrdnbrkr@gmail.com</p></center>

</body>
</html>

	<p class="big">The purpose of this database is to allow users to study the indels and SNP mutations of common primate species. All of the primate genomes, and one mouse outgroup, were aligned to a human reference genome, <a href="http://genome.ucsc.edu/cgi-bin/hgGateway?db=hg19">hg19</a>. A difference between human sequence information and another species sequence would be entered as a mutation into the database. The table scheme for  the SQL database is below. <a href="http://hgdownload.soe.ucsc.edu/downloads.html">(Source of multiple genome alignments)</a></p>
<p>All of the examples in the table would create this entry:<br /><br />
1 | indel | gorGor1 | chr2 | 15403 | - | hg19.ch2 | 119709 | boundary | Gg,- -
</p>
<p>** Any parameter can be left blank and the query will still be run. The default values for the parameters are all of the options. Leaving everything blank and choosing "# of entries" for the output format will return the total number of mutations in the database. **</p>
<p>Note: A "boundary" mutation is one that occurs on the edge of a intron/exon boundary or one that contains pieces of both introns and exons.</p>



