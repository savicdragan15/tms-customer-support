<?php

namespace App\Repositories;

use App\Models\Issue;
use App\Repositories\Interfaces\IssueRepositoryInterface;

class IssueRepository implements IssueRepositoryInterface
{
    /**
     * Get's a issue by it's ID
     *
     * @param $issueId
     *
     * @return mixed
     */
    public function get($issueId)
    {
        return Issue::find($issueId);
    }

    /**
     * Get's all issues.
     *
     * @return Issue[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return Issue::all();
    }

    /**
     * Save a issue.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function save(array $data)
    {
        return Issue::create($data);
    }

    /**
     * Updates a issue.
     *
     * @param $issueId
     * @param array $data
     *
     * @return mixed|void
     */
    public function update($issueId, array $data)
    {
        Issue::find($issueId)->update($data);
    }

    /**
     * Delete a issue.
     *
     * @param $issueId
     *
     * @return int|mixed
     */
    public function delete($issueId)
    {
       return Issue::destroy($issueId);
    }

    /**
     * @param int $perPage
     * @param int $page
     * @param array $relations
     *
     * @return mixed
     */
    public function paginate($perPage = 10, $page = 1, $relations = [])
    {
        return Issue::with($relations)->paginate($perPage, $columns = ['*'], $pageName = 'page', $page = null);
    }
}
