<!DOCTYPE html>
<html lang="en">

<?php  require('header.php'); fetchMetaData(__FILE__);?>
    <?php
        //An array containing month info
        $months = array(
            new Month(1,"January", '31'),
            new Month(2,"February",'28'),
            new Month(3,"March",'31'),
            new Month(4,"April",'30'),
            new Month(5,"May",'31'),
            new Month(6,"June",'30'),
            new Month(7,"July",'31'),
            new Month(8,"August",'31'),
            new Month(9,"September",'30'),
            new Month(10,"October",'31'),
            new Month(11,"November",'30'),
            new Month(12,"December",'31')
            );
?>

    <div class= "box">
        <div class="wrapper" id=lfaWrapper>
            <div><?php echo build_table($months); ?></div>
            <div>
                <div id ="downloadLinks">
                    <a href='download.php?file=index.php' download>index.php download</a><br>
                    <?php require('links.php');?>
                    <a href='download.php?file=lfa.php' download>lfa.php download</a><br>
                </div>                
                <?php
                echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. "This page uses a PHP function to loop through
                an array and echo the results into a table" .'</p>';?>                
            </div>
        </div>

    </div>
</body>

</html>


