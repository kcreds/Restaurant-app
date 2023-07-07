<?php

use App\Models\Menu;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

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
        $menus = Menu::factory()->count(5)->create();

        $response = $this->get(route('admin.menus.index'));

        $response->assertStatus(200);
        $response->assertViewHas('menus', $menus);
    }


    public function testCreate()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('admin.menus.create'));

        $response->assertStatus(200);
        $response->assertViewHas('categories', $categories);
    }

    public function testStore()
    {
        Storage::fake('public');

        $categories = Category::factory()->count(2)->create();

        $image = UploadedFile::fake()->image('menu.jpg');

        $data = [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image' => $image,
            'categories' => $categories->pluck('id')->toArray(),
        ];

        $response = $this->post(route('admin.menus.store'), $data);

        $response->assertRedirect(route('admin.menus.index'));
        $this->assertDatabaseHas('menus', [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => 'public/menus/' . $image->hashName(),
        ]);

        foreach ($categories as $category) {
            $this->assertDatabaseHas('category_menu', [
                'category_id' => $category->id,
                'menu_id' => Menu::latest()->first()->id,
            ]);
        }
    }

    public function testEdit()
    {
        $menu = Menu::factory()->create();
        $categories = Category::factory()->count(3)->create();

        $response = $this->get(route('admin.menus.edit', $menu));

        $response->assertStatus(200);
        $response->assertViewHas('menu', $menu);
        $response->assertViewHas('categories', $categories);
    }

    public function testUpdate()
    {
        $menu = Menu::factory()->create();

        $updatedData = [
            'name' => 'Updated Menu',
            'description' => 'Updated Description',
            'price' => 9.99,
        ];

        $image = UploadedFile::fake()->image('updated-image.jpg');

        $response = $this->put(route('admin.menus.update', $menu), array_merge($updatedData, ['image' => $image]));

        $response->assertRedirect(route('admin.menus.index'));

        $menu->refresh();

        $this->assertEquals($updatedData['name'], $menu->name);
        $this->assertEquals($updatedData['description'], $menu->description);
        $this->assertEquals($updatedData['price'], $menu->price);

        $this->assertEquals($menu->getOriginal('image'), $menu->image);
        $this->assertStringContainsString('menus/', $menu->image);

        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Menu updated successfully', session('success'));
    }


    public function testDestroy()
    {
        $menu = Menu::factory()->create();

        $response = $this->delete(route('admin.menus.destroy', $menu));

        $response->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseMissing('menus', ['id' => $menu->id]);

        $this->assertFalse(Storage::disk('public')->exists($menu->image));

        $this->assertTrue(session()->has('danger'));
        $this->assertEquals('Menu deleted successfully', session('danger'));
    }
}
