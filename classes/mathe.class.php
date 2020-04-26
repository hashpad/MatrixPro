<?php
require_once("sec.class.php");
class Matrix extends sec {
    // LINES


    protected function get_line($Mat){
        return sizeof($Mat);
    }

    // Columns
    protected function get_column($Mat){
        return sizeof($Mat[0]);
    }


    // CHECK IF THE MATRIXES HAVE THE SAME NUMBER OF LINES
    public function same_lines($Array){
        $check = TRUE;
        for($n=0; $n<sizeof($Array); $n++){
            if(self::get_line($Array[0]) != self::get_line($Array[$n])){
                $check = FALSE;
            }
        }
        return $check;
    }



    // faire une matrice triangulaire inferieure
    public function Gauss_Inf(){
        $Mat = func_get_args();
            if(
                self::same_lines($Mat)
            )
            {
                for($k=0; $k<self::get_line($Mat[0]); $k++){
                    for($i=$k+1; $i<self::get_line($Mat[0]); $i++){
                            $fix = $Mat[0][$i][$k];   // Without this variable it wont work because of first implementation (fix the first term)
                            $fix2 = $Mat[0][$k][$k];
                            for($j=$k; $j<self::get_column($Mat[0]); $j++){
                                if($fix2 != 0){
                                    $Mat[0][$i][$j] = $Mat[0][$i][$j] + $Mat[0][$k][$j]*(-$fix/$fix2);
                                }
                            }
                            for($m=1; $m<func_num_args(); $m++){
                                for($l=0; $l<self::get_column($Mat[$m]); $l++){
                                    if($fix2 != 0){
                                        $Mat[$m][$i][$l] = $Mat[$m][$i][$l] + $Mat[$m][$k][$l]*(-$fix/$fix2);
                                    }
                                }
                            }
                    }
                }
            }else{
                die("Not same dimensions <br />");
            }
        return $Mat;
    }





    // faire une matrice inferieure superieure
    public function Gauss_Sup(){
        $Mat = func_get_args();
        if(
            self::same_lines($Mat)
        )
        {
            for($k=self::get_line($Mat[0])-1; $k>=0; $k--){
                for($i=0; $i<$k; $i++){
                        $fix = $Mat[0][$i][$k];   // Without this variable it wont work because of first implementation (fix the first term)
                        $fix2 = $Mat[0][$k][$k];
                        for($j=$k; $j<self::get_column($Mat[0]); $j++){
                            if($fix2 != 0){
                                $Mat[0][$i][$j] = $Mat[0][$i][$j] + $Mat[0][$k][$j]*(-$fix/$fix2);
                            }
                        }
                        for($m=1; $m<func_num_args(); $m++){
                            for($l=0; $l<self::get_column($Mat[$m]); $l++){
                                if($fix2 != 0){
                                    $Mat[$m][$i][$l] = $Mat[$m][$i][$l] + $Mat[$m][$k][$l]*(-$fix/$fix2);
                                }
                            }
                        }
                }
            }
        }else{
            die("Not same dimensions <br />");
        }
        return $Mat;
    }


    // MAKE ONES
    public function makeOnes(){
        $Mat = func_get_args();
        for($i=0; $i<self::get_line($Mat[0]); $i++){
            for($j=0; $j<self::get_column($Mat[0]); $j++){
                if($i==$j){
                    $fix = $Mat[0][$i][$j];
                    $Mat[0][$i][$j] = 1;
                    for($k=1; $k<sizeof($Mat);$k++){
                        for($n=0; $n<self::get_column($Mat[$k]); $n++){
                            $Mat[$k][$i][$n] = $Mat[$k][$i][$n]/$fix;
                        }
                    }
                }
            }
        }
        return $Mat;
    }

    // LGS !!!!!!!!!!!!!!!!!
    public function LGS($M1, $M2){
        if(self::get_line($M1) == self::get_line($M2) && self::get_column($M2) == 1){
            $GI = self::Gauss_Sup($M1,$M2);
            $GS = self::Gauss_Inf($GI[0],$GI[1]);
            $RE = self::makeOnes($GS[0],$GS[1]);
            return $RE[1];
        }else{
            die("Kein System ' ist sicher :D ' <br />");
        }
    }


    // ONES EINHEIT

    public function getUnit($Dim){
        $Mat = [];
        for($i = 0; $i<$Dim; $i++){
            $Mat+=[[]];
            for($j = 0; $j<$Dim; $j++){
                if($i==$j){
                    $Mat[$i][$j]=1;
                }else{
                    $Mat[$i][$j]=0;
                }
            }
        }
        return $Mat;
    }

    // INVERSE !!!!!!!!!!!!!!!

