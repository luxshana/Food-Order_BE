<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            '1' => [ // Pizza category
                ['name' => 'Margherita Pizza', 'price' => 12.99, 'image' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?w=400', 'description' => 'Classic tomato sauce, mozzarella, basil'],
                ['name' => 'Pepperoni Pizza', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=400', 'description' => 'Tomato sauce, mozzarella, pepperoni'],
                ['name' => 'Vegetarian Pizza', 'price' => 13.99, 'image' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400', 'description' => 'Fresh vegetables, mushrooms, olives'],
            ],
            '2' => [ // Burger category
                ['name' => 'Classic Burger', 'price' => 9.99, 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400', 'description' => 'Beef patty, lettuce, tomato, cheese'],
                ['name' => 'Chicken Burger', 'price' => 8.99, 'image' => 'https://images.unsplash.com/photo-1606755962773-d324e0a13086?w=400', 'description' => 'Grilled chicken, lettuce, mayo'],
                ['name' => 'Double Cheese Burger', 'price' => 11.99, 'image' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?w=400', 'description' => 'Double patty, double cheese, special sauce'],
            ],
            '3' => [ // Drinks category
                ['name' => 'Coca Cola', 'price' => 2.99, 'image' => 'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=400', 'description' => 'Ice cold beverage'],
                ['name' => 'Fresh Orange Juice', 'price' => 3.99, 'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400', 'description' => 'Freshly squeezed'],
                ['name' => 'Lemonade', 'price' => 2.99, 'image' => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=400', 'description' => 'Fresh lemon, mint'],
            ],
            '4' => [ // Desserts category
                ['name' => 'Chocolate Cake', 'price' => 5.99, 'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400', 'description' => 'Rich chocolate ganache'],
                ['name' => 'Ice Cream Sundae', 'price' => 4.99, 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400', 'description' => 'Vanilla ice cream with toppings'],
                ['name' => 'Apple Pie', 'price' => 3.99, 'image' => 'https://i.pinimg.com/736x/4a/a5/0a/4aa50a06d59af6a6e08b434d787527c6.jpg', 'description' => 'Homemade apple pie'],
            ],
            '5' => [
                ['name' => 'Classic Chocolate Cake', 'price' => 24.99, 'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400', 'description' => 'Rich chocolate layers with smooth chocolate ganache'],
                ['name' => 'Vanilla Strawberry Cake', 'price' => 22.99, 'image' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?w=400', 'description' => 'Light vanilla sponge with fresh strawberries and cream'],
                ['name' => 'Red Velvet Cake', 'price' => 26.99, 'image' => 'https://i.pinimg.com/736x/ee/6e/f5/ee6ef5cbf05b16e404215abafd2eb24a.jpg', 'description' => 'Classic red velvet with cream cheese frosting'],
                ['name' => 'Carrot Cake', 'price' => 23.99, 'image' => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?w=400', 'description' => 'Moist carrot cake with walnuts and cinnamon cream cheese frosting'],
                ['name' => 'Lemon Drizzle Cake', 'price' => 21.99, 'image' => 'https://i.pinimg.com/1200x/68/6f/72/686f72f28970c96af10896e9ed61dfdf.jpg', 'description' => 'Zesty lemon cake with sweet lemon glaze'],
                ['name' => 'Black Forest Cake', 'price' => 27.99, 'image' => 'https://i.pinimg.com/736x/c1/b4/bd/c1b4bd90c5103b27e6cd9e382bdb1850.jpg', 'description' => 'Chocolate cake with cherries and whipped cream'],
                ['name' => 'Tiramisu Cake', 'price' => 28.99, 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400', 'description' => 'Coffee-infused cake with mascarpone cream and cocoa'],
                ['name' => 'Funfetti Birthday Cake', 'price' => 25.99, 'image' => 'https://i.pinimg.com/1200x/df/da/aa/dfdaaaac0322927bf11ff84d00eccac4.jpg', 'description' => 'Colorful sprinkles cake with vanilla buttercream'],
            ],
            '6' => [
                ['name' => 'Chicken Biryani', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Fragrant basmati rice cooked with tender chicken and aromatic spices'],
                ['name' => 'Mutton Biryani', 'price' => 17.99, 'image' => 'https://i.pinimg.com/736x/6e/a5/73/6ea573a3bab9626a4d209ce71717e763.jpg', 'description' => 'Slow-cooked mutton with aged basmati rice and traditional spices'],
                ['name' => 'Vegetable Biryani', 'price' => 12.99, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'description' => 'Mixed vegetables layered with spiced rice and fried onions'],
                ['name' => 'Hyderabadi Dum Biryani', 'price' => 16.99, 'image' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=400', 'description' => 'Authentic Hyderabadi style biryani cooked in dum with marinated meat'],
                ['name' => 'Prawn Biryani', 'price' => 18.99, 'image' => 'https://i.pinimg.com/736x/4f/d9/0a/4fd90a7145f70b2c799ad74ab73dae06.jpg', 'description' => 'Juicy prawns with basmati rice and coastal spices'],
                ['name' => 'Egg Biryani', 'price' => 11.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Spiced rice with boiled eggs and aromatic seasonings'],
                ['name' => 'Kolkata Biryani', 'price' => 15.99, 'image' => 'https://i.pinimg.com/736x/79/53/fb/7953fbcd346daad06ae3afe79db15b3c.jpg', 'description' => 'Lightly spiced biryani with potato and meat, Kolkata style'],
                ['name' => 'Fish Biryani', 'price' => 17.99, 'image' => 'https://i.pinimg.com/736x/48/a4/3f/48a43f9a1a9f1d5e75326ee9ae1d7cdc.jpg', 'description' => 'Spiced fish fillets layered with fragrant rice'],
                ['name' => 'Paneer Biryani', 'price' => 13.99, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'description' => 'Cottage cheese cubes with spiced rice and mint'],
                ['name' => 'Chicken Tikka Biryani', 'price' => 16.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Grilled chicken tikka pieces layered with saffron rice'],
            ],
            '7' => [
                ['name' => 'Classic Vegetable Biryani', 'price' => 12.99, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'description' => 'Traditional mixed vegetable biryani with basmati rice and aromatic spices'],
                ['name' => 'Hyderabadi Veg Dum Biryani', 'price' => 13.99, 'image' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=400', 'description' => 'Hyderabadi style vegetable biryani cooked in dum with fried onions'],
                ['name' => 'Paneer Biryani', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Cottage cheese cubes with spiced rice, mint and saffron'],
                ['name' => 'Mushroom Biryani', 'price' => 13.99, 'image' => 'https://i.pinimg.com/736x/84/c3/7b/84c37be688163a3793d3430b3c4b1721.jpg', 'description' => 'Fresh mushrooms layered with fragrant basmati rice and spices'],
                ['name' => 'Soya Chunk Biryani', 'price' => 12.99, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'description' => 'Protein-rich soya chunks with spiced rice and vegetables'],
                ['name' => 'Kashmiri Veg Biryani', 'price' => 14.99, 'image' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=400', 'description' => 'Kashmiri style biryani with dry fruits, nuts and mild spices'],
                ['name' => 'Jackfruit Biryani', 'price' => 13.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Young jackfruit cooked like meat with aromatic rice'],
                ['name' => 'Cauliflower Biryani', 'price' => 12.99, 'image' => 'https://i.pinimg.com/1200x/16/2f/a5/162fa5759d86896118b78b9a43ff578d.jpg', 'description' => 'Spiced cauliflower florets with basmati rice and herbs'],
                ['name' => 'Mixed Veg & Paneer Biryani', 'price' => 15.99, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400', 'description' => 'Combination of fresh vegetables and paneer in spiced rice'],
                ['name' => 'Bombay Veg Biryani', 'price' => 13.99, 'image' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=400', 'description' => 'Mumbai street style vegetable biryani with extra masala'],
                ['name' => 'Peas Pulao Biryani', 'price' => 11.99, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=400', 'description' => 'Green peas and spiced rice, a lighter version of biryani'],
                ['name' => 'Corn & Capsicum Biryani', 'price' => 12.99, 'image' => 'https://i.pinimg.com/736x/d2/66/41/d2664122b1b61dc0544eb6326672dd45.jpg', 'description' => 'Sweet corn and capsicum with mildly spiced basmati rice'],
            ],
        ];

        foreach ($data as $categoryId => $products) {
            foreach ($products as $product) {
                Product::create(array_merge($product, ['category_id' => $categoryId]));
            }
        }
    }
}
