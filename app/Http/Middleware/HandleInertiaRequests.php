<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'success' => [
                    'form' => [
                        'store' => [
                            'categories' => fn () => $request->session()->get('flash.success.form.store.categories'),
                            'services' => fn () => $request->session()->get('flash.success.form.store.services'),
                            'projects' => fn () => $request->session()->get('flash.success.form.store.projects'),
                            'factors' => fn () => $request->session()->get('flash.success.form.store.factors'),
                            'extras' => fn () => $request->session()->get('flash.success.form.store.extras'),
                        ],
                        'update' => [
                            'categories' => fn () => $request->session()->get('flash.success.form.update.categories'),
                            'services' => fn () => $request->session()->get('flash.success.form.update.services'),
                            'projects' => fn () => $request->session()->get('flash.success.form.update.projects'),
                            'factors' => fn () => $request->session()->get('flash.success.form.update.factors'),
                            'extras' => fn () => $request->session()->get('flash.success.form.update.factors'),
                        ],
                    ],
                    'list' => [
                        'categories' => fn () => $request->session()->get('flash.success.list.categories'),
                        'services' => fn () => $request->session()->get('flash.success.list.services'),
                        'projects' => fn () => $request->session()->get('flash.success.list.projects'),
                        'factors' => fn () => $request->session()->get('flash.success.list.factors'),
                        'extras' => fn () => $request->session()->get('flash.success.list.extras'),
                    ],
                    'calculator' => [
                        'categories' => fn () => $request->session()->get('flash.success.calculator.categories'),
                        'services' => fn () => $request->session()->get('flash.success.calculator.services'),
                        'projects' => fn () => $request->session()->get('flash.success.calculator.projects'),
                        'factors' => fn () => $request->session()->get('flash.success.calculator.factors'),
                        'extras' => fn () => $request->session()->get('flash.success.calculator.extras'),
                    ],

                ],
                'failures' => [
                    'form' => [
                        'store' => [
                            'categories' => fn () => $request->session()->get('flash.failures.form.store.categories'),
                            'services' => fn () => $request->session()->get('flash.failures.form.store.services'),
                            'projects' => fn () => $request->session()->get('flash.failures.form.store.projects'),
                            'factors' => fn () => $request->session()->get('flash.failures.form.store.factors'),
                            'extras' => fn () => $request->session()->get('flash.failures.form.store.extras'),
                        ],
                        'update' => [
                            'categories' => fn () => $request->session()->get('flash.failures.form.update.categories'),
                            'services' => fn () => $request->session()->get('flash.failures.form.update.services'),
                            'projects' => fn () => $request->session()->get('flash.failures.form.update.projects'),
                            'factors' => fn () => $request->session()->get('flash.failures.form.update.factors'),
                            'extras' => fn () => $request->session()->get('flash.failures.form.update.extras'),
                        ],
                    ],
                    'list' => [
                        'categories' => fn () => $request->session()->get('flash.failures.list.categories'),
                        'services' => fn () => $request->session()->get('flash.failures.list.services'),
                        'projects' => fn () => $request->session()->get('flash.failures.list.projects'),
                        'factors' => fn () => $request->session()->get('flash.failures.list.factors'),
                        'extras' => fn () => $request->session()->get('flash.failures.list.extras'),
                    ],
                    
                    'calculator' => [
                        'categories' => fn () => $request->session()->get('flash.failures.calculator.categories'),
                        'services' => fn () => $request->session()->get('flash.failures.calculator.services'),
                        'projects' => fn () => $request->session()->get('flash.failures.calculator.projects'),
                        'factors' => fn () => $request->session()->get('flash.failures.calculator.factors'),
                        'extras' => fn () => $request->session()->get('flash.failures.calculator.extras'),
                    ],
                ],

            ],
        ]);
    }
}
