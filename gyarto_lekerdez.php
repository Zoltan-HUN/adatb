<html>
<head>
    <link rel=stylesheet type="text/css" href="mystyle.css" />
</head>
<body>
<?php

////phpinfo();
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
echo '<h1><center><u>H4nG-SZ3r</u></center></h1>';

echo '<table border="0">';



//// oci_parse felkészíti az oracle szervert a parancs fogadására
$stid = oci_parse($conn, 'SELECT * FROM gyarto');

//// végrehajtja a parancsot
oci_execute($stid);

//// visszaadja az oszlopok számát eredményként
$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td>' . $field . '</td>';
}
echo '</tr>';

//// -- ujra vegrehajtom a lekerdezest, es kiiratom a sorokat
oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '<td align="center"><a>Módosítás</a></td>';
    echo '<td align="center"><a href="delete.php?CusID='.$row["$field"].'">Törlés</a></td>';

    echo '</tr>';

}
echo '</table>';



oci_close($conn);


?>
<a href="index.php">
  <img src="back.png" style="width:42px;height:42px;border:0;">
</a>
</body>
</html>
