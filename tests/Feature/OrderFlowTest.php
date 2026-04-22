<?php

namespace Tests\Feature;

use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_order_stores_admin_fee_breakdown(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $seller = User::factory()->create(['role' => 'seller', 'store_name' => 'Warung Hemat']);
        $food = Food::create([
            'seller_id' => $seller->id,
            'name' => 'Nasi Box',
            'description' => 'Siap pickup',
            'original_price' => 20000,
            'discount_price' => 10000,
            'stock' => 5,
            'pickup_time_start' => '18:00',
            'pickup_time_end' => '20:00',
            'status' => 'available',
        ]);

        $response = $this->actingAs($customer)->post(route('order.store', $food->id), [
            'quantity' => 2,
            'accepted_order_terms' => '1',
        ]);

        $response->assertRedirect(route('order.history'));

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'food_id' => $food->id,
            'quantity' => 2,
            'subtotal_price' => 20000,
            'admin_fee' => 1000,
            'total_price' => 21000,
        ]);
    }

    public function test_customer_can_submit_review_after_completed_order(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $seller = User::factory()->create(['role' => 'seller', 'store_name' => 'Warung Hemat']);
        $food = Food::create([
            'seller_id' => $seller->id,
            'name' => 'Roti',
            'description' => 'Masih layak',
            'original_price' => 15000,
            'discount_price' => 7500,
            'stock' => 3,
            'pickup_time_start' => '08:00',
            'pickup_time_end' => '10:00',
            'status' => 'available',
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'food_id' => $food->id,
            'quantity' => 1,
            'subtotal_price' => 7500,
            'admin_fee' => 375,
            'total_price' => 7875,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($customer)->post(route('reviews.store', $order), [
            'target_type' => 'application',
            'rating' => 5,
            'comment' => 'Mudah dipakai',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('reviews', [
            'order_id' => $order->id,
            'customer_id' => $customer->id,
            'target_type' => 'application',
            'rating' => 5,
        ]);
    }
}
