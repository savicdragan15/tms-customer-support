<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Console\Commands\Issues\Create;
use App\Http\Requests\Issue\CreateRequest as CreateIssueRequest;
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
     * Store a newly created resource in storage.
     *
     * @param CreateIssueRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIssueRequest $request)
    {
        return $this->dispatch(new Create($request->all()));
    }

}
