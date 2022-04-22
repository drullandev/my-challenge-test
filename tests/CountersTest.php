<?php

namespace Tests;

use App\Controller\ProductsController;

use PHPUnit\Framework\TestCase;

class SomeTest  extends TestCase
{
    public function loquesea()
    {
        $class = new ProductsController();
        $result = $class->countByVendorId(12);
        // nos aseguramos que la calculadora ha sumado los números correctamente
        //$this->assertEquals(1, $result);
    }
}