    public function Inverse($M){
        if(self::get_line($M)==self::get_column($M)){
            $GU = self::getUnit(self::get_line($M));
            $GI = self::Gauss_Inf($M,$GU);
            $GS = self::Gauss_Sup($GI[0],$GI[1]);
            $RE = self::makeOnes($GS[0],$GS[1]);
            return $RE[1];
        }else{
            die("Nicht quadratisch <br />");
        }
    }

    // Determinant

    public function Det($M){
        if(self::get_line($M)==self::get_column($M)){
            $DP = 1;
            $GI = self::Gauss_Inf($M);
            for($i=0; $i<self::get_line($GI[0]); $i++){
                for($j=0; $j<self::get_column($GI[0]); $j++){
                    if($i==$j){
                        $DP*=$GI[0][$i][$j];
                    }
                }
            }
            return $DP;
        }else{
            die("Nicht quadratisch <br />");
        }
    }

    // einfache Funktionen

        // einfache Multiplikation
    public function Multiplikation($M1, $M2){
        if(self::get_column($M1) === self::get_line($M2)){
            $Mat = [];
            for($i=0; $i<self::get_line($M1); $i++){
                $Mat+=[[]];
                for($j=0; $j<self::get_column($M2); $j++)
                {   
                    $Summe = 0;
                    for($k=0; $k<self::get_column($M1); $k++){
                        $Summe += $M1[$i][$k]*$M2[$k][$j];
                    }
                    $Mat[$i][$j]=$Summe;
                }
            }
            return $Mat;
        }else{
            die("Problem der Dimensionen <br />");
        }        
    }

        // einfache Addition

    public function Addition($M1, $M2){
        if(
            self::get_line($M1) === self::get_line($M2)
            &&
            self::get_column($M1) === self::get_column($M2)
            ){
                $Mat = [];
                for($i=0; $i<self::get_line($M1); $i++){
                    $Mat += [[]];
                    for($j=0; $j<self::get_column($M1); $j++){
                        $Mat[$i][$j] = $M1[$i][$j] + $M2[$i][$j];
                    }
                }
                return $Mat;
            }else{
                die("Not same dimensions <br />");
            }
    }


        // einfache Substraktion


    public function Substraktion($M1, $M2){
        if(
            self::get_line($M1) === self::get_line($M2)
            &&
            self::get_column($M1) === self::get_column($M2)
            ){
                $Mat = [];
                for($i=0; $i<self::get_line($M1); $i++){
                    $Mat += [[]];
                    for($j=0; $j<self::get_column($M1); $j++){
                        $Mat[$i][$j] = $M1[$i][$j] - $M2[$i][$j];
                    }
                }
                return $Mat;
            }else{
                die("Not same dimensions <br />");
            }
    }

    
    // Rekursive Funktionen
        // Vielfache Multiplikation
            // Potenz

    public function Potenz($M, $n){
        if(self::get_line($M) === self::get_column($M)){
                if($n==1){
                    return $M;
                }else{
                    return self::Multiplikation($M, self::Potenz($M, $n - 1));
                    }
            }else{
                die("Nicht quadratisch <br />");
            }
        }

    public function Transponiert($M){
        $Mat = [];
        for($i = 0 ; $i<self::get_column($M); $i++){
            $Mat += [[]];
            for($j = 0 ; $j<self::get_line($M); $j++){
                $Mat[$i][$j] = $M[$j][$i];
            }
        }
        return $Mat;
    }


    

    
}








class Design extends Matrix {





    // überflüssig
    private function get_fraction($val){
        return $val-floor();
    }

    // count irrelevant seh nächste Funktion ( INCEPTION )
    private function count_dimension($Array, $count = 0) {
        if(is_array($Array)) {
           return $this->count_dimension(current($Array), ++$count);
        } else {
           return $count;
        }
    }

