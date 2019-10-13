<?php

namespace App\Repositories\Interfaces;


interface IssueCommentRepositoryInterface
{
    /**
     * Get's a comment by it's ID
     *
     * @param $issueId
     */
    public function get($issueId);

    /**
     * Get's all comments.
     *
     * @return mixed
     */
    public function all();

    /**
     * Save a comment.
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * Updates a comment.
     *
     * @param $issueId
     * @param $data
     * @return mixed
     */
    public function update($issueId, array $data);

    /**
     * Delete a comment.
     *
     * @param $issueId
     * @return mixed
     */
    public function delete($issueId);
}
