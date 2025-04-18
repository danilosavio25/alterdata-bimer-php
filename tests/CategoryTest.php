<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Category;

class CategoryTest extends ResourceTest
{
    public function setUp(): void
    {
        $this->resource = Category::class;
    }

    public function testGetAllCategories()
    {
        $response = $this->resource::all();

        $this->assertIsArray($response);
        $this->assertGreaterThan(0, count($response));
    }
}
