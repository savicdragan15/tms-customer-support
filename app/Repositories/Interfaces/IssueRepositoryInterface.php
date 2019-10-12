<?php

namespace App\Repositories\Interfaces;


interface IssueRepositoryInterface
{
    /**
     * Get's a issue by it's ID
     *
     * @param $issueId
     */
    public function get($issueId);

    /**
     * Get's all issues.
     *
     * @return mixed
     */
    public function all();

    /**
     * Save a issue.
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * Updates a issue.
     *
     * @param $issueId
     * @param $data
     * @return mixed
     */
    public function update($issueId, array $data);

    /**
     * Delete a issue.
     *
     * @param $issueId
     * @return mixed
     */
    public function delete($issueId);

    /**
     * Pagination
     *
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 10);
}
