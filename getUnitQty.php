
<?php
       
       include('connection.php');

class DBController {
function runQuery($query) {
    $result = mysqli_query($this->db,$query);
    while ($row=msqli_fetch_assoc($result)){
        $resultset[] = $row;
    }
    if(!empty($resultset))
        return $resultset;    
    }
function numRows($query){
    $result = mysqli_query($this->$db,$query);
    $rowcount = mysqli_num_rows($result);
    return $rowcount;  
    }
}
if(! empty($_POST[""])){
    
}
?> 
