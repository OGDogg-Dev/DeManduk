<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasCapability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$capabilities): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'Silakan masuk terlebih dahulu.');
        }

        $list = $this->normalizeCapabilities($capabilities);

        if (empty($list) || $user->hasAnyCapability($list)) {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses ke modul ini.');
    }

    /**
     * @param  list<string>  $capabilities
     * @return list<string>
     */
    private function normalizeCapabilities(array $capabilities): array
    {
        if (count($capabilities) === 1 && str_contains($capabilities[0], ',')) {
            return array_filter(array_map('trim', explode(',', $capabilities[0])));
        }

        return array_filter(array_map('trim', $capabilities));
    }
}
