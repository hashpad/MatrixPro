<?php
 $firstSub = $Sec->post("subVars");
 $secSubMat = $Sec->post("subMat");
 if(!empty($firstSub) || !empty($secSubMat)){
            if(!empty($secSubMat)){
                
                $des->show_submited_Mat($Sec->post("p"), $Sec->post("p"), 1);
                echo "<span class='Loesungsspan'>Die Matrix hoch ".$Sec->post("n§1")." heißt</span>";
                echo "<div class='Loesungsdiv'>";
                $des->show(
                            $mat->Potenz(
                                $des->ret_submited_Mat($Sec->post("p"), $Sec->post("p"), 1),
                                $Sec->post("n§1")
                            )
                        );
                echo "</div>";
            }else{
                echo 
                "<form method='POST'>";
                $des->get_area($Sec->post("n§1"), $Sec->post("n§1"), 1);
                $des->select_box(1); // jetzt n heißt Potenz ab nächstes Post
                $des->hidden("p", $Sec->post("n§1")); // POST dimension nochmal als p
                $des->submit("subMat");
                echo "</form>";
            }
        }else{
            echo "Dimension ? ";
            echo 
            "<form method='POST'>";
                $des->select_box(1); // POST dimension zum ersten Mal als n
                $des->submit("subVars");
            echo "</form>";
        }
?>