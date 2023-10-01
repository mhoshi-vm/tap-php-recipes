<?php

namespace tappoc;

class HelloWorld
{
    public function respond(String $input)
    {
        $world = "World";
        if ($input !== "" && $input !== null){
            $world = $input;
        }
        return "Hello " . $world;
    }
}