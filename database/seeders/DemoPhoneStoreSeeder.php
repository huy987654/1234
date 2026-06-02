<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoPhoneStoreSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach (['Apple', 'Samsung', 'OPPO', 'Xiaomi'] as $brandName) {
            DB::table('brands')->updateOrInsert(
                ['brand_name' => $brandName],
                ['updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach (['Dien thoai', 'Phu kien'] as $typeName) {
            DB::table('product_types')->updateOrInsert(
                ['product_type_name' => $typeName],
                ['updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach (['Tien mat', 'Chuyen khoan', 'Tra gop'] as $method) {
            DB::table('payments')->updateOrInsert(
                ['method' => $method],
                ['updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach (['Cho xac nhan', 'Dang xu ly', 'Dang giao', 'Hoan thanh', 'Da huy'] as $statusName) {
            DB::table('statuses')->updateOrInsert(
                ['status_name' => $statusName],
                ['updated_at' => $now, 'created_at' => $now]
            );
        }

        DB::table('staffs')->updateOrInsert(
            ['email' => 'admin@phonestore.test'],
            [
                'staff_name' => 'Admin Demo',
                'position' => 'Quan tri vien',
                'phone' => '0900000001',
                'password' => Hash::make('123456'),
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );

        $phoneTypeId = DB::table('product_types')->where('product_type_name', 'Dien thoai')->value('id');
        $brandIds = DB::table('brands')->pluck('id', 'brand_name');

        $products = [
            [
                'name' => 'iPhone 15',
                'brand' => 'Apple',
                'price' => '17690000',
                'stock' => '30',
                'variants' => [
                    ['color' => 'Hong', 'price' => '17690000', 'stock' => '8', 'cpu' => 'Apple A16 Bionic', 'ram' => '6GB', 'storage' => '128GB', 'gpu' => 'Apple GPU', 'screen' => '6.1 inch Super Retina XDR', 'os' => 'iOS 17', 'battery' => '3349 mAh', 'camera' => '48MP + 12MP', 'connect' => '5G, Wi-Fi 6, Bluetooth 5.3'],
                    ['color' => 'Den', 'price' => '19990000', 'stock' => '6', 'cpu' => 'Apple A16 Bionic', 'ram' => '6GB', 'storage' => '256GB', 'gpu' => 'Apple GPU', 'screen' => '6.1 inch Super Retina XDR', 'os' => 'iOS 17', 'battery' => '3349 mAh', 'camera' => '48MP + 12MP', 'connect' => '5G, Wi-Fi 6, Bluetooth 5.3'],
                    ['color' => 'Xanh duong', 'price' => '19990000', 'stock' => '5', 'cpu' => 'Apple A16 Bionic', 'ram' => '6GB', 'storage' => '256GB', 'gpu' => 'Apple GPU', 'screen' => '6.1 inch Super Retina XDR', 'os' => 'iOS 17', 'battery' => '3349 mAh', 'camera' => '48MP + 12MP', 'connect' => '5G, Wi-Fi 6, Bluetooth 5.3'],
                ],
            ],
            [
                'name' => 'Samsung Galaxy A57 5G',
                'brand' => 'Samsung',
                'price' => '10590000',
                'stock' => '24',
                'variants' => [
                    ['color' => 'Tim', 'price' => '10590000', 'stock' => '10', 'cpu' => 'Exynos 1580', 'ram' => '8GB', 'storage' => '128GB', 'gpu' => 'Xclipse GPU', 'screen' => '6.7 inch Super AMOLED 120Hz', 'os' => 'Android 15', 'battery' => '5000 mAh', 'camera' => '50MP + 12MP + 5MP', 'connect' => '5G, Wi-Fi, Bluetooth'],
                    ['color' => 'Xanh', 'price' => '11990000', 'stock' => '7', 'cpu' => 'Exynos 1580', 'ram' => '8GB', 'storage' => '256GB', 'gpu' => 'Xclipse GPU', 'screen' => '6.7 inch Super AMOLED 120Hz', 'os' => 'Android 15', 'battery' => '5000 mAh', 'camera' => '50MP + 12MP + 5MP', 'connect' => '5G, Wi-Fi, Bluetooth'],
                ],
            ],
            [
                'name' => 'OPPO Find N6',
                'brand' => 'OPPO',
                'price' => '64990000',
                'stock' => '9',
                'variants' => [
                    ['color' => 'Den', 'price' => '64990000', 'stock' => '4', 'cpu' => 'Snapdragon 8 Elite', 'ram' => '16GB', 'storage' => '512GB', 'gpu' => 'Adreno GPU', 'screen' => 'Man hinh gap AMOLED 120Hz', 'os' => 'Android 15', 'battery' => '5600 mAh', 'camera' => '50MP + 50MP + 50MP', 'connect' => '5G, Wi-Fi 7, Bluetooth 5.4'],
                    ['color' => 'Cam', 'price' => '66990000', 'stock' => '3', 'cpu' => 'Snapdragon 8 Elite', 'ram' => '16GB', 'storage' => '1TB', 'gpu' => 'Adreno GPU', 'screen' => 'Man hinh gap AMOLED 120Hz', 'os' => 'Android 15', 'battery' => '5600 mAh', 'camera' => '50MP + 50MP + 50MP', 'connect' => '5G, Wi-Fi 7, Bluetooth 5.4'],
                ],
            ],
            [
                'name' => 'Xiaomi 14T Pro',
                'brand' => 'Xiaomi',
                'price' => '14990000',
                'stock' => '18',
                'variants' => [
                    ['color' => 'Xam', 'price' => '14990000', 'stock' => '8', 'cpu' => 'Dimensity 9300+', 'ram' => '12GB', 'storage' => '256GB', 'gpu' => 'Immortalis GPU', 'screen' => '6.67 inch AMOLED 144Hz', 'os' => 'HyperOS', 'battery' => '5000 mAh', 'camera' => '50MP Leica', 'connect' => '5G, Wi-Fi 7, Bluetooth 5.4'],
                    ['color' => 'Den', 'price' => '16990000', 'stock' => '6', 'cpu' => 'Dimensity 9300+', 'ram' => '12GB', 'storage' => '512GB', 'gpu' => 'Immortalis GPU', 'screen' => '6.67 inch AMOLED 144Hz', 'os' => 'HyperOS', 'battery' => '5000 mAh', 'camera' => '50MP Leica', 'connect' => '5G, Wi-Fi 7, Bluetooth 5.4'],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $productId = DB::table('products')->where('product_name', $productData['name'])->value('id');

            $productPayload = [
                'product_name' => $productData['name'],
                'price' => $productData['price'],
                'stock_quantity' => $productData['stock'],
                'product_type_id' => $phoneTypeId,
                'brand_id' => $brandIds[$productData['brand']],
            ];

            if ($productId) {
                DB::table('products')->where('id', $productId)->update($productPayload);
            } else {
                $productId = DB::table('products')->insertGetId($productPayload);
            }

            foreach ($productData['variants'] as $variantData) {
                $configurationId = DB::table('configurations')
                    ->where('cpu', $variantData['cpu'])
                    ->where('ram', $variantData['ram'])
                    ->where('storage', $variantData['storage'])
                    ->value('id');

                $configurationPayload = [
                    'cpu' => $variantData['cpu'],
                    'ram' => $variantData['ram'],
                    'storage' => $variantData['storage'],
                    'gpu' => $variantData['gpu'],
                    'screen' => $variantData['screen'],
                    'os' => $variantData['os'],
                    'battery' => $variantData['battery'],
                    'camera' => $variantData['camera'],
                    'connect' => $variantData['connect'],
                    'other_function' => 'Bao mat van tay/Face ID, sac nhanh, khang nuoc tuy dong may',
                    'updated_at' => $now,
                    'created_at' => $now,
                ];

                if ($configurationId) {
                    DB::table('configurations')->where('id', $configurationId)->update($configurationPayload);
                } else {
                    $configurationId = DB::table('configurations')->insertGetId($configurationPayload);
                }

                DB::table('product_variants')->updateOrInsert(
                    [
                        'product_id' => $productId,
                        'pv_color' => $variantData['color'],
                        'configuration_id' => $configurationId,
                    ],
                    [
                        'pv_price' => $variantData['price'],
                        'pv_stock_qtt' => $variantData['stock'],
                        'desc' => $productData['name'] . ' ' . $variantData['storage'] . ' mau ' . $variantData['color'],
                    ]
                );
            }
        }
    }
}
