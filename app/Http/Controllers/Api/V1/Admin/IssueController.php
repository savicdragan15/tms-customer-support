<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Issue;
use App\Repositories\Interfaces\IssueRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->issue->paginate(10, $request->get('page'), ['comments']);
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
