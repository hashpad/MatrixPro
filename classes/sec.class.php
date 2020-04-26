<?php
class sec {
    private $ret;
    public function post($val){
        $this->ret = isset($_POST[$val]) ? strip_tags(htmlspecialchars($_POST[$val])) : null; // Die Injektionen durch Post zu vermeiden
        return $this->ret;
    }
    public function get($val){
        $this->ret = isset($_GET[$val]) ? strip_tags(htmlspecialchars($_GET[$val])) : null; // Die Injektionen durch Get zu vermeiden
        return $this->ret;
    }
}

?>