<pre>
<?php
require_once("classes/mathe.class.php");
$mat = new Matrix();
$des = new Design();
// $des->select_box("dimension");
$M1 = [
    [16],[37],[-24]
    ];
$M2 = [
    [4,-3,2],
    [8,-6,5],
    [2,5,-8]    
];
 $C = $mat->Gauss_Sup($M2,$M1);
 $Q = $mat->Gauss_Inf($C[0], $C[1]);
    echo $des->show($mat->makeOnes($Q[0], $Q[1]));
?>
</pre>