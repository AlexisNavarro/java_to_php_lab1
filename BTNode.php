<?php
/**** This class defines the blueprint of a node that wraps information of a generic type T, 
 **** and that has 2 links to 2 potential "children" called left and right.
 ****/

// include("FamilyMember.php");
// //include("Fall22PhpProg.php");
// include("EvalSectionException.php");
// include("BTree.php");

class BTNode{
    
    private $data;
    private  $left;
    private  $right;
    
    // Constructors ****************************************************************
    function BTNode1() {}
    
    function BTNode($d) {
        $this->data = $d;
        $this->left = null;
        $this->right = null;
    }
    
    // Setters *********************************************************************
    function setData($d) {
        $this->data = $d;   
    }
    
    function setLeft(BTNode $L) {
        $this->left = $L;
    }
    
    function setRight(BTNode $R) {
        $this->right = $R;
    }
    
    // Getters **********************************************************************
    function getData() {
        return $this->data;   
    }
    
    function getLeft() {
        return $this->left;   
    }
    
    function getRight() {
        return $this->right;   
    }
    
    // Other methods ***************************************************************
    /* printNode prints the content of the current node */
    function printNode() {
        if ( $this->data == null)
            //System.out.println("?");
            echo(PHP_EOL."?".PHP_EOL);
        else
            //System.out.println(data.toString());
            echo($this->data->toString());
    }

    /* Height computes the height of the current node */
    function height() {
        $leftHeight;
        $rightHeight;
        if (BTNode::hasLeft()) 
            $leftHeight =  $this->left->height();
        else $leftHeight = -1;
        if (BTNode::hasRight()) 
            $rightHeight =  $this->right->height();
        else $rightHeight = -1;
        return 1 + max($leftHeight, $rightHeight);
    }
    
    function sizeBelow() {
        $leftSize;
        $rightSize;
        if (BTNode::hasLeft()) 
            $leftSize =  $this->left->sizeBelow();
        else $leftSize = 0;
        if (BTNode::hasRight()) 
            $rightSize =  $this->right->sizeBelow();
        else $rightSize = 0;
        return 1 + $leftSize + $rightSize;
    }

    function hasLeft() {
        return BTNode::getLeft() != null;
    }
    
    function hasRight() {
        return BTNode::getRight() != null;
    }
}
?>