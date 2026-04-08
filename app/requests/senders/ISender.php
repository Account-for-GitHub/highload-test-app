<?php

namespace app\requests\senders;

use app\dto\ConfigDTO;

interface ISender
{
    public static function send(ConfigDTO $config, string $json_data);
}
