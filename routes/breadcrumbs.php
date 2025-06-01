<?php

use App\Models\Creature;
use App\Models\ExplorationArea;
use App\Models\ExplorationStory;
use App\Models\Family;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::macro('pageTitle', function () {
    $breadcrumb = Breadcrumbs::current();
    $resolvedTitle = $breadcrumb->pageTitle ?? $breadcrumb->title ?? '';

    $title = is_string($resolvedTitle) ? $resolvedTitle : '';

    return Str::trim($title);
});

Breadcrumbs::macro('headTitle', function () {
    $breadcrumb = Breadcrumbs::current();
    $resolvedTitle = $breadcrumb->pageTitle ?? $breadcrumb->title ?? '';

    if ($resolvedTitle === 'Archive') {
        return 'Unicreatures Archive';
    }

    $title = is_string($resolvedTitle) ? "{$resolvedTitle} |" : '';

    return Str::trim("{$title} UC Archive");
});

Breadcrumbs::for(
    'home',
    fn (BreadcrumbTrail $trail) =>
    $trail->push('Archive', route('home'))
);

Breadcrumbs::for(
    'creatures.index',
    fn (BreadcrumbTrail $trail) =>
    $trail
        ->parent('home')
        ->push('All families', route('creatures.index'))
);

Breadcrumbs::for(
    'creatures.family.show',
    fn (BreadcrumbTrail $trail, Family $family) =>
    $trail
        ->parent('creatures.index')
        ->push($family->name, route('creatures.family.show', $family), [
            'pageTitle' => "Family: {$family->name}",
        ])
);

Breadcrumbs::for(
    'creatures.family.creature.show',
    fn (BreadcrumbTrail $trail, Family $family, Creature $creature) =>
    $trail
        ->parent('creatures.family.show', $family)
        ->push($creature->name, route('creatures.family.creature.show', [$family, $creature]), [
            'pageTitle' => "Creature: {$creature->name}",
        ])
);

Breadcrumbs::for(
    'components.index',
    fn (BreadcrumbTrail $trail) =>
    $trail
        ->parent('home')
        ->push('Components', route('components.index'))
);

Breadcrumbs::for(
    'exploration.index',
    fn (BreadcrumbTrail $trail) =>
    $trail
        ->parent('home')
        ->push('Exploration', route('exploration.index'))
);

Breadcrumbs::for(
    'exploration.area.show',
    fn (BreadcrumbTrail $trail, ExplorationArea $explorationArea) =>
    $trail
        ->parent('exploration.index')
        ->push($explorationArea->name, route('exploration.area.show', $explorationArea), [
            'pageTitle' => "Exploration: {$explorationArea->name}",
        ])
);

Breadcrumbs::for(
    'exploration.area.story.show',
    fn (BreadcrumbTrail $trail, ExplorationArea $explorationArea, ExplorationStory $explorationStory) =>
    $trail
        ->parent('exploration.area.show', $explorationArea)
        ->push($explorationStory->title, route('exploration.area.story.show', [$explorationArea, $explorationStory]), [
            'pageTitle' => "Exploration Story: {$explorationStory->title}",
        ])
);
