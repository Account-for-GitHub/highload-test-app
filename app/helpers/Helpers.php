<?php

namespace app\helpers;

use app\models\Request;

class Helpers
{
    public static function getFirst(string $string, int $number): string
    {
        return substr($string, 0, $number) . '...';
    }

    public static function waitUntilRequestsPerformed(): void
    {
        $i = 0;
        while ($i < 1000) {
            /** @var Request $request */
            $request = Request::with('responses')->latest()->first();
            $quantity = $request->quantity;
            if($request->responses()->count() < $quantity){
                ++$i;
            } else {
                return;
            }
        }
    }
}
