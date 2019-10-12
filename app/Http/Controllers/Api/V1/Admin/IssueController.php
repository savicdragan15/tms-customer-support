<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Console\Commands\Issues\Create;
use App\Http\Requests\Issue\CreateRequest as CreateIssueRequest;
use App\Models\Issue;
use App\Repositories\Interfaces\IssueRepositoryInterface;
use App\Http\Controllers\Controller;

class IssueController extends Controller
{
    /**
     * @var IssueRepositoryInterface
     */
    private $issue;

    /**
     * IssueController constructor.
     *
     * @param IssueRepositoryInterface $issue
     */
    public function __construct(IssueRepositoryInterface $issue)
    {
        $this->issue = $issue;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->issue->paginate(30);
    }

    /**
     * @param Issue $issue
     *
     * @return mixed
     */
    public function destroy(Issue $issue)
    {
        return $this->issue->delete($issue->id);
    }

}
