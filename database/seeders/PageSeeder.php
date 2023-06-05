<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages=['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
                $count=0;
        foreach ($pages as $page) {
                $count++;
            DB::table('pages')->insert([
                'title' => $page,
                "slug" => Str::slug($page, "-"),
                'image' =>'https://media.istockphoto.com/id/1311598658/tr/foto%C4%9Fraf/teblet-ekran%C4%B1nda-online-borsa-ticareti-i%C5%9F-adam%C4%B1-dijital-yat%C4%B1r%C4%B1m-konsepti.jpg?s=612x612&w=0&k=20&c=_wh2jnUZ3S-GDphfK9sw3tRQ5DiXHt-cjodyLP2uvJ8=',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                              Phasellus egestas convallis volutpat. Aenean nulla odio,
                              consectetur in porta a, sagittis sed tortor. Pellentesque
                              at suscipit velit. Morbi quis turpis in odio iaculis dictum.
                              Suspendisse et varius ligula. Pellentesque sit amet leo eu eros
                              fermentum ultrices. Curabitur id suscipit turpis, sed pharetra odio.
                              Fusce ut dapibus velit. Donec convallis ex eget sem aliquam, in suscipit
                              magna suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                              Sed pellentesque turpis quis sem condimentum facilisis. Quisque id felis tincidunt,
                              pulvinar nulla non, faucibus nunc. Nunc aliquet tellus vel erat viverra porta. Orci
                              varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
