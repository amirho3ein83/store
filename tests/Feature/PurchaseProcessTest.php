<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\File;

class PurchaseProcessTest extends TestCase
{


    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_customer_see_product_show_page()
    {
        $product = Product::factory()->create();
        $pic = rand(1, 11);
        File::copy(public_path('/watches/' . $pic . '.webp'), public_path('/watches2/' . $pic . '.webp'));

        $product->addMedia(public_path('/watches2/' . $pic . '.webp'))
            ->toMediaCollection();

        $response = $this->get("/products/" . $product->slug);

        $response->assertStatus(200);
        $response->assertSee($product->title);

        return $product;
    }

    /**
     * @depends test_customer_see_product_show_page
     */
    public function test_customer_can_add_order_to_his_cart($product)
    {
        $user = User::factory()->create([
            'name' => 'Alex'
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 5500,
        ]);

        $response = $this->actingAs($user)
            ->post('/cart', [
                'product_id' => $product->id,
                'picked_color' => 'red',
            ]);


        $response->assertStatus(200);

        return $product;
    }


    /**
     * @depends test_customer_can_add_order_to_his_cart
     */
    public function test_customer_can_see_his_order_in_cart($product)
    {

        $user = User::firstWhere('name', 'Alex');

        $response = $this->actingAs($user, 'web')
            ->withSession(['banned' => false])
            ->get('/cart');

        $response->assertStatus(200);
        $response->assertStatus($product->title);
    }


    /**
     * @depends test_customer_can_add_order_to_his_cart
     */
    public function test_customer_finish_purchase_process($product)
    {

        $user = User::firstWhere('name', 'Alex');

        $response = $this->actingAs($user, 'web')
            ->withSession(['banned' => false])
            ->post('/register-order', [
                'recipient_name' => "",
                'address' => "",
                'mobile' => "",
                'zipcode' => "",
                'save_address_as_default' => false,
                'use_default_address' => true,
                'card_number' => null,
                'expirationYear' => null,
                'expirationMonth' => null,
                'cvc' => null,
                'useWallet' => true,
            ]);


        $response->assertStatus(200);
    }
}
