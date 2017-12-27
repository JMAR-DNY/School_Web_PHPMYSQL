<!DOCTYPE html>
<html lang="en">

<?php  require('header.php'); fetchMetaData(__FILE__);?>

    <div class= "box">
        <div class="wrapper" id=lfaWrapper>
            <div><?php mysql_parse_table(); ?></div>
            <div>
                <div id ="downloadLinks">
                    <?php require('links.php');?>
                    <a href='download.php?file=index.php' download>index.php download</a><br>
                    <a href='download.php?file=php_mysql_table.php' download>php_mysql_table.php download</a>
                </div>                
                <?php
                echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. "My solution to this problem is very straightforward. 
                I created a connection to the mysql database and then retrieved the necessary data from the
                appropriate table.  I then parsed the data into an array and used my table building function which
                was used in previous assignments.  I recycled some of the code to parse the data from the io 
                assignment and could have abstracted it but felt that for this solution it was not necessary.".
                '<br><br>'."-JMAR" .'</p>';?>                
            </div>
        </div>

    </div>
</body>

</html>