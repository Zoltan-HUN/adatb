<html>
<head>
<title>ShotDev.Com Tutorial</title>
</head>
<body>
<?php
$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 4000))
    )
    (CONNECT_DATA =
      (SID = kabinet)
    )
  )";
$conn = oci_connect('h448410', 'napocska11', $tns,'UTF8');
$strSQL = "DELETE FROM gyarto WHERE gyartonev = '".$_GET["CusID"]."' ";

$stid = oci_parse($conn, $strSQL);
$faszom = oci_execute($stid, OCI_DEFAULT);
if($faszom)
{
oci_commit($conn); //*** Commit Transaction ***//
echo 'Sikeres törlés!';
}
else
{
oci_rollback($conn); //*** RollBack Transaction ***//
$e = oci_error($stid);
echo "Error Delete [".$e['message']."]";
}
oci_close($conn);
?>
<a href="index.php">
  <img src="back.png" style="width:42px;height:42px;border:0;">
</a>
</body>
</html>
