<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items.product', 'user'])->latest()->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function userOrders(User $user)
    {
        $orders = $user->orders()->with('items.product')->latest()->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_fee' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $orderData = $request->only(['delivery_fee', 'total_amount', 'payment_method']);
            $orderData['user_id'] = auth()->id() ?? 1; // Default to 1 for testing if not auth
            $orderData['status'] = 'pending';
            
            // Handle card details if provided
            if ($request->payment_method === 'card' && $request->has('card_details.card_number')) {
                $cardNumber = $request->input('card_details.card_number');
                $orderData['card_last_four'] = substr($cardNumber, -4);
            }

            $order = Order::create($orderData);

            foreach ($request->items as $item) {
                $product = \App\Models\Product::find($item['product_id']);
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'item_name' => $product ? $product->name : 'Unknown Product',
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order->load('items')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with(['items.product', 'user'])->findOrFail($id);
            return response()->json([
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Order not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $order = Order::findOrFail($id);
            
            // Standard Eloquent update
            $updated = $order->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => $updated,
                'message' => 'Order status updated successfully',
                'order' => $order->fresh(['items.product', 'user'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update order status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
