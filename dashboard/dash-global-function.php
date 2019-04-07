<?php
 function auto_copyright($year = 'auto'){ 
    if(intval($year) == 'auto'){ $year = date('Y'); }
    if(intval($year) == date('Y')){ echo intval($year); } 
    if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
    if(intval($year) > date('Y')){ echo date('Y'); } 
    } 

  function bg_color($color){
                    if ($color == 1) {
                        $bg_color = "bg-red";
                    }
                    else if ($color == 2) {
                        $bg_color = "bg-cyan";
                    }
                    else if ($color == 3) {
                        $bg_color = "bg-green";
                    }
                    else if ($color == 4) {
                        $bg_color = "bg-blue-grey";
                    }
                    else if ($color == 5) {
                        $bg_color = "bg-pink";
                    }
                    else if ($color == 6) {
                        $bg_color = "bg-light-blue";
                    }
                    else if ($color == 7) {
                        $bg_color = "bg-light-green ";
                    }
                    else if ($color == 8) {
                        $bg_color = "bg-amber";
                    }
                    else{
                        $bg_color = "";
                    }
                   echo $bg_color;
                 }

?>