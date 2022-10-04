<?php
 include('TokenType.php');




//$type = TokenType(TokenType::DASH); //Object token
// $type = new TokenType(); //Object token
// $value = ""; //string value

class Token{
    //create a TokenType object
    //$type = new TokenType;
    public $type;
    public $value;
    

    //referenced: https://www.geeksforgeeks.org/how-to-mimic-multiple-constructors-in-php/
    //referenced: https://www.amitmerchant.com/multiple-constructors-php/#:~:text=Well%2C%20the%20simple%20answer%20is%2C%20You%20can%E2%80%99t.%20At,another%20constructor%20in%20the%20above%20example%20like%20so.
    //to be able to have multiple constructors to avoid rerefrence error in php
    
    function Token1($theType){
        //echo("1 arg constructor called".$theType)."<br>";
        $this->type = $theType;
      
    }

    function Token2($theType,  $theValue){
        //echo("2 args constructor called".$theType.',' .$theValue)."<br>";
        $this->type = $theType;
        $this->value = $theValue;
    }

    function __construct(){
        $args = func_get_args();
        $numOfArgs = func_num_args();

        if(method_exists($this, $function = 'Token'.$numOfArgs)){
            call_user_func_array(array($this, $function), $args);
        }
    }

    //referenced the book example 4-23
     function printToken(){
        var_dump ($this->type.$this->value);
        switch($this->type){
            case TokenType::LSQUAREBRACKET:
                return "LSQUAREBRACKET";
            case TokenType::RSQUAREBRACKET:
                return "RSQUAREBRACKET"; 
            case TokenType::DASH:
                return "DASH";
            case TokenType::COMMA:
                return "COMMA";
            case TokenType::INT:
                return "INT  ".$this->value;
            case TokenType::STRING:
                return "STRING ".$this->value;
            case TokenType::EOF:
                return "EOF";
            default:
                return "OTHER";
        }//END SWITCH STATEMENT

    }//end printToken

    
}//end class
?>
