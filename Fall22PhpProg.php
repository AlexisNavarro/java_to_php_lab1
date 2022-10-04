
<?php
//include("TokenType.php");
include("Tokenizer.php");
include("FamilyMember.php");
// //include("Token.php");
include("EvalSectionException.php");
include("BTree.php");
//include("BTNode.php");
//include ("http://localhost/debug/cs4339Fall22family.txt");


 Fall22PhpProg::main_method();
class Fall22PhpProg {
    
    // static Token $currentToken;
    // static Tokenizer $t;
    //static $EOL= PHP_EOL; // new line, depends on OS
    

     function main_method(){
        global $currentToken;
        global $t;
        //$inputLine;
        $inputFile="";
            
        // $file = fopen("C:\Program Files\Ampps\www\laptop_code2-main\cs4339Fall22family.txt", "r");

        // if ($file) {
        //     while (!feof($file)) {
        //         //$line = readfile("C:\Program Files\Ampps\www\laptop_code2-main\cs4339Fall22family.txt");

        //         $line = fgets($file) ;
        //         echo $line;
        //         echo "<br>";
        //         //echo $line;
        //         $inputFile .= " ".$line.PHP_EOL;
             
                
        //     }

        //     fclose($file);
        // } else {
        //     // error opening the file.
        // }

        $header = "<html>".PHP_EOL
                . "  <head>".PHP_EOL
                . "    <title>CS 4339/5339 PHP assignment</title>".PHP_EOL
                . "  </head>".PHP_EOL
                . "  <body>".PHP_EOL
                . "    <pre>";
         $footer = "    </pre>".PHP_EOL
                . "  </body>".PHP_EOL
                . "</html>";
       
         // Read file from URL
        $url = "http://localhost/laptop_code2-main/cs4339Fall22family.txt";
        $inputFile = file_get_contents($url);
        $t = new Tokenizer($inputFile);
        
      
        echo($header);
        $currentToken = $t->nextToken();
        // echo "current \n";

      
        $section = 0;
        // echo "hello";
    
        // // Loop through all sections, for each section printing result
        // // If a section causes exception, catch and jump to next section
        while ($currentToken->type != TokenType::EOF) {
            echo("\nsection ". ++$section .PHP_EOL);
            try {
                Fall22PhpProg::evalSection();
                //echo"hello";
            } catch (EvalSectionException $ex) {
//                // skip to the end of section
                while ($currentToken->type != TokenType::RSQUAREBRACKET
                        && $currentToken->type != TokenType::EOF) {
                    $currentToken = $t->nextToken();
                }
                $currentToken = $t->nextToken();
            }
        }
        //System.out.println(footer);
        echo($footer);
    }//end main _method
    
    

      function evalSection() {
        // <section> ::= '[' <member>* ']'
       global $t;
       global $currentToken;
    //    echo "currentToken evalSection \n";
    //     print_r($currentToken->value);
    //     echo "\n";
       
    //    echo "evalSection Token \n";
    //    print_r($t->nextToken());
    //    echo "\n";
    
       
        
        //print_r($t);

      
        if ($currentToken->type != TokenType::LSQUAREBRACKET) {
            throw new EvalSectionException("A section must start with \"[\","
                    . "found " . $currentToken->printToken());
        }
       
        //System.out.println("[");
        echo(PHP_EOL."[" .PHP_EOL);
        $currentToken = $t->nextToken();
        $tree = new BTree();
        //$tree = FamilyMember(); 
        while ($currentToken->type != TokenType::RSQUAREBRACKET
                && $currentToken->type != TokenType::EOF) {                    
           Fall22PhpProg::processMember($tree);
        }
        // System.out.println("tree height: "+tree.getHeight());
        // System.out.println("tree size: "+tree.getSize());

        // echo("tree height: ".$tree->getHeight());
        // echo "\n";
        // echo("tree size: ".$tree->getSize());
        $tree->print();
        //System.out.println("]");
        echo(PHP_EOL."]".PHP_EOL);
        $currentToken = $t->nextToken();
        //System.out.println("next Token:"+currentToken.printToken());
    }//end evalsection 

    function processMember(BTree $tree){
        global $currentToken;
        global $t;
        //print_r($currentToken);
        //var_dump($currentToken);
        // <member> ::= STRING '-' STRING ',' INT ',' STRING
        if ($currentToken->type != TokenType::STRING) {
            $currentToken->printToken();
            //var_dump($currentToken);
            throw new EvalSectionException("A member must start with a String");
        }
        $firstName=$currentToken->value;
        $currentToken = $t->nextToken();
        //var_dump($currentToken);
        if ($currentToken->type != TokenType::DASH) {
            throw new EvalSectionException("First name and last name must be separated by a dash");
        }
        $currentToken = $t->nextToken();  
        //print_r ($currentToken);
        //var_dump($currentToken);
        if ($currentToken->type != TokenType::STRING) {
            throw new EvalSectionException("A String was expected for last name");
        }
        $lastName=$currentToken->value;  
        $currentToken = $t->nextToken(); 
        //var_dump($currentToken);     
        if ($currentToken->type != TokenType::COMMA) {
            throw new EvalSectionException("A comma was expected");
        }
        $currentToken = $t->nextToken();  
        //var_dump($currentToken);
        if ($currentToken->type !== TokenType::INT) {
            throw new EvalSectionException("An integer was expected");
        }
        $siblings = intval($currentToken->value);  
        $currentToken = $t->nextToken();
        //var_dump($currentToken);
        if ($currentToken->type != TokenType::COMMA) {
            throw new EvalSectionException("A comma was expected");
        }
        $currentToken = $t->nextToken();
        //var_dump($currentToken);
        if ($currentToken->type != TokenType::STRING) {
            //System.out.println(currentToken.type);
            echo $currentToken->type;
            throw new EvalSectionException("A string was expected for tree path");
        }
        $treePath=$currentToken->value;  
        $regex = "^[FMR]{1,3}^";
        if (!preg_match($regex, $treePath)){
          // string contains a character other than F, M and/or R
            throw new EvalSectionException("Only 'F', 'M' and 'R' in tree path");
        }
        $m = new FamilyMember($firstName, $lastName, $siblings);
        $tree->insertData($treePath,$m);
        $currentToken = $t->nextToken(); 
    }//end process member  

    
}//end class

?>
 