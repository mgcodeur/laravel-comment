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
        ->and($comment->content)->toBe('This is a comment')
        ->and($comment->commenter_type)->toBe(User::class)
        ->and($comment->commenter_id)->toBe($user->getKey())
        ->and($comment->commentable_type)->toBe(Post::class)
        ->and($comment->commentable_id)->toBe($post->getKey());
});

test('Create a comment with a specific user', function () {
    $user = User::query()->create(['email' => 'a@b.c', 'name' => 'John Doe', 'password' => 'password']);
    $post = Post::query()->create(['title' => 'Hello', 'content' => 'World']);

    $commenter = User::query()->create(['email' => 'c@d.e', 'name' => 'Jane Doe', 'password' => 'password']);

    $comment = $post->comment('This is a comment', $commenter);

    expect($comment)->toBeInstanceOf(\Mgcodeur\LaravelComment\Models\Comment::class)
        ->and($comment->content)->toBe('This is a comment')
        ->and($comment->commenter_type)->toBe(User::class)
        ->and($comment->commenter_id)->toBe($commenter->getKey())
        ->and($comment->commentable_type)->toBe(Post::class)
        ->and($comment->commentable_id)->toBe($post->getKey());
});

it('fails when no commenter is passed', function () {
    $post = Post::query()->create(['title' => 'Hello']);

    expect(fn () => $post->comment('boom'))->toThrow(CommenterNotFoundException::class);
});
