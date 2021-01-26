<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Nominee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NomineeModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $nominee = Nominee::factory()->create();

        $this->assertEquals('/nominees/' . $nominee->id, $nominee->path());
    }
}
