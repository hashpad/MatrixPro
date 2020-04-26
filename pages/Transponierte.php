<?php
 $firstSub = $Sec->post("subVars");
 $secSubMat = $Sec->post("subMat");
 if(!empty($firstSub) || !empty($secSubMat)){
            if(!empty($secSubMat)){
                 
                $des->show_submited_Mat($Sec->post("n"), $Sec->post("m"), 1);
                echo "<span class='Loesungsspan'>Die transponierte Matrix heißt</span>";
                echo "<div class='Loesungsdiv'>";
                $des->show(
                            $mat->Transponiert(
                                $des->ret_submited_Mat($Sec->post("n"), $Sec->post("m"), 1)
                            )
                        );
                echo "</div>";
            }else{
                echo 
                "<form method='POST'>";
                $des->get_area($Sec->post("n§1"), $Sec->post("m§1"), 1);
                $des->hidden("n", $Sec->post("n§1"));
                $des->hidden("m", $Sec->post("m§1"));
                $des->submit("subMat");
                echo "</form>";
            }
        }else{
            echo "Dimension ? ";
            echo 
            "<form method='POST'>";
                $des->select_box(1, 2);
                $des->submit("subVars");
            echo "</form>";
        }
?>