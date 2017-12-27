<!DOCTYPE html>
<html lang="en">

<?php  require('header.php'); fetchMetaData(__FILE__);?>
    
    <div class ="box" id="box1">

        <div id="jumbotron">
            <h1>JMAR</h1>
        </div>
        <div id="quote">
            <?php quoteGenerator($Quotes)?>
            
        </div>
    </div>

    <div class="box" id="box2">
        <div class="wrapper">
            <!--About Me**********************-->
            <div>
                <h2>About me</h2>
                <?php
            echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. "I believe that technological innovation is the epitome of human greatness, 
            and with it exists the power to overcome any obstacle and accomplish any feat.  
            Being in the field of computing allows me to be a part of that great endeavor, 
            and it is my goal to pursue such knowledge in order to contribute to the betterment of mankind." .'</p>'; 
                ?>
                <h2>   - JMAR</h2>
            </div>
            <!--END About Me*****************-->    

            <!--CIS427**********************-->
            <div>
                <?php echo '<h2>'. "CIS 427" .'</h2>'; ?>
                <ol>
                    <?php       
                    listArray($CIS427);//calls the listArray function on the CIS427 array           
                    ?>
                </ol>
            </div>
            <!--END CIS427**********************-->

            <!--CIS475**********************-->
            <div>
                <?php echo '<h2>'. "CIS 475" .'</h2>'; ?>
                <ol>
                    <?php
                    listArray($CIS475);//calls the listArray function on the CIS475 array           
                    ?>
                </ol>
            </div>
            <!--END CIS475**********************-->
        </div>

        <div id=clock>
            <?php echo(strftime("%m/%d/%Y %H:%M")); 
            echo '<br>This site is currenty optimized for Firefox and Chrome on desktop<br>';?>
            <?php require('links.php');?>
            <a href='download.php?file=index.php' download>index.php download</a>          
        </div>

    </div>
</body>

</html>