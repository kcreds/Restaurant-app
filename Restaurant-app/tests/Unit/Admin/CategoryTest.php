<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin);
    }

    public function testIndex()
    {
        Category::factory()->count(3)->create();

        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    public function testCreate()
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);
    }

    //Must have extension=gd in php.ini
    public function testStore()
    {
        Storage::fake('public');

        $categoryData = [
            'name' => 'Test Category',
            'description' => 'Test description',
            'image' => UploadedFile::fake()->image('category.jpg'),
        ];

        $response = $this->post(route('admin.categories.store'), $categoryData);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    public function testEdit()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('admin.categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewHas('category');
    }

    //Must have extension=gd in php.ini
    public function testUpdate()
    {
        Storage::fake('public');

        $category = Category::factory()->create();

        $categoryData = [
            'name' => 'Updated Category',
            'description' => 'Updated description',
            'image' => UploadedFile::fake()->image('updated-category.jpg'),
        ];

        $response = $this->put(route('admin.categories.update', $category), $categoryData);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Category',
        ]);
    }

    public function testDestroy()
    {
        Storage::fake('public');

        $category = Category::factory()->create();

        $response = $this->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
