<?php
namespace Tests\Feature\Api\V1\Admin;

use App\Models\Issue;
use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class IssueControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getAllIssuesWithAuthorizedUser(): void
    {
        factory(Issue::class, 10)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/v1/admin/issues');

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function failedToGetAllIssuesWithUnauthorizedUser(): void
    {
        $response = $this->getJson('/api/v1/admin/issues');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
