<!DOCTYPE html>
<html lang="en">

<?php  require('header.php'); fetchMetaData(__FILE__);?>
    
    <div class= "box" id="box1">
        <div class="wrapper" id="dbWrapper">
            <div id ="downloadLinks">
                    <?php months_to_sql(); ?><br>       
                    <a href='download.php?file=index.php' download>index.php download</a><br>
                    <?php require('links.php');?>
                    <a href='download.php?file=db.php' download>db.php download</a><br>
                    <a href='download.php?file=mysqlmonths.png' download>mysqlmonths.png download</a><br>
                    <p>Scroll down to view monthsTable in phpMyAdmin</p>
            </div>
        </div>
    </div>
    
    <div class= "box" id="box2"></div>
</body>

</html>