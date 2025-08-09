<?php

namespace Mgcodeur\LaravelComment\Commands;

use Illuminate\Console\Command;

class LaravelCommentCommand extends Command
{
    public $signature = 'laravel-comment:install';

    public $description = 'Install the Laravel Comment package';

    private string $repositoryUrl = 'https://github.com/mgcodeur/laravel-comment';

    public function handle(): int
    {
        $this->info('Installing Laravel Comment package...');

        $this->call('vendor:publish', [
            '--tag' => 'comment-migrations',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'comment-config',
            '--force' => true,
        ]);

        if ($this->confirm('Would you like to give this repository a star on GitHub?', true)) {
            $this->info('Thank you! Opening the GitHub repository...');
            $this->openInBrowser($this->repositoryUrl);
        }

        return self::SUCCESS;
    }

    private function openInBrowser(string $url): void
    {
        match (PHP_OS_FAMILY) {
            'Windows' => exec('start "" '.escapeshellarg($url).' >NUL 2>&1'),
            'Darwin' => exec('open '.escapeshellarg($url).' >/dev/null 2>&1 &'),
            default => $this->tryLinuxOpen($url),
        };
    }

    private function tryLinuxOpen(string $url): void
    {
        if (shell_exec('command -v xdg-open')) {
            exec('xdg-open '.escapeshellarg($url).' >/dev/null 2>&1 &');
        } elseif (shell_exec('command -v gio')) {
            exec('gio open '.escapeshellarg($url).' >/dev/null 2>&1 &');
        } else {
            $this->warn("Cannot open browser automatically. Please visit: $url");
        }
    }
}
