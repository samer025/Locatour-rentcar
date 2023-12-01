<?php

error_reporting(0);
$conn =mysqli_connect("localhost", "root", "","php_mysqli_basic") or die (mysqli_error());
$query="SELECT SUM (prix) AS sum FROM 'contrat' ";
$query_result=mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_result))

   { $output ="Revenu total de vente de vehicules".$row['sum'];

}


?>
