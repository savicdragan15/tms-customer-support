<?php

namespace App\Repositories;

use App\Models\Issue;
use App\Models\IssueComment;
use App\Repositories\Interfaces\IssueCommentRepositoryInterface;

class IssueCommentRepository implements IssueCommentRepositoryInterface
{
    /**
     * Get's a comment by it's ID
     *
     * @param $issueId
     *
     * @return mixed
     */
    public function get($issueId)
    {
        return IssueComment::find($issueId);
    }

    /**
     * Get's all comment.
     *
     * @return Issue[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return IssueComment::all();
    }

    /**
     * Save a comment.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function save(array $data)
    {
        return IssueComment::create($data);
    }

    /**
     * Updates a comment.
     *
     * @param $issueId
     * @param array $data
     *
     * @return mixed|void
     */
    public function update($issueId, array $data)
    {
        IssueComment::find($issueId)->update($data);
    }

    /**
     * Delete a comment.
     *
     * @param $issueId
     * @return int|mixed
     */
    public function delete($issueId)
    {
       return IssueComment::destroy($issueId);
    }
}
