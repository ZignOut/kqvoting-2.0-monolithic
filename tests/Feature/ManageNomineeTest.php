<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Nominee;
use Tests\TestCase;

class ManageNomineeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_manage_nominees()
    {
        // assert that guest cannot see all all nominees
        $test_nominees = Nominee::factory(2)->create();
        $this->get('/nominees')
            ->assertStatus(302);

        // assert that guest cannot see requested nominee
        $this->get($test_nominees[0]->path().'/show')
            ->assertStatus(302);

        // assert that guest cannot create nominee page
        $this->get('/nominees/create')
            ->assertStatus(302);

        // assert that guest cannot insert new nominee
        $test_nominee = Nominee::factory()->raw();

        $this->post('/nominees', $test_nominee)
            ->assertStatus(302);
        
        $this->assertDatabaseMissing('nominees', $test_nominee);

        // assert that guest cannot update nominee
        $updated_nominee = [
            'name' => 'Hein Htet Aung',
            'class' => '1CST-A',
            'age' => 17,
            'hobby' => 'reading',
            'description' => 'Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.'
        ];

        $this->put($test_nominees[0]->path(), $updated_nominee)
            ->assertStatus(302);
        
        $this->assertDatabaseMissing('nominees', $updated_nominee);

        // assert that guest cannot delete nominee
        $test_nominee = [
            'name' => 'HHA',
            'class' => '1CST-A',
            'age' => 17,
            'hobby' => 'reading',
            'description' => 'Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.'
        ];
        $deleted_nominee = Nominee::factory()->create($test_nominee);
        
        $this->delete($deleted_nominee->path())
            ->assertStatus(302);
            
        $this->assertDatabaseHas('nominees', $test_nominee);
    }

    /** @test */
    public function only_authenticated_users_can_manage_nominees()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        // assert that user see all nominees
        $test_nominees = Nominee::factory(2)->create([
            'name' => 'HHA',
            'class' => '1CST-A',
            'age' => 17,
            'hobby' => 'reading',
            'description' => 'Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.'
        ]);

        $this->get('/nominees')
            ->assertStatus(200)
            ->assertPropCount('nominees', 2)
            ->assertPropValue('nominees', function ($nominees) {
                foreach ($nominees as $id => $nominee) {
                    $this->assertEquals('HHA', $nominee['name']);
                    $this->assertEquals('1CST-A', $nominee['class']);
                    $this->assertEquals(17, $nominee['age']);
                    $this->assertEquals('reading', $nominee['hobby']);
                    $this->assertEquals('Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.', $nominee['description']);
                }
            });

        // assert that user see all requested nominee
        $this->get($test_nominees[0]->path().'/show')
            ->assertStatus(200)
            ->assertPropCount('nominee', 8)
            ->assertPropValue('nominee', function ($nominee) {
                $this->assertEquals('HHA', $nominee['name']);
                $this->assertEquals('1CST-A', $nominee['class']);
                $this->assertEquals(17, $nominee['age']);
                $this->assertEquals('reading', $nominee['hobby']);
                $this->assertEquals('Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.', $nominee['description']);
            });

        // assert that user create nominee page
        $this->get('/nominees/create')
            ->assertStatus(200);

        // assert that user can insert new nominee
        $test_nominee = Nominee::factory()->raw([
            'name' => 'HHA',
            'class' => '1CST-A',
            'age' => 17,
            'hobby' => 'reading',
            'description' => 'Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.'
        ]);

        $this->post('/nominees', $test_nominee)
            ->assertStatus(302);
        
        $this->assertDatabaseHas('nominees', $test_nominee);

        // assert that user can update nominee
        $updated_nominee = [
            'name' => 'Hein Htet Aung',
            'class' => '1CST-A',
            'age' => 17,
            'hobby' => 'reading',
            'description' => 'Elit sint eiusmod esse ea nostrud laboris nostrud ut ea in sint occaecat consequat aliquip. In aute eu nostrud tempor anim do elit Lorem. Tempor dolor ex qui amet do fugiat dolore ipsum Lorem duis adipisicing sint consequat sint. Et cillum consequat incididunt fugiat Lorem est voluptate.'
        ];

        $this->put($test_nominees[0]->path(), $updated_nominee)
            ->assertStatus(302);
        
        $this->assertDatabaseHas('nominees', $updated_nominee);

        // assert that user can delete nominee
        $deleted_nominee = Nominee::factory()->create();

        $this->delete($deleted_nominee->path())
            ->assertStatus(302);
        
        $this->assertDatabaseMissing('nominees', $deleted_nominee->toArray());
    }
}
