<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure API routes always return JSON
        $this->app->singleton('Illuminate\Contracts\Debug\ExceptionHandler', function ($app) {
            return new class($app) extends \Illuminate\Foundation\Exceptions\Handler {
                public function render($request, \Throwable $e): Response
                {
                    // If it's an API request, always return JSON
                    if ($request->expectsJson() || $request->is('api/*')) {
                        $status = 500;
                        $message = 'Internal Server Error';
                        
                        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                            $status = 404;
                            $message = 'Resource not found';
                        } elseif ($e instanceof \Illuminate\Validation\ValidationException) {
                            $status = 422;
                            $message = 'Validation failed';
                        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                            $status = 404;
                            $message = 'Route not found';
                        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                            $status = 405;
                            $message = 'Method not allowed';
                        }
                        
                        return new JsonResponse([
                            'success' => false,
                            'message' => $message,
                            'error' => $e->getMessage()
                        ], $status);
                    }
                    
                    return parent::render($request, $e);
                }
            };
        });
    }
}
