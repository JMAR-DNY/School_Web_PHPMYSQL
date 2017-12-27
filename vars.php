<?php
//This file contains all meta data as well as CSS links and other HTML head info
//I want to keep the class info and related function info in this file for portability reasons

//Meta Data - This class handles HTML meta data//////////////////////////////////////
class MetaData {
    public $filepath;//contains the filepath so it can be compared to in function fetchMetaData
    public $title;
    public $metaDesc;
    public $metaKeywords;
    public $metaName;
    public $metaViewport;
    public $metaWebPageEditor;
    public $metaWebServerSoftware;
    public $siteCSS; 
    public $pageCSS; 

    //CONSTRUCTOR
    public function __construct($filepath, $title, $metaDesc, $metaKeywords,$pageCSS)
    {
        $this->filepath = $filepath;
        $this->title = $title;
        $this->metaDesc = $metaDesc;
        $this->metaKeywords = $metaKeywords;
        $this->metaName = "Jeffrey Marron a.k.a. JMAR";
        $this->metaViewport = "width=device-width, initial-scale=1.0";
        $this->metaWebPageEditor = "Visual Studio Code";
        $this->metaWebServerSoftware = "WAMP";
        $this->siteCSS = "css/mainStyle.css"; 
        $this->pageCSS = $pageCSS; 
    }

    /*
   Create Head - uses MetaData class object values
                and then uses HEREDOC to place those values into an HTML head.
                The head data is then returned to the file calling it
    */
    public function createHead(){

//uses HEREDOC to create html head info
$metaTag=<<<EOD
<head>
<link rel="stylesheet" type="text/css" href='$this->siteCSS' />
<link rel="stylesheet" type="text/css" href='$this->pageCSS' />
<title>'$this->title'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content='$this->metaDesc'>
<meta name="keywords" content='$this->metaKeywords'>
<meta name="author" content='$this->metaName'>
<meta name="viewport" content='$this->metaViewport'>
<meta name="editor" content='$this->metaWebPageEditor'>
<meta name="server" content='$this->metaWebServerSoftware'>
</head>
EOD;
return $metaTag;//this varialbe now contains all the metadata
    } 
    //END Create Head********************************************
    
}
//END Meta Data//////////////////////////////////////////////////////////////////////


/* 
Fetch Meta Data - uses the __FILE__ method inside the caller file to fetch the caller filepath.
    compares the caller filepath to the $filepath varialble of the MetaData objects inside the
    $pages array.  If a match is found then the createHead function is called from that
    MetaData object. Else createHead is called on the default page mainly for the CSS values   
*/
function fetchMetaData($filePath){
    global $pages;//calls global $pages array of page Meta Data
    global $defaultPage;//calls default meta data
    
    foreach ($pages as $temp) {//cycles through $pages array
        if (stripos($filePath, $temp->filepath) !== FALSE) {//uses stripos to compare $filepath to $pages info
            echo $temp->createHead();//sends head back to caller file
        }
    }
}
//END Fetch Meta Data**************************************************


//array of meta data for the pages on this site
$pages = array(
    new MetaData(
        "index.php",//page file name
        "JMAR's Lair",//page title
        "homepage for CIS427 and CIS475",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, PHP rocks",//keywords
        "css/index.css"//CSS for this page
    ),
    new MetaData(
        "lfa.php",//page file name
        "Loop Function Array",//page title
        "this is a demonstration of loops, functions, and arrays in PHP",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, loop, function, array, PHP",//keywords
        "css/lfa.css"//CSS for this page
    ),
    new MetaData(
        "io.php",//page file name
        "Input Output",//page title
        "Read from an input file, displasy data, and write reverse to output file in PHP",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, loop, input, output,PHP",//keywords
        "css/lfa.css"//CSS for this page
    ),
    new MetaData(
        "serverSetup.php",//page file name
        "Server Setup",//page title
        "Screen caps of the test WAMP server for this site",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, WAMP, server,PHP",//keywords
        "css/serverSetup.css"//CSS for this page
    ),
    new MetaData(
        "db.php",//page file name
        "MYSQL setup",//page title
        "Setup MYSQL database on server",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, MYSQL, output,PHP",//keywords
        "css/db.css"//CSS for this page
    ),
    new MetaData(
        "php_mysql_table.php",//page file name
        "MYSQL table",//page title
        "creates a table from a MYSQL database",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, MYSQL, table,PHP",//keywords
        "css/lfa.css"//CSS for this page
    ),
    new MetaData(
        "php_mysql_form.php",//page file name
        "mysql form",//page title
        "adds data to a mysql table",//meta description
        " JMAR, New York, NY, Buffalo, CIS475, CIS427, MYSQL, table,PHP",//keywords
        "css/php_mysql_form.css"//CSS for this page
    )  
);

?>
