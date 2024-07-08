<?php

namespace App;

class Alert
{
    public static function printMessage($text, $type)
    {
        $color = ($type == "Danger") ? "#f8d7da" : "#cce5ff";
        $borderColor = ($type == "Danger") ? "#f5c6cb" : "#b8daff";
        $textColor = ($type == "Danger") ? "#721c24" : "#004085";
        
        $message = "
        <div style='
            background-color: $color;
            color: $textColor;
            padding: 5px;
            margin: 0px 0;
            border: 1px solid $borderColor;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 12px;
            max-width: 300px;
            
        '>
            $text
        </div>";

        echo $message;
    }
}
?>
