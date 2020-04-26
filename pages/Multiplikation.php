<?php
 $firstSub = $Sec->post("subVars");
 $secSubMat = $Sec->post("subMat");
 if(!empty($firstSub) || !empty($secSubMat)){
            if(!empty($secSubMat)){
                
                $des->show_submited_Mat($Sec->post("n1"), $Sec->post("m1"), 1);
                $des->show_submited_Mat($Sec->post("n2"), $Sec->post("m2"), 2);
                echo "<span class='Loesungsspan'>Der Lösungsvektor heißt</span>";
                echo "<div class='Loesungsdiv'>";
                $des->show(
                            $mat->Multiplikation(
                                $des->ret_submited_Mat($Sec->post("n1"), $Sec->post("m1"), 1),
                                $des->ret_submited_Mat($Sec->post("n2"), $Sec->post("m2"), 2)
                            )
                        );
                echo "</div>";
            }else{
                echo 
                "<form method='POST'>";
                $des->get_area($Sec->post("n§1"), $Sec->post("m§1"), 1);
                $des->get_area($Sec->post("n§2"), $Sec->post("m§2"), 2);
                $des->hidden("n1", $Sec->post("n§1"));
                $des->hidden("m1", $Sec->post("m§1"));
                $des->hidden("n2", $Sec->post("n§2"));
                $des->hidden("m2", $Sec->post("m§2"));
                $des->submit("subMat");
                echo "</form>";
            }
        }else{
            echo "Dimension ? ";
            echo 
            "<form method='POST'>";
                $des->select_box(1, 2);
                $des->select_box(2, 2);
                $des->submit("subVars");
            echo "</form>";
        }
?>