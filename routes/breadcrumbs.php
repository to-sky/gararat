<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('Home'), route('home'));
});


// Home > Catalog
Breadcrumbs::for('catalog', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Catalog'), route('catalog.index'));
});


// Home > Catalog > Category
Breadcrumbs::for('category', function ($trail, $equipmentCategory) {
    $trail->parent('catalog');
    $trail->push($equipmentCategory->trans('name'), route('catalog.category', $equipmentCategory));
});


// Home > Catalog > Category > Equipment
Breadcrumbs::for('equipment', function ($trail, $equipment) {
    $trail->parent('category', $equipment->equipmentCategory->parent);
    $trail->push($equipment->trans('name'), route('equipment.show', [
        'equipmentCategory' => $equipment->equipmentCategory,
        'equipment' => $equipment
    ]));
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


// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Blog'), route('posts.index'));
});

// Home > Blog > Post
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('blog');
    $trail->push($post->trans('title'), route('posts.index', $post));
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
