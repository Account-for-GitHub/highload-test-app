<?php

namespace app\dto;

class ConfigDTO 
{
    function __construct(
        public string $url,
        public int    $quantity,
        public string $request,
    )
    {
    }
}
