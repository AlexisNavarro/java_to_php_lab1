<?php
//include("TokenType.php");
// include("Tokenizer.php");
// include("Token.php");
//include("Fall22PhpProg.php");
// include("EvalSectionException.php");
// include("BTree.php");
// include("BTNode.php");

class FamilyMember{
    private String $fname;
    private String $lname;
    private int $siblings;
    
    //function FamilyMember() {}
    
    function FamilyMember(string $fn, string $ln, int $s) {
        $this->fname = $fn;
        $this->lname = $ln;
        $this->siblings = $s;
    }

    function setFName(String $fn) {
        $this->fname = $fn;
    }
    
    function setLName(String $ln) {
        $this->lname = $ln;
    }
    
    function setSiblings(int $s) {
        $this->siblings = $s;
    }
    
    function getFName() {
        return  $this->fname;   
    }
    
    function getLName() {
        return  $this->lname;   
    }
    
    function getSiblings() {
        return  $this->siblings;   
    }
    
    function toString() {
        return  PHP_EOL.$this->fname . " " .  $this->lname . ", who had: " .  $this->siblings . " siblings." .PHP_EOL;   
    }
    
   // @Override
    function compareTo(FamilyMember $fm) {
        $v1 =  $this->lname.compareTo($fm->$lname);
        $v2 =  $this->fname.compareTo($fm->$fname);

        //$v3 = $siblings<$fm->$siblings?-1:$siblings>$fm->$siblings?1:0>;

        if( $this->siblings){
            $v3 = $fm-> $this->siblings?-1: $this->sibling;
        }
        else{
            $v3 = $fm-> $this->siblings?1:0;
        }
        if ($v1!=0) return $v1;
        if ($v2!=0) return $v2;
        return $v3;
    }
}
?>