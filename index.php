<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<link rel="stylesheet" href="css/styles.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>

<!----------- SCRIPT ----------->
<script>
// Lit le fichier Txt ProgVoletStatus
<?php
$ProgVoletStatusDataFile = "Output.txt";
$ProgVoletStatusDataFilehandle = fopen($ProgVoletStatusDataFile, "r");
$ProgVoletStatusData = fread($ProgVoletStatusDataFilehandle, filesize($ProgVoletStatusDataFile));
fclose($ProgVoletStatusDataFilehandle);
// Defini la position de la checkbox ProgVoletStatus
if ($ProgVoletStatusData == 'ON'){
	$ProgVoletStatusCheckboxStatus = "checked";
} else {
	$ProgVoletStatusCheckboxStatus = "";
}
?>
</script>
<script type="text/javascript">
//Si le ProgVoletCheckbox à été cliqué, alors les datas sont update
function ProgVoletStatusUpdate() {
	var x = document.getElementById("ProgVoletStatusCheckbox").checked;
	if (x == true){
		z = "ON";
	} else {
		z = "OFF";
	}
	$.post("index.php", {InterfaceJS2PHP: z});
	// Ecrire le Status de la progVolet dans un txt
	<?php
	$text = $_POST['InterfaceJS2PHP'];
	if ($text == ''){
		$text = $ProgVoletStatusData;
	}
	$filename = "Output.txt";
	$fh = fopen($filename, "w");
	fwrite($fh, $text);
	fclose($fh);
	?>
}
</script>

<!----------- FIN DU SCRIPT ----------->

<label class="switch">
	<input type="checkbox" id=ProgVoletStatusCheckbox onclick="ProgVoletStatusUpdate()" <?php echo $ProgVoletStatusCheckboxStatus ?>>
	<span class="slider round"></span>
</label>


</body>

</html>