    // die vorherige Funktion benutzen um zu entscheiden ob es Array in Array or einfaches Array
    private function multiple_Mats($Array){
        if(self::count_dimension($Array) >= 3){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    // select box generieren, wenn n leer oder ungleich 2 zeig ein Option wenn 2 zwei optionen ( Fall 2 Matrizen sind benötigt )

    public function select_box($kennZeichen, $n = false){
        if($n == 2){
            echo "<select name='n§".$kennZeichen."'>";
            for($j=1; $j<=100; $j++){
                echo "<option value='".$j."'>".$j."</option>";
            }
            echo "</select> x "; 
            echo "<select name='m§".$kennZeichen."'>";
            for($j=1; $j<=100; $j++){
                echo "<option value='".$j."'>".$j."</option>";
            }
            echo "</select> - "; 
        }else{
            echo "<select name='n§".$kennZeichen."'>";
            for($j=1; $j<=100; $j++){
                echo "<option value='".$j."'>".$j."</option>";
            }
            echo "</select>"; 
        }

    }
    // HIDDEN INPUT den alten Wert speichern
    public function hidden($Name, $val){
        echo "<input type='hidden' name='".$Name."' value='".$val."' />";
    }

    // Submit button mit Namen als Parameter

    public function submit($Name){
        echo "<input type='submit' name='".$Name."' value='fertig' />";
    }

    // tabelle in der die Matrix eingegeben werden muss
    public function get_area($n, $m, $kennZeichen){
        echo "<table border='1' style='text-align: center; float: left; margin-right: 10px;'>";
        for($i=0; $i<$n; $i++){
            echo "<tr>";
            for($j=0; $j<$m; $j++){
                    echo "<td><input style='width: 20px; text-align: center;' type='text' name='".$i."§".$j."§".$kennZeichen."' /></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // die eingegeben Matrix in einer Tabelle implementieren
    public function show_submited_Mat($lines, $columns, $kennZeichen){
        self::show(self::ret_submited_Mat($lines, $columns, $kennZeichen));
    }

    // die eingegeben Matrix in einer Tabelle zurückgeben

    public function ret_submited_Mat($lines, $columns, $kennZeichen){
        $Mat = [];
        for ($i = 0; $i<$lines; $i++){
            $Mat += [[]];
            for ($j = 0; $j<$columns; $j++){
                $Mat[$i][$j] = parent::post($i."§".$j."§".$kennZeichen);
            }
        }
        return $Mat;
    }
    // Show a matrix as a table
    public function show($Mat_Arr){
        if(self::multiple_Mats($Mat_Arr)){
            for($l = 0; $l<sizeof($Mat_Arr); $l++){
                echo "<table border='1' style='text-align: center;float: left;margin-right: 10px;'>";
                for($i=0; $i<parent::get_line($Mat_Arr[$l]); $i++){
                    echo "<tr>";
                    for($j=0; $j<parent::get_column($Mat_Arr[$l]); $j++){
                        if(!strstr(strval($Mat_Arr[$l][$i][$j]), "E-")){
                            echo "<td style='width: 20px;'>".$Mat_Arr[$l][$i][$j]."</td>";
                        }else{
                            echo "<td style='width: 20px;'>0</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }else{
            echo "<table border='1' style='text-align: center; float: left; margin-right: 10px;'>";
                for($i=0; $i<parent::get_line($Mat_Arr); $i++){
                    echo "<tr>";
                    for($j=0; $j<parent::get_column($Mat_Arr); $j++){
                        if(!strstr(strval($Mat_Arr[$i][$j]), "E-")){
                            echo "<td style='width: 20px;'>".$Mat_Arr[$i][$j]."</td>";
                        }else{
                            echo "<td style='width: 20px;'>0</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table>";
        }
    }

    // 
    
}



/*
public function Gauss_Inf($Mat1, $Mat2){
        if(
            self::get_line($Mat1) == self::get_line($Mat2)
            &&
            self::get_line($Mat1) == self::get_column($Mat1)
          )
        {
            for($k=0; $k<self::get_line($Mat1); $k++){
                for($i=$k+1; $i<self::get_line($Mat1); $i++){
                        $fix = $Mat1[$i][$k];   // Without this variable it wont work because of first implementation (fix the first term)
                        $fix2 = $Mat1[$k][$k];
                        for($j=$k; $j<self::get_column($Mat1); $j++){
                            $Mat1[$i][$j] = $Mat1[$i][$j] + $Mat1[$k][$j]*(-$fix/$fix2);
                        }
                        for($l=0; $l<self::get_column($Mat2); $l++){
                            $Mat2[$i][$l] = $Mat2[$i][$l] + $Mat2[$k][$l]*(-$fix/$fix2);
                        }
                }
            }
        }
        return array($Mat1, $Mat2);
    }
    public function Gauss_Sup($Mat1, $Mat2){
        if(
            self::get_line($Mat1) == self::get_line($Mat2)
            &&
            self::get_line($Mat1) == self::get_column($Mat1)
          )
        {
            for($k=self::get_line($Mat1)-1; $k>=0; $k--){
                for($i=0; $i<$k; $i++){
                        $fix = $Mat1[$i][$k];   // Without this variable it wont work because of first implementation (fix the first term)
                        $fix2 = $Mat1[$k][$k];
                        for($j=$k; $j<self::get_column($Mat1); $j++){
                            $Mat1[$i][$j] = $Mat1[$i][$j] + $Mat1[$k][$j]*(-$fix/$fix2);
                        }
                        for($l=0; $l<self::get_column($Mat2); $l++){
                            $Mat2[$i][$l] = $Mat2[$i][$l] + $Mat2[$k][$l]*(-$fix/$fix2);
                        }
                }
            }
        }
        return array($Mat1, $Mat2);
    }

*/
?>