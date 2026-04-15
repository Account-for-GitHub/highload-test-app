<?php

namespace app\request\senders;

use app\dto\ConfigDTO;

interface ISender
{
    public static function send(ConfigDTO $config);
}
