<?php

use Mgcodeur\LaravelComment\Exceptions\CommenterNotFoundException;
use Mgcodeur\LaravelComment\Tests\Fixtures\Post;
use Mgcodeur\LaravelComment\Tests\Fixtures\User;

test('Create a comment with the authenticated user', function () {
    $user = User::query()->create(['email' => 'a@b.c', 'name' => 'John Doe', 'password' => 'password']);
    $post = Post::query()->create(['title' => 'Hello', 'content' => 'World']);

    $this->actingAs($user);

    $comment = $post->comment('This is a comment');

    expect($comment)->toBeInstanceOf(\Mgcodeur\LaravelComment\Models\Comment::class)
        ->and($comment->content)->toBe('This is a comment');
});

test('Create a comment with a specific user', function () {
    $user = User::query()->create(['email' => 'a@b.c', 'name' => 'John Doe', 'password' => 'password']);
    $post = Post::query()->create(['title' => 'Hello', 'content' => 'World']);

    $commenter = User::query()->create(['email' => 'c@d.e', 'name' => 'Jane Doe', 'password' => 'password']);

    $comment = $post->comment('This is a comment', $commenter);

    expect($comment)->toBeInstanceOf(\Mgcodeur\LaravelComment\Models\Comment::class)
        ->and($comment->content)->toBe('This is a comment');
});

it('fails when no commenter is passed', function () {
    $post = Post::query()->create(['title' => 'Hello']);

    expect(fn () => $post->comment('boom'))->toThrow(CommenterNotFoundException::class);
});
