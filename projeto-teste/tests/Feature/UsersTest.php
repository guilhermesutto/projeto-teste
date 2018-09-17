<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {               
        Storage::fake('local');

        $filePath='/tmp/randomstring.csv';
        
        file_put_contents($filePath, "HeaderA,HeaderB,HeaderC\n");

        $this->postJson('/upload', [
            'file' => new UploadedFile($filePath,'test.csv', null, null, null, true),
        ])->assertStatus(200);

        Storage::disk('local')->assertExists('test.csv');
        $response->assertStatus(200);
    }
}
