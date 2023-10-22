<?php

namespace Tests\Feature;

use App\Domain\User\BLL\Auth\AuthBLL;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $authBLL = app()->make(AuthBLL::class);

        // Create a user using factory or a real user from your database.
        $user = User::factory()->create([
            'password' => bcrypt('password')
        ]);

        // Authenticate the user and obtain a Bearer token.
        $this->token = $authBLL->createToken($user);
    }

    public function test_unauthenticated_user_cannot_upload_image()
    {
        // Mock an image file for upload.
        $file = UploadedFile::fake()->image('test_image.jpg');

        // Send a POST request to the image upload endpoint.
        $response = $this->json('POST', '/api/v1/file/upload', ['file' => $file]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_upload_image()
    {
        // Mock an image file for upload.
        $file = UploadedFile::fake()->image('test_image.jpg');

        // Send a POST request to the image upload endpoint.
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                        ->json('POST', '/api/v1/file/upload', ['file' => $file]);

        $response->assertStatus(200);

        // Assert that the response contains the expected JSON structure.
        $response->assertJsonStructure([
            'success',
            'data' => [
                'uuid'
            ]
        ]);
    }

    public function test_get_uploaded_image()
    {
        // Mock an image file for upload.
        $file = UploadedFile::fake()->image('test_image.jpg');

        // Send a POST request to the image upload endpoint.
        $saveImage = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->json('POST', '/api/v1/file/upload', ['file' => $file]);

        $uploadedFile = $saveImage->json();

        $response = $this->json('GET', '/api/v1/file/'.$uploadedFile['data']['uuid']);
        $response->assertStatus(200);

        // Assert that the response contains the expected JSON structure.
        $response->assertJsonStructure([
            'success',
            'data' => [
                'uuid'
            ]
        ]);
    }
}
