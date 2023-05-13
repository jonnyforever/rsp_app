<?php

namespace App\Helpers;

class GlobalFunctions
{
      public static function test()
      {
             echo "print test";
      }

      public static function pr($cnt, $return = false, $htmlentities = false){
        // modify output value for boolean argument
        if (is_bool($cnt)){
            if ($cnt === false) $cnt = "bool(false)";
            else if ($cnt === true) $cnt = "bool(true)";
        }
        // modify output value for null argument
        // modify output value for null argument
        else if (is_null($cnt)) {
            // remove the html entities tag in order to display the span style
            if ($htmlentities) $htmlentities = false;
            // styling the output to differ versions
            $cnt = "<span style=\"font-family:'Times New Roman'\">NULL</span>";
        }
        // setup output
        $output = "<pre>".print_r($cnt,true)."</pre>";
        // setup output for html entities
        if ($htmlentities) $output = "<pre>".htmlentities(print_r($cnt,true))."</pre>";
        // return output on request
        if ($return) return $output;
        // echo the output if return was not requested
        echo $output;
    }

}