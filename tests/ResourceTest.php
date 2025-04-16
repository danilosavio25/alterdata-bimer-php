<?php
declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Customer;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    protected $resource;

    public function testEndpoint()
    {
        $this->resource = Customer::class;
        $this->assertNotEmpty($this->resource::endpoint());
    }
}
