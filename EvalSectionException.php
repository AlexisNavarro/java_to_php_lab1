<?php
// include("TokenType.php");
// include("Tokenizer.php");
// include("FamilyMember.php");
//include("Fall22PhpProg.php");
// include("Token.php");
// include("BTree.php");
// include("BTNode.php");
class EvalSectionException extends Exception{
    
    public function  EvalSectionException($m) {
        //System.out.println(Fall22PhpProg->$EOL+"Parsing or execution Exception: "+$m+Fall22PhpProg->$EOL);
        //echo(Fall22PhpProg.EOL."Parsing or execution Exception: ".$m.Fall22PhpProg.EOL); //doesn't work
        echo PHP_EOL."Parsing or execution Exception: ".$m.PHP_EOL;
    }   
}
?>
