<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Family;
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Archive', route('home'));
});

Breadcrumbs::for('all families', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Families', route('all families'));
});

Breadcrumbs::for('family', function (BreadcrumbTrail $trail, Family $family) {
    $trail->parent('all families');
    $trail->push($family, route('family', $family));
});

/* Breadcrumbs::for('creature', function (BreadcrumbTrail $trail, $creature) {
    $trail->parent('family', 'r');
    $trail->push($creature->name, route('category', $creature));
}); */
