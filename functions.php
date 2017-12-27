<?php
    /*This file contains all of the primary functions that this site utilizes*/

    //Month - This class defines a month///////////////////////////////////
    class Month {
        public $IDnum;
        public $monthName;
        public $numDays;
    
        //CONSTRUCTOR
        public function __construct($IDnum, $monthName, $numDays){
            $this->IDnum = $IDnum;
            $this->monthName = $monthName;
            $this->numDays = $numDays;
        }
    
        public function getIDnum(){return $this->IDnum;}
        public function getMonthName(){return $this->monthName;}
        public function getNumDays(){return $this->numDays;}
    }
    //END Month Class//////////////////////////////////////////////////////

/* Build Table - This function uses concatenation to add elements onto the $myTable variable
                  and then returns the variable so it can display as an HTML table object
*/
    function build_table($array){
        // start table
        $number=1;//counter
        $myTable = '<table>';
        //table header row
        $myTable .= '<tr>';
        $myTable .= '<th>' . "#" . '</th>';
        $myTable .= '<th>' . "Month" . '</th>';
        $myTable .= '<th>' . "# of Days" . '</th>';
        $myTable .= '</tr>';
        //END table header
    
        // data rows
        foreach($array as $item){
            //add test for if number is odd. create css class for odd rows.
            if ($item->getIDnum()%2 == 0){
                $myTable .= '<tr>';
            }
            else{
                $myTable .= '<tr class="odd">';
            }        
                $myTable .= '<td>' . $item->getIDnum() .'</td>';
                $myTable .= '<td>' . $item->getMonthName() .'</td>';
                $myTable .= '<td>' . $item->getNumDays() .'</td>';
            $myTable .= '</tr>';
        }
    
        // finish table and return it
    
        $myTable .= '</table>';
        return $myTable;
    }
//END Build Table*********************************


/* File Parser - retrieves data from an input file, parses into Month objets, returns Month array*/
function month_file_parser($fileArray){
    $ParsedMonths = array();//used to store an array of Month objects

    foreach($fileArray as $line)//each line contains all CSV data
    {
        $tempArray = explode(',', $line);//parses line using comma ',' delimeter from input file into a temp array.
        $tempMonth = new Month ($tempArray[0],$tempArray[1],$tempArray[2]);//creates new month object
        array_push($ParsedMonths, $tempMonth);//Pushes a new Month object into the Parsed Months array
    }
    return $ParsedMonths;//returns an array of new Month objecsts
}
//END File Parser*********************************


/* Output File Reverser - reverses an array*/
function outputFile_reverse($array){
    
     //**************NOTE*************************
     /*This code block was necessary as it kept printing December and November data on the same line with fwrite
     The original file had return lines at the end of each line but not the last
     This bit of code appends a return line to the last element of the array before reversing it
     I have it working with end() and reset() so it can be used in the future if necessary
     */
     end($array);//sets the array to the last element
     $key = key($array);//sets a variable key to the current array key value
     $array[$key] .=PHP_EOL;//appends an end of line character to the value
     reset($array);//resets the array pointer to the beginning
 
     $reversed = array_reverse($array);//reverses the array
 
     $fp = fopen("cis475_ior.txt", "w");//opens the output file
 
     foreach($reversed as $key=>$value){
         fwrite($fp, $value);//writes the value from the array to the output file
         }
 
     fclose($fp);//closes the output file
 
 }
//END Output File Reverse*******************************

/* Months to SQL - this function takes month data from an input file and
    creates a mySQL table with the parsed info*/
function months_to_sql(){

$InFile = file('cis475_io.txt');
$monthsArray = month_file_parser($InFile);

//creates button
$button=<<<EOD
    <form method="post">
    <input type="submit" name="imbtn" id="imbtn" value="Import Months"/><br/>
    </form>
EOD;
echo $button;

    if(array_key_exists('imbtn',$_POST)){//executes code when button is pressed
    
        $conn = Connect();

        $conn->query("DROP TABLE IF EXISTS monthsTable");//deletes table if it already exists
            
    //sql to create table
        $sql = "CREATE TABLE monthsTable (
        monthsID INT(2),
        monthName CHAR(10),
        monthDays INT(2)
        )";

    //tests if sql table was created
    if ($conn->query($sql) === TRUE) {
        echo "monthsTable created successfully";
        } else {
            echo "Error creating table: " . $conn->error;//outputs error code
        }

    //inserts each $monthsArrray object into the monthsTable
       foreach($monthsArray as $item){
        $sql = "INSERT INTO monthsTable (monthsID, monthName, monthDays)
        VALUES ('$item->IDnum', '$item->monthName', '$item->numDays')";
        $conn->query($sql);//sends $sql as a query through the open connection
       }

        $conn->close();//close connection
    }
}
//END Months to SQL *****************************

/* Create MYSQL Table - This is for portability to create a functional MYSQL table
    in different server environments*/
