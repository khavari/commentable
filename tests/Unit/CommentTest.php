<?php

namespace Tests\Unit;

use Easteregg\Diagon\Product\Product;
use Easteregg\Comment\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * @test
     */
    function it_should_find_comments() {

        $product = $this->makeProduct();
        $product->dimensions = [
            'width'  => '300mm',
            'height' => '300mm',
            'length'  => '300mm',
        ];

        $product->save();

        $pr = Product::find(1);


        $this->assertEquals($product->dimensions, $pr->dimensions);

    }


}
