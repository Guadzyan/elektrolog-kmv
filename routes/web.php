<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/sitemap.xml', function () {
    $urls = [
        url('/'),
        url('/#about'),
        url('/#price'),
        url('/#book'),
        url('/#contacts'),
    ];

    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $loc) {
        $xml .= "  <url><loc>" . e($loc) . "</loc></url>\n";
    }
    $xml .= "</urlset>\n";

    return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
});