function create_mysql_table(){
    $conn = Connect();

        $conn->query("DROP TABLE IF EXISTS contactsTable");//deletes table if it already exists
            
    //sql to create table
        $sql = "CREATE TABLE contactsTable (
        contactID INT NOT NULL AUTO_INCREMENT,
        contactFirstName CHAR(15),
        contactLastName CHAR(30),
        contactAddress CHAR(30),
        contactCity CHAR(30),
        contactState CHAR(2),
        contactZipcode CHAR(9),
        contactPhone CHAR(10),
        contactEmail CHAR(60),
        contactComments LONGTEXT,
        contactDate DATE,
        PRIMARY KEY (contactID)
        )";

    //tests if sql table was created
        if ($conn->query($sql) === TRUE) {
            echo "contactsTable created successfully";
        } else {
            echo "Error creating table: " . $conn->error;//outputs error code
        }
        $conn->close();//close connection

}
//END Create MYSQL Table******************************

/* MYSQL Parse Table - this function makes a connection to a MYSQL database
    and extracts data from a table.  It then calls the build table function
    and echos that data back to the page calling it*/
function mysql_parse_table(){
        $ParsedMonths = array();//used to store an array of Month objects

        $conn = Connect();
    
        $sql = "SELECT * FROM monthsTable";//selects all data from the monthstable in the mysql database
        $result = $conn->query($sql);
    

        if ($result->num_rows > 0) {
    // output data of each row
            while($row = $result->fetch_assoc()) {
                $tempMonth = new Month ($row['monthsID'],$row['monthName'],$row['monthDays']);//creates new month object
                array_push($ParsedMonths, $tempMonth);//Pushes a new Month object into the Parsed Months array
            }

        echo build_table($ParsedMonths);//calls the build table function and echos the result to HTML
        } 
        else {
            echo "0 results";
        }
    $conn->close();//closes the connection
}
//END MYSQL Parse Table **********************************

/* Connect - establishes a connection to a MYSQL database on a server*/
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "marronja01";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Connection failed: " . $conn->connect_error);

 return $conn;
}
//END Connect***************************************************************

$USSTATES = array(""=>"Select Option","AL"=>"Alabama","AK"=>"Alaska","AZ"=>"Arizona","AR"=>"Arkansas",
    "CA"=>"California","CO"=>"Colorado","CT"=>"Connecticut","DE"=>"Delaware","FL"=>"Florida","GA"=>"Georgia",
    "HI"=>"Hawaii","ID"=>"Idaho","IL"=>"Illinois","IN"=>"Indiana","IA"=>"Iowa","KS"=>"Kansas","KY"=>"Kentucky",
    "LA"=>"Louisiana","ME"=>"Maine","MD"=>"Maryland","MA"=>"Massachusetts","MI"=>"Michigan","MN"=>"Minnesota",
    "MS"=>"Mississippi","MO"=>"Missouri","MT"=>"Montana","NE"=>"Nebraska","NV"=>"Nevada","NH"=>"New Hampshire",
    "NJ"=>"New Jersey","NM"=>"New Mexico","NY"=>"New York","NC"=>"North Carolina","ND"=>"North Dakota","OH"=>"Ohio",
    "OK"=>"Oklahoma","OR"=>"Oregon","PA"=>"Pennsylvania","RI"=>"Rhode Island","SC"=>"South Carolina","SD"=>"South Dakota",
    "TN"=>"Tennessee","TX"=>"Texas","UT"=>"Utah","VT"=>"Vermont","VA"=>"Virginia","WA"=>"Washington","WV"=>"West Virginia",
    "WI"=>"Wisconsin","WY"=>"Wyoming"
);

/* Select States - generates a select drop down menu for an html form which outputs the state abbreviation*/
function select_states($StateArray, $CurrentSelection){
    echo '<select name="contactState">';
    foreach ($StateArray as $key=>$value){//link is $key and $value is displayed name
        echo '<option value='.$key;

            if($key == $CurrentSelection){//evaluates if the selected value is equal to the array key
                echo ' selected';//echos html value selected to set it to the current value
            }
         echo '>'.$value.'</option>';
    }
    echo '</select>';
}
//END Select States**************************************

/*Test Input - this clears input data and helps protect against attacks */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace(array( '(', ')','-' ), '', $data);
return $data;
}
//END Test Input *****************************************

/* QUOTE GENERATOR - An array of quotes from Bruce Lee*/
$Quotes = array("Adapt what is useful, reject what is useless, and add what is specifically your own.",
"If you spend too much time thinking about a thing, you'll never get it done.",
"If you love life, don't waste time, for time is what life is made up of.",
"I fear not the man who has practiced 10,000 kicks once, but I fear the 
man who has practiced one kick 10,000 times.",
"The key to immortality is first living a life worth remembering.");

//Quote Generator*********************
function quoteGenerator($stringArray){
    echo'<p>' . $stringArray[rand(0, count($stringArray)-1)] . '</p>';}
//END Quote Generator******************
?>