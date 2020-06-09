<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('Home'), route('home'));
});


// Home > Equipment
Breadcrumbs::for('equipment', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Equipment'), route('equipment.index'));
});

// Home > Equipment > Item
Breadcrumbs::for('equipment.show', function ($trail, $equipment) {
    $trail->parent('equipment');
    $trail->push($equipment->trans('name'), route('equipment.show', $equipment));
});


// Home > Parts
Breadcrumbs::for('parts', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Parts'), route('parts.index'));
});

// Home > Parts > Item
Breadcrumbs::for('parts.show', function ($trail, $part) {
    $trail->parent('parts');
    $trail->push($part->trans('name'), route('parts.index', $part), ['producer_id' => $part->producer_id]);
});


// Home > News
Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push(__('News'), route('news.index'));
});

// Home > News > Item
Breadcrumbs::for('news.show', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->trans('title'), route('news.index', $news));
});

// Home > Services
Breadcrumbs::for('services', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Services'), route('services'));
});

// Home > Contacts
Breadcrumbs::for('contacts', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Contacts'), route('contacts'));
});

// Home > Search
Breadcrumbs::for('search', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Search'), route('search'));
});

// Home > Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Cart'), route('cart'));
});

// Home > Cart > Checkout
Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('cart');
    $trail->push(__('Checkout'), route('checkout'));
});

// Home > 404
Breadcrumbs::for('404', function ($trail) {
    $trail->parent('home');
    $trail->push('404');
});

// Home > Unsibscribe
Breadcrumbs::for('subscribe', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Subscribe'));
});


// Home > Unsibscribe
Breadcrumbs::for('unsubscribe', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Unsubscribe'));
});

// Home > Order created
Breadcrumbs::for('order-created', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Order created'));
});