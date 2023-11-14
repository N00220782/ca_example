<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pub1 = new Publisher;
        $pub1->name = "Sample publisher 1";
        $pub1->description = "Sample description";
        $pub1->email = "pub@email.com";
        $pub1->phone = "0864536273";
        $pub1->save();

        $pub1 = new Publisher;
        $pub1->name = "Sample publisher 2";
        $pub1->description = "Sample description";
        $pub1->email = "pub@email.com";
        $pub1->phone = "0864536273";
        $pub1->save();

        $pub1 = new Publisher;
        $pub1->name = "Sample publisher 3";
        $pub1->description = "Sample description";
        $pub1->email = "pub@email.com";
        $pub1->phone = "0864536273";
        $pub1->save();

        $pub1 = new Publisher;
        $pub1->name = "Sample publisher 4";
        $pub1->description = "Sample description";
        $pub1->email = "pub@email.com";
        $pub1->phone = "0864536273";
        $pub1->save();
    }
}
