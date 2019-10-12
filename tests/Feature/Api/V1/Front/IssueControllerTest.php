<?php

namespace Tests\Feature\Api\V1\Front;

use App\Models\Issue;
use Illuminate\Http\Response;
use Tests\TestCase;

class IssueControllerTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     */
    public function createIssue()
    {
        $issue = factory(Issue::class)->make()->getAttributes();

        $response = $this->postJson('/api/v1/issues', $issue);

        unset($issue['terms']);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('issues', $issue);
    }

    /**
     * @dataProvider invalidData
     *
     * @test
     * @param $data
     * @param $error
     */
    public function failToCreateIssueWithInvalidRequest($data, $error)
    {
        $response = $this->postJson('/api/v1/issues', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertArraySubset($error, $response->getOriginalContent());
    }

    public function invalidData()
    {
        return [
            'invalid_data' => [
                'data' => [],
                'error' => [
                    'message' => 'The given data was invalid.',
                    'errors'=> [
                        "name" =>  [
                            0 => "The name field is required."
                        ],
                        "gender" => [
                            0 => "The gender field is required."
                        ],
                        "phone_number" => [
                            0 => "The phone number field is required."
                        ],
                        "description" => [
                            0 => "The description field is required."
                        ],
                        "terms" => [
                            0 => "The terms field is required."
                        ]
                    ]
                ]
            ]
        ];
    }
}
