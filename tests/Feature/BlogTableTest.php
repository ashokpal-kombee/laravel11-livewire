<?php

use App\Models\Blog;
use function Pest\Livewire\livewire;

test('Database has blogs', function () {
    $blogs = Blog::all();

    expect($blogs->count())->toBeGreaterThan(0);
});

test('Blog table renders successfully', function () {
    $this->get('/')
        ->assertOK()
        ->assertSeeLivewire('blog-table');
});