<?php

namespace Mgcodeur\LaravelComment;

use Mgcodeur\LaravelComment\Commands\LaravelCommentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCommentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-comment')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_comments_table')
            ->hasCommand(LaravelCommentCommand::class);
    }
}
