<?php
    function toJSON($json){
        return json_encode(json_decode($json));
    }
?>