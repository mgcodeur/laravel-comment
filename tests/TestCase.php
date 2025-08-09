<?php

namespace Mgcodeur\LaravelComment\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mgcodeur\LaravelComment\LaravelCommentServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mgcodeur\\LaravelComment\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('password')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->text('content');
                $table->morphs('commentable');
                $table->nullableMorphs('commenter');
                $table->timestamps();
            });
        }

        config()->set('comment.models.comment', \Mgcodeur\LaravelComment\Models\Comment::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelCommentServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
