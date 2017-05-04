<html>

</head>

<body>

<form action="login.php" method="post">

<input type="text" id="uname" class="form-control" placeholder="username" name="name"/>

<input type="text" id="password" class="form-control" placeholder="password" name="pwd"/>

<button type="submit">login</button>

</form>

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

$name = '';
$pwd = '';
echo '<table border="0">';
if (isset($_POST['name'])){
	$name = $_POST['name'];
}
if (isset($_POST['pwd'])){
	$pwd = $_POST['pwd'];
}

//query is sent to the db to fetch row id.
$sql = 'SELECT userid FROM felhasznalo WHERE felhasznalonev = \''.$name.'\' and jelszo = \''.$pwd.'\'' ;
$stid = oci_parse($conn, $sql);
/*oci_parse fuction prepares the db to execute the statement.
requires two parameters resource($con)and sql string.*/
/*if (isset($_POST['name']) || isset($_POST['pwd'])){           
$felhasznalonev=$_POST['name'];
$jelszo=$_POST['pwd'];
}
*/
//$felh = $name;
//$jel = $pwd;
//oci_bind_by_name($stid, $felh ,$name);
//oci_bind_by_name($stid, $jel ,$pwd);
/*oci_bind_by_name function tells php which variable to use.
They are references of the original variables.*/
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC);
//oci_fetch_array returns a row from the db.

 if ($row) {
 $_SESSION['user']=$_POST['user'];
 echo"log in successful";
  }
 else {
echo("The person " . $name . " is not found .
Please check the spelling and try again or check password");
exit;
}
$ID = $row['ID']; 
oci_free_statement($stid);
oci_close($con);
//header function locates you to a welcome page saved s wel.php
 ?>










</body>

</html>