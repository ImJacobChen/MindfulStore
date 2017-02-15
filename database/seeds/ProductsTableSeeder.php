<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	'name' => 'Colorful Buddha Artwork',
        	'slug' => 'colorful-buddha-artwork',
        	'price' => 9.99,
        	'img' => 'img/buddha-art.jpg',
        	'product_type' => 'artwork',
        	'description' => 'A piece of colorful buddha artwork'
        ]);
        DB::table('products')->insert([
        	'name' => 'Zen Buddhism Poster',
        	'slug' => 'zen-buddhism-poster',
        	'price' => 8.99,
        	'img' => 'img/508009479.jpg',
        	'product_type' => 'artwork',
        	'description' => 'A Zen Buddhist style poster'
        ]);
        DB::table('products')->insert([
        	'name' => 'Buddha Statue',
        	'slug' => 'buddha-statue',
        	'price' => 14.99,
        	'img' => 'img/buddha_exercise.jpg',
        	'product_type' => 'ornament',
        	'description' => 'A stone buddha ornament'
        ]);
        DB::table('products')->insert([
        	'name' => 'Buddha wall decal',
        	'slug' => 'buddha-wall-decal',
        	'price' => 4.99,
        	'img' => 'img/buddha-wall-decal.jpg',
        	'product_type' => 'decal',
        	'description' => 'A buddha face wall decal.'
        ]);
        DB::table('products')->insert([
        	'name' => 'Ying Yang Fish Artwork',
        	'slug' => 'ying-yang-fish-artwork',
        	'price' => 11.99,
        	'img' => 'img/ying-yang-fish.jpg',
        	'product_type' => 'artwork',
        	'description' => 'A ying yang fish piece of art.'
        ]);
        DB::table('products')->insert([
        	'name' => 'Zen Monk Sticker',
        	'slug' => 'zen-monk-sticker',
        	'price' => 2.99,
        	'img' => 'img/Monk-Inside-Zen.jpg',
        	'product_type' => 'sticker',
        	'description' => 'A zen monk sticker.'
        ]);
        DB::table('products')->insert([
        	'name' => 'Black and White buddha face artwork',
        	'slug' => 'black-and-white-buddha-face-artwork',
        	'price' => 8.99,
        	'img' => 'img/black_and_white_buddha_face.jpg',
        	'product_type' => 'artwork',
        	'description' => 'A black and white buddha face artwork.'
        ]);
        DB::table('products')->insert([
        	'name' => 'Wooden Buddha Ornament',
        	'slug' => 'wooden-buddha-ornament',
        	'price' => 6.99,
        	'img' => 'img/buddha-ornament.jpg',
        	'product_type' => 'ornament',
        	'description' => 'A wooden buddha ornament'
        ]);
    }
}
