<?php

namespace tappoc;

class HelloWorld
{
    public function respond($input)
    {
        $world = "World!";
        if ($input !== "" && $input !== null){
            $world = $input;
        }
        return "Hello " . $world;
    }
}