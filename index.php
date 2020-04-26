<?php
session_start();
ob_start();
require_once("classes/config.php");
require_once("header.php");
define("page", $Sec->get("page"));
echo page;
echo '
</div>
<div class="classFunction">
                    <p>
';

switch(page){
    case "LGS":
       require_once("pages/LGS.php");
    break;
    case "Inverse":
        require_once("pages/Inverse.php");
    break;
    case "Determinante":
        require_once("pages/Determinante.php");
    break;
    case "Potenz":
        require_once("pages/Potenz.php");
    break;
    case "Transponierte":
        require_once("pages/Transponierte.php");
    break;
    case "Multiplikation":
        require_once("pages/Multiplikation.php");
    break;
    case "Addition":
        require_once("pages/Addition.php");
    break;
    case "Substraktion":
        require_once("pages/Substraktion.php");
    break;
    default:
        echo "Herzlich Wilkommen zu deinem Matrizen Werkzeug";
}
require_once("footer.php");

?>