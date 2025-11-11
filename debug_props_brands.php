<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$props = App\Models\Property::all()->map(function($p){
    return [
        'id' => $p->id,
        'title' => $p->title,
        'brand' => $p->brand,
        'type' => $p->type,
        'property_type' => $p->property_type,
    ];
});

echo json_encode($props->toArray(), JSON_PRETTY_PRINT);
