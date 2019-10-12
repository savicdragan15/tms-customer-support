<?php

namespace App\Console\Commands\Issues;

use App\Models\Issue;
use App\Repositories\Interfaces\IssueRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * @var array
     */
    private $data;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:create {issue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create issue';

    /**
     * Create a new command instance.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct();
        $this->data = $data;
    }

    /**
     * Execute the console command.
     *
     * @param IssueRepositoryInterface $issue
     * @return mixed
     */
    public function handle(IssueRepositoryInterface $issue): ?Issue
    {
        if (array_key_exists('callback_date', $this->data)) {
            $this->data['callback_date'] = Carbon::parse($this->data['callback_date']);
        }

        return $issue->save($this->data);
    }
}
