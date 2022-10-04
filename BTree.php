<?php

// include("FamilyMember.php");
// //include("Fall22PhpProg.php");
// include("EvalSectionException.php");

include("BTNode.php");

/**
 * @template AttributeType
 */
class BTree{

private $root;
private int $size;
private int $height;

function getSize() {
    return $this->size;   
}

function getHeight() {
    return $this->height;   
}

function resetSize() {
    $size =  $this->root->sizeBelow();
}

function resetHeight() {
    $height =  $this->root->height();
}

function print() {
    BTree::preOrderTraversal();
}

function insertData($treePath, $data){ 
    // if treePath = "R", it means that the data to insert will be the root
    
    if ($treePath=="R") {
        //var_dump ($data);
        $this->root = new BTNode($data);
        BTree::resetSize();
        BTree::resetHeight();
        return;
    }
    
    if ($this->root == null){
        $this->root = new BTNode(null);
    }
    $iter = $this->root;
    // And now we follow the tree path:
    for ($j = 0; $j < strlen($treePath) - 1; ++$j) {
        switch (substr($treePath, $j)) {
            case 'F':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
                break;
            case 'FF':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
                break;
            case 'FM':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
                break;
            case 'FFF':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
                break;
            case 'FFM':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
            case 'FMF':
                if (!$iter->hasLeft())
                    $iter->setLeft(new BTNode(null));
                $iter = $iter->getLeft();
            case 'M':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            case 'MM':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            case 'MF':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            case 'MMM':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            case 'MFM':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            case 'MFF':
                if (!$iter->hasRight())
                    $iter->setRight(new BTNode(null));
                $iter = $iter->getRight();
                break;
            default:
                throw new EvalSectionException("'F' or 'M' expected in treepath");
        }
    }   
    // Let's build the node to be plugged
    $N = new BTNode($data);

    if (substr($treePath, -1) == 'F') {
        $iter->setLeft($N);   
    }
    if (substr($treePath, -1) == 'M') {
        $iter->setRight($N);   
    }
    BTree::resetSize();
    BTree::resetHeight();
}

function preOrderTraversal() {
   
    BTree::preOrderTraversal2($this->root,0);  
}
function preOrderTraversal2($node, int $level) {
    for ( $i=0; $i<$level; ++$i){
        //System.out.print("  "); 
        echo("  ") ;
    }      
    if ($node == null) {
        //System.out.println("[]");
        echo("[]");
        return;
    } 
    $node->printNode();        
    BTree::preOrderTraversal2($node->getLeft(), $level+1);
    BTree::preOrderTraversal2($node->getRight(), $level+1);
}   

}

?>