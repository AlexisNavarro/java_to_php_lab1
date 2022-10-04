<?php
//include("TokenType.php");
include("Token.php");

//require_once 'EvalSectionException.php';

//making an empty array for char

// GLOBAL $e;
// $e = array();
// global $i;
// $i = 0;

//global $currentChar='';

class Tokenizer{
    private $e;
    private  $i;
    private $currentChar;

    public function Tokenizer($s)
    {
        // global $e;
        // global $i;
        $this->e = str_split($s);
        $this->i = 0;
        
    } //end tokenizer method

 

    public function nextToken(){
  
        //using count to get the length of the array and strpos to be able to access the index where the string appears
        while($this->i < sizeof($this->e)
         && strpos(" \n\t\r", $this->e[$this->i]) > 0){
            $this->i++;
        }//end first while
    
        if($this->i >= sizeof($this->e)){
            return new Token(TokenType::EOF);
        }
    
        $inputString = "";
        while ($this->i < sizeof($this->e) && strpos("0123456789", $this->e[$this->i] ) > 0 ){
            $inputString .= $this->e[$this->i++];
        }//end second while
        //var_dump($inputString);
        if(""!= $inputString){
            return new Token(TokenType::INT, $inputString);
        }
    
        // We're left with strings or one character tokens
        switch ($this->e[$this->i++]) {
            case '[':
                return new Token(TokenType::LSQUAREBRACKET,"[");
            case ']':
                return new Token(TokenType::RSQUAREBRACKET,"]");
            case '-':
                return new Token(TokenType::DASH,"-");
            case ',':
                return new Token(TokenType::COMMA,",");
            case '"':
                $value="";
                while ($this->i < sizeof($this->e) && $this->e[$this->i]!='"'){
                        $c=$this->e[$this->i++];
                    
                        if ($this->i >= sizeof($this->e)){  
                             
                            return new Token(TokenType::OTHER);
                        }
                        // check for escaped double quote
                        if ($c=='\\' && $this->e[$this->i]=='"'){
                            //echo "hello";
                            $c='"';
                            $this->i++;
                        }
                        $value.=$c;
                    } 
                    $this->i++;
                    return new Token(TokenType::STRING, $value);   
                    
            }
            return new Token(TokenType::OTHER);
    }//end nextToken
}//end class
?>
