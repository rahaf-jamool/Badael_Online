<?php

namespace App\Traits;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
trait GeneralTrait
{
    public function SuccessMessage($route,$msg )
    {
        return redirect ()->route ($route)
            ->with('success', 'Data ' .$msg. ' successfully');
    }

    public function ErrorMessage($route,$msg )
    {
        return redirect ()->route ($route)
            ->withErrors('error', 'Error ' .$msg);
    }
}
