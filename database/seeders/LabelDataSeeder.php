<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\PredefinedSize;
use App\Models\LaminateOption;

class LabelDataSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🚀 Rozpoczynam seedowanie danych etykiet...');

        // Kształty etykiet z obrazkami
        $shapes = [
            [
                'name' => 'Prostokątna',
                'slug' => 'rectangle',
                'description' => 'Klasyczny kształt prostokątny, idealny do większości zastosowań',
                'icon_path' => 'images/shapes/rectangle.png',
                'base_price_multiplier' => 1.0,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kwadratowa',
                'slug' => 'square',
                'description' => 'Równoboczny kształt kwadratowy, doskonały do logo',
                'icon_path' => 'images/shapes/square.png',
                'base_price_multiplier' => 1.0,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Okrągła',
                'slug' => 'circle',
                'description' => 'Elegancki kształt okrągły, wyróżniający się na produktach',
                'icon_path' => 'images/shapes/circle.png',
                'base_price_multiplier' => 1.1,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Owalna',
                'slug' => 'oval',
                'description' => 'Miękki kształt owalny, doskonały do produktów kosmetycznych',
                'icon_path' => 'images/shapes/oval.png',
                'base_price_multiplier' => 1.15,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Gwiazda',
                'slug' => 'star',
                'description' => 'Nietypowy kształt gwiazdy dla wyjątkowych produktów',
                'icon_path' => 'images/shapes/star.png',
                'base_price_multiplier' => 1.3,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        // 🔥 ZAPISUJ KSZTAŁTY DO BAZY DANYCH
        $this->command->info('📐 Zapisywanie kształtów etykiet...');
        foreach ($shapes as $shape) {
            LabelShape::updateOrCreate(
                ['slug' => $shape['slug']],
                $shape
            );
            $this->command->info("   ✓ {$shape['name']}");
        }

        // Materiały etykiet z obrazkami
        $materials = [
            [
                'name' => 'Papier biały matowy',
                'slug' => 'paper-white-matte',
                'description' => 'Standardowy papier biały z matowym wykończeniem',
                'price_per_cm2' => 0.15,
                'texture_image_path' => 'images/materials/paper-white-matte.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Papier biały błyszczący',
                'slug' => 'paper-white-glossy',
                'description' => 'Papier biały z błyszczącym wykończeniem',
                'price_per_cm2' => 0.18,
                'texture_image_path' => 'images/materials/paper-white-glossy.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Papier kraft',
                'slug' => 'paper-kraft',
                'description' => 'Ekologiczny papier kraft w naturalnym kolorze',
                'price_per_cm2' => 0.20,
                'texture_image_path' => 'images/materials/paper-kraft.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Folia przezroczysta',
                'slug' => 'foil-transparent',
                'description' => 'Przezroczysta folia winylowa, wodoodporna',
                'price_per_cm2' => 0.35,
                'texture_image_path' => 'images/materials/foil-transparent.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Folia biała',
                'slug' => 'foil-white',
                'description' => 'Biała folia winylowa, odporna na warunki zewnętrzne',
                'price_per_cm2' => 0.32,
                'texture_image_path' => 'images/materials/foil-white.jpg',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Folia srebrna',
                'slug' => 'foil-silver',
                'description' => 'Srebrna folia metaliczna z połyskiem',
                'price_per_cm2' => 0.45,
                'texture_image_path' => 'images/materials/foil-silver.jpg',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Folia złota',
                'slug' => 'foil-gold',
                'description' => 'Złota folia metaliczna, premium',
                'price_per_cm2' => 0.50,
                'texture_image_path' => 'images/materials/foil-gold.jpg',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Papier wodoodporny',
                'slug' => 'paper-waterproof',
                'description' => 'Wodoodporny papier syntetyczny',
                'price_per_cm2' => 0.28,
                'texture_image_path' => 'images/materials/paper-waterproof.jpg',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        // 🔥 ZAPISUJ MATERIAŁY DO BAZY DANYCH
        $this->command->info('🎨 Zapisywanie materiałów etykiet...');
        foreach ($materials as $material) {
            LabelMaterial::updateOrCreate(
                ['slug' => $material['slug']],
                $material
            );
            $this->command->info("   ✓ {$material['name']}");
        }

        // Opcje laminowania z obrazkami
        $laminates = [
            [
                'name' => 'Laminat matowy',
                'slug' => 'laminate-matte',
                'description' => 'Matowy laminat chroniący przed zarysowaniem',
                'finish_type' => 'matte',
                'price_multiplier' => 1.30,
                'texture_image_path' => 'images/laminates/laminate-matte.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Laminat błyszczący',
                'slug' => 'laminate-glossy',
                'description' => 'Błyszczący laminat zwiększający intensywność kolorów',
                'finish_type' => 'glossy',
                'price_multiplier' => 1.35,
                'texture_image_path' => 'images/laminates/laminate-glossy.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Laminat soft-touch',
                'slug' => 'laminate-soft-touch',
                'description' => 'Premium laminat z miękką fakturą',
                'finish_type' => 'soft_touch',
                'price_multiplier' => 1.50,
                'texture_image_path' => 'images/laminates/laminate-soft-touch.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        // 🔥 ZAPISUJ LAMINATY DO BAZY DANYCH
        $this->command->info('✨ Zapisywanie opcji laminowania...');
        foreach ($laminates as $laminate) {
            LaminateOption::updateOrCreate(
                ['slug' => $laminate['slug']],
                $laminate
            );
            $this->command->info("   ✓ {$laminate['name']}");
        }

        // TERAZ DODAJ ROZMIARY DLA WSZYSTKICH KSZTAŁTÓW
        $this->command->info('📏 Zapisywanie predefiniowanych rozmiarów...');

        $sizesByShape = [
            'rectangle' => [
                ['name' => '20×10 mm', 'width_mm' => 20, 'height_mm' => 10],
                ['name' => '30×20 mm', 'width_mm' => 30, 'height_mm' => 20],
                ['name' => '60×40 mm', 'width_mm' => 60, 'height_mm' => 40],
                ['name' => '80×50 mm', 'width_mm' => 80, 'height_mm' => 50],
                ['name' => '100×60 mm', 'width_mm' => 100, 'height_mm' => 60],
                ['name' => '120×80 mm', 'width_mm' => 120, 'height_mm' => 80],
            ],
            'square' => [
                ['name' => '20×20 mm', 'width_mm' => 20, 'height_mm' => 20],
                ['name' => '30×30 mm', 'width_mm' => 30, 'height_mm' => 30],
                ['name' => '40×40 mm', 'width_mm' => 40, 'height_mm' => 40],
                ['name' => '50×50 mm', 'width_mm' => 50, 'height_mm' => 50],
                ['name' => '60×60 mm', 'width_mm' => 60, 'height_mm' => 60],
            ],
            'circle' => [
                ['name' => 'Ø 20 mm', 'width_mm' => 20, 'height_mm' => 20],
                ['name' => 'Ø 30 mm', 'width_mm' => 30, 'height_mm' => 30],
                ['name' => 'Ø 40 mm', 'width_mm' => 40, 'height_mm' => 40],
                ['name' => 'Ø 50 mm', 'width_mm' => 50, 'height_mm' => 50],
                ['name' => 'Ø 60 mm', 'width_mm' => 60, 'height_mm' => 60],
            ],
            'oval' => [
                ['name' => '30×20 mm', 'width_mm' => 30, 'height_mm' => 20],
                ['name' => '40×25 mm', 'width_mm' => 40, 'height_mm' => 25],
                ['name' => '50×30 mm', 'width_mm' => 50, 'height_mm' => 30],
                ['name' => '60×40 mm', 'width_mm' => 60, 'height_mm' => 40],
            ],
            'star' => [
                ['name' => 'Ø 30 mm', 'width_mm' => 30, 'height_mm' => 30],
                ['name' => 'Ø 40 mm', 'width_mm' => 40, 'height_mm' => 40],
                ['name' => 'Ø 50 mm', 'width_mm' => 50, 'height_mm' => 50],
            ],
        ];

        $shapes = LabelShape::all();
        foreach ($shapes as $shape) {
            $this->command->info("📏 Dodawanie rozmiarów dla kształtu: {$shape->name}...");
            $sizes = $sizesByShape[$shape->slug] ?? [];

            foreach ($sizes as $index => $size) {
                $slug = "{$shape->slug}-{$size['width_mm']}x{$size['height_mm']}";
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $shape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['width_mm'],
                        'height_mm' => $size['height_mm'],
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ]
                );
                $this->command->info("     ✓ {$size['name']}");
            }
        }

        $this->command->info('🎉 Seedowanie zakończone pomyślnie!');

        // Podsumowanie
        $this->command->info('');
        $this->command->info('📊 Podsumowanie:');
        $this->command->info('   📐 Kształty: ' . LabelShape::count());
        $this->command->info('   🎨 Materiały: ' . LabelMaterial::count());
        $this->command->info('   ✨ Laminaty: ' . LaminateOption::count());
        $this->command->info('   📏 Rozmiary: ' . PredefinedSize::count());
    }
}
