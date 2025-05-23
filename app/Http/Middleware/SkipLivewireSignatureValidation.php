<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SkipLivewireSignatureValidation
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-Livewire') && $request->is('livewire/upload-file')) {
            $request->headers->set('X-Signature-Valid', 'true');
        }

        return $next($request);
    }
}
