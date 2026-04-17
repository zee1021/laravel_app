<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the image directory exists
        Storage::disk('public')->makeDirectory('item_images');

        // Get users and categories created in other seeders
        $seller1 = User::where('email', 'seller1@test.com')->first();
        $seller2 = User::where('email', 'seller2@test.com')->first();
        $categoryIds = Category::pluck('id', 'name');

        $itemsData = [
            [
                'user' => $seller1,
                'title' => '2018 Honda Civic',
                'description' => 'Well maintained, single owner. Clean title.',
                'price' => 750000,
                'category_id' => $categoryIds['Cars'],
                'condition' => 'Used',
                'location' => 'Manila',
                'status' => 'Available',
                'image_text' => 'Honda+Civic' 
            ],
            [
                'user' => $seller2,
                'title' => 'Samsung Refrigerator',
                'description' => '2-door inverter refrigerator. Like new.',
                'price' => 15000,
                'category_id' => $categoryIds['Appliances'],
                'condition' => 'Used',
                'location' => 'Quezon City',
                'status' => 'Available',
                'image_text' => 'Samsung+Ref'
            ],
            [
                'user' => $seller1,
                'title' => 'MacBook Pro M1',
                'description' => '16GB RAM, 512GB SSD. Perfect for programming.',
                'price' => 60000,
                'category_id' => $categoryIds['Computers'],
                'condition' => 'Used',
                'location' => 'Makati',
                'status' => 'Available',
                'image_text' => 'MacBook+Pro'
            ]
        ];

        foreach ($itemsData as $data) {
            $user = $data['user'];
            $imageText = $data['image_text'];

            // Remove helper keys before passing to Eloquent
            unset($data['user'], $data['image_text']);

            // Create the item
            $item = $user->items()->create($data);

            // Download and attach a dummy image
            try {
                $filename = 'item_images/' . Str::random(10) . '.png';
                $imageContent = file_get_contents("https://placehold.co/600x400/EFEFEF/31343C/png?text={$imageText}");

                if ($imageContent) {
                    Storage::disk('public')->put($filename, $imageContent);
                    $item->images()->create(['image_path' => $filename]);
                }
            } catch (\Exception $e) {
                if (isset($this->command)) {
                    $this->command->error("Failed to download image for '{$item->title}': " . $e->getMessage());
                }
            }
        }
    }
}