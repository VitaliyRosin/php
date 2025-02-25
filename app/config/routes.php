<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'news/show' => [
        'controller' => 'news',
        'action' => 'show',
    ]
];

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');