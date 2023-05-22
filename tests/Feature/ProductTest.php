<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_products()
    {
        //List all products ////////////////////
        $response = $this->get(route('products'));

        $response->assertStatus(200);
        /////////////////////////////////////////
        //Register a new product
        //wrong case
        $wrong_case = $this->post(route('products-register'),[
            "name"=> "",
            "description"=> "Test Description 001",
            "image"=> "",
            "brand"=> "",
            "price"=> "11.52",
            "price_sale"=> "",
            "category"=> "otherss",
            "stock"=> ""
        ]);

        $wrong_case->assertStatus(302);
        
        //correct case
        $correct_case = $this->post(route('products-register'),[
            "name"=> "Test Name 001",
            "description"=> "Test Description 001",
            "image"=> "https://image-test-0001.jpg",
            "brand"=> "Aiwa",
            "price"=> 11.52,
            "price_sale"=> 10.50,
            "category"=> "others",
            "stock"=> 10
        ]);
        $correct_case->assertStatus(201);

        //////////////////////////////////////////
        //Update a product info
        //wrong case (incorrect id)
        $wrong_case = $this->put('api/products/1',[
            "name"=> "Test Name 001",
            "description"=> "Test Description 001",
            "image"=> "https://image-test-0001.jpg",
            "brand"=> "Aiwa",
            "price"=> 11.52,
            "price_sale"=> 10.50,
            "category"=> "others",
            "stock"=> 10
        ]);
        $wrong_case->assertStatus(404);

        //wrong case (incorrect info)
        $wrong_case = $this->put('api/products/3',[
            "_method"=>"PUT",
            "name"=> "",
            "description"=> "Test Description 001",
            "image"=> "",
            "brand"=> "",
            "price"=> "11.52",
            "price_sale"=> "",
            "category"=> "otherss",
            "stock"=> ""
        ]);

        $wrong_case->assertStatus(302);
        
        //correct case
        $correct_case = $this->put('api/products/22',[
            "name"=> "Test Name 001",
            "description"=> "Test Description 001",
            "image"=> "https://image-test-0001.jpg",
            "brand"=> "Aiwa",
            "price"=> 11.52,
            "price_sale"=> 10.50,
            "category"=> "others",
            "stock"=> 10
        ]);
        $correct_case->assertStatus(200);
        //////////////////////////////////////////
        //Delete a product
        //wrong case (incorrect id)
        $wrong_case = $this->delete('api/products/1');
        $wrong_case->assertStatus(404);

        //correct case
        $correct_case = $this->delete('api/products/22');
        $correct_case->assertStatus(200);

    }
}
