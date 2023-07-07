<?php

use Tests\TestCase;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TableTest extends TestCase
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
        $tables = Table::factory()->count(5)->create();

        $response = $this->get(route('admin.tables.index'));

        $response->assertStatus(200);
        $response->assertViewHas('tables', $tables);
    }

    public function testCreate()
    {
        $response = $this->get(route('admin.tables.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.tables.create');
    }

    public function testStore()
    {
        $tableData = Table::factory()->raw();

        $response = $this->post(route('admin.tables.store'), $tableData);

        $response->assertRedirect(route('admin.tables.index'));
        $this->assertDatabaseHas('tables', $tableData);
    }

    public function testEdit()
    {
        $table = Table::factory()->create();

        $response = $this->get(route('admin.tables.edit', $table));

        $response->assertStatus(200);
        $response->assertViewHas('table', $table);
    }

    public function testUpdate()
    {
        $table = Table::factory()->create();
        $updatedData = [
            'name' => 'Updated Name',
            'guest_number' => 5,
            'status' => 'updated_status',
            'location' => 'updated_location',
        ];

        $response = $this->put(route('admin.tables.update', $table), $updatedData);

        $response->assertRedirect(route('admin.tables.index'));
        $this->assertDatabaseHas('tables', array_merge(['id' => $table->id], $updatedData));
    }

    public function testDestroy()
    {
        $table = Table::factory()->create();

        $response = $this->delete(route('admin.tables.destroy', $table));

        $response->assertRedirect(route('admin.tables.index'));
        $this->assertDatabaseMissing('tables', ['id' => $table->id]);
        $this->assertDatabaseMissing('reservations', ['table_id' => $table->id]);
    }
}
