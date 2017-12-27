<?php

//A Key Value Pair array storing assignment links as key and names as value
$CIS427 = array("#href1"=>"Open Discussions",
                "#href2"=>"Final Project Proposal",
                "#href3"=>"Final Project Site",
                "#href4"=>"Final Project Presentation",);

//A Key Value Pair array storing assignment links as key and names as value
$CIS475 = array("serverSetup.php"=>"PHP/MySQL Server Setup",
                "index.php"=>"First PHP Web Page",
                "lfa.php"=>"PHP Loop, Function, Arrays",
                "io.php"=>"PHP Read and Write a Text File",
                "db.php"=>"MySQL Table",
                "php_mysql_table.php"=>"PHP Table from MySQL Table",
                "php_mysql_form.php"=>"Write to MySQL Table",
                "#href12"=>"Final PHP Web Site");

//List Array Function*************************                
function listArray($someArray){  
    foreach ($someArray as $key=>$value){//link is $key and $value is displayed name
        echo '<li>' . "<a href=".$key.">".$value."</a>" . '</li>';
    }
}
//END List Array Function**********************

?>