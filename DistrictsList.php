<?php
require_once 'library/config.php';
$ParId     = $_POST['ParId'];
$Districts = [];
if($ParId != NULL){
    $SelectStateQuery  = "SELECT * FROM district_details WHERE par_id ='$ParId' AND active ='1'";
	$SelectStateSql    = pg_query($SelectStateQuery); 
    if ($SelectStateSql) {
        while ($row = pg_fetch_assoc($SelectStateSql)) {
            $Districts[] = $row;
        }
    }
    echo json_encode($Districts);
}else{
    echo json_encode($Districts);
}
?>