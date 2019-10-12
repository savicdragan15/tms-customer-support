<?php


namespace App\Repositories;

use App\Repositories\Interfaces\IssueRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
       $this->app->bind(
           IssueRepositoryInterface::class,
           IssueRepository::class
       );
    }
}
