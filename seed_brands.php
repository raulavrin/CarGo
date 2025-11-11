<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$props = App\Models\Property::all();
foreach($props as $p){
    if(empty($p->brand)){
        $parts = preg_split('/\s+/', trim($p->title));
        $p->brand = $parts[0] ?? null;
        $p->save();
    }
}

echo "seeded\n";
