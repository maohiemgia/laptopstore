<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'ThinkPad X1 Yoga Gen 8',
                'image' => 'thinkpadx1.png',
                'description' => 'Next-level performance Powered by 13th Gen Intel® Core™ vPro® processors, the Lenovo ThinkPad X1 Yoga Gen 8 2-in-1 laptop takes multitasking to the next level. These CPUs intelligently allocate workloads to the right thread, on the right core, at the right time—which allows for better team collaboration and productivity based on how you’re actually using your device. And with Intel® Evo™ certification, you can count on consistent responsiveness, instant wake, all-day battery life, rapid charging, and intelligent video conferencing.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ThinkBook 13x Gen 2',
                'image' => 'thinkbook1.png',
                'description' => 'Processor cores optimized for multitasking 12th Gen Intel® Core™ processors deliver the power you need for office work, content creation—whatever your day demands. Using a new, hybrid architecture, performance cores handle single- or lightly-threaded workloads while highly-threaded jobs go to efficient cores optimized for such work. As you focus on multitasking, Intel® Thread Director picks the best cores for each job.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'IdeaPad Flex 5i Gen 8',
                'image' => 'ideapad1.png',
                'description' => 'Multi-core turbo power makes multitasking a breeze Lenovo Flex 5i Gen 8 features up to 13th Gen Intel® Core™ i7, from a range of CPUs specifically engineered for thin and light laptops. Multiple cores give you the power to run multiple apps seamlessly and simultaneously. You can even edit video while you video chat with the confidence your device will run cool and silent under any conditions.',
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga Slim 9i Gen 7',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Legion Pro 7i 16',
                'image' => 'legion1.png',
                'description' => '13th Gen Intel® Core™ processors. Beyond performance. Intels latest hybrid architecture, paired with industry-leading features, delivers the ultimate gaming experience. Stream, create and compete at the highest levels – 13th Gen Intel Core processors push your gameplay beyond performance, giving you the power to do it all.',
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga 6 Gen 8 (13" AMD)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga 9i Gen 8 (14" Intel)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga Slim 9i Gen 7 (14" Intel)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga 7i Gen 8 (16" Intel)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga 7i Gen 8 (14" Intel)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ThinkPad P14s Gen 3 (14inch AMD)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ThinkPad P15v Gen 3 (15inch AMD)',
                'image' => 'yoga1.png',
                'description' => 'Think sustainably, act responsibly. Make the sustainable choice with an ultraslim laptop crafted from recycled materials and green packaging*, endorsed with ENERGY STAR® certification, and EPEAT™ Silver registered in the US. Carbon-neutral certified**, the Yoga Slim 9i truly exemplifies the pinnacle of premium, portable, sustainable, power. Think sustainably, do responsibly.',
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
