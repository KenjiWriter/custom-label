<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\LaminateOption;
use App\Models\PredefinedSize;

class LabelDataSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Kształty etykiet
        $shapes = [
            [
                'name' => 'Prostokątna',
                'slug' => 'rectangle',
                'description' => 'Klasyczny kształt prostokątny, idealny do większości zastosowań',
                'base_price_multiplier' => 1.00,
                'sort_order' => 1,
            ],
            [
                'name' => 'Kwadratowa',
                'slug' => 'square',
                'description' => 'Równoboczny kształt kwadratowy, doskonały do logo',
                'base_price_multiplier' => 1.10,
                'sort_order' => 2,
            ],
            [
                'name' => 'Okrągła',
                'slug' => 'circle',
                'description' => 'Elegancki kształt okrągły, wyróżniający się na produktach',
                'base_price_multiplier' => 1.20,
                'sort_order' => 3,
            ],
            [
                'name' => 'Owalna',
                'slug' => 'oval',
                'description' => 'Miękki kształt owalny, doskonały do produktów kosmetycznych',
                'base_price_multiplier' => 1.25,
                'sort_order' => 4,
            ],
            [
                'name' => 'Gwiazda',
                'slug' => 'star',
                'description' => 'Nietypowy kształt gwiazdy dla wyjątkowych produktów',
                'base_price_multiplier' => 1.50,
                'sort_order' => 5,
            ],
        ];

        foreach ($shapes as $shape) {
            LabelShape::updateOrCreate(
                ['slug' => $shape['slug']], // Znajdź po slug
                $shape // Utwórz lub zaktualizuj z tymi danymi
            );
        }

        // Materiały etykiet
        $materials = [
            [
                'name' => 'Papier biały matowy',
                'slug' => 'paper-white-matte',
                'description' => 'Standardowy papier biały z matowym wykończeniem',
                'price_per_cm2' => 0.15,
                'sort_order' => 1,
            ],
            [
                'name' => 'Papier biały błyszczący',
                'slug' => 'paper-white-glossy',
                'description' => 'Papier biały z błyszczącym wykończeniem',
                'price_per_cm2' => 0.18,
                'sort_order' => 2,
            ],
            [
                'name' => 'Papier kraft',
                'slug' => 'paper-kraft',
                'description' => 'Ekologiczny papier kraft w naturalnym kolorze',
                'price_per_cm2' => 0.20,
                'sort_order' => 3,
            ],
            [
                'name' => 'Folia przezroczysta',
                'slug' => 'foil-transparent',
                'description' => 'Przezroczysta folia winylowa, wodoodporna',
                'price_per_cm2' => 0.35,
                'sort_order' => 4,
            ],
            [
                'name' => 'Folia biała',
                'slug' => 'foil-white',
                'description' => 'Biała folia winylowa, odporna na warunki zewnętrzne',
                'price_per_cm2' => 0.32,
                'sort_order' => 5,
            ],
            [
                'name' => 'Folia srebrna',
                'slug' => 'foil-silver',
                'description' => 'Srebrna folia metaliczna z efektem lustrzanym',
                'price_per_cm2' => 0.45,
                'sort_order' => 6,
            ],
            [
                'name' => 'Folia złota',
                'slug' => 'foil-gold',
                'description' => 'Złota folia metaliczna Premium',
                'price_per_cm2' => 0.55,
                'sort_order' => 7,
            ],
            [
                'name' => 'Papier wodoodporny',
                'slug' => 'paper-waterproof',
                'description' => 'Specjalny papier odporny na wilgoć i wodę',
                'price_per_cm2' => 0.28,
                'sort_order' => 8,
            ],
        ];

        foreach ($materials as $material) {
            LabelMaterial::updateOrCreate(
                ['slug' => $material['slug']],
                $material
            );
        }

        // Opcje laminowania
        $laminates = [
            [
                'name' => 'Laminat matowy',
                'slug' => 'laminate-matte',
                'description' => 'Matowy laminat chroniący przed zarysowaniem',
                'finish_type' => 'matte',
                'price_multiplier' => 1.30,
                'sort_order' => 1,
            ],
            [
                'name' => 'Laminat błyszczący',
                'slug' => 'laminate-glossy',
                'description' => 'Błyszczący laminat zwiększający intensywność kolorów',
                'finish_type' => 'glossy',
                'price_multiplier' => 1.35,
                'sort_order' => 2,
            ],
            [
                'name' => 'Laminat soft-touch',
                'slug' => 'laminate-soft-touch',
                'description' => 'Premium laminat z miękką fakturą',
                'finish_type' => 'soft_touch',
                'price_multiplier' => 1.50,
                'sort_order' => 3,
            ],
        ];

        foreach ($laminates as $laminate) {
            LaminateOption::updateOrCreate(
                ['slug' => $laminate['slug']],
                $laminate
            );
        }

        // Predefiniowane rozmiary dla każdego kształtu
        $rectangleShape = LabelShape::where('slug', 'rectangle')->first();
        $squareShape = LabelShape::where('slug', 'square')->first();
        $circleShape = LabelShape::where('slug', 'circle')->first();
        $ovalShape = LabelShape::where('slug', 'oval')->first();
        $starShape = LabelShape::where('slug', 'star')->first();

        // Rozmiary prostokątne
        if ($rectangleShape) {
            $rectangleSizes = [
                ['name' => '20×10 mm', 'width_mm' => 20, 'height_mm' => 10],
                ['name' => '30×20 mm', 'width_mm' => 30, 'height_mm' => 20],
                ['name' => '40×25 mm', 'width_mm' => 40, 'height_mm' => 25],
                ['name' => '50×30 mm', 'width_mm' => 50, 'height_mm' => 30],
                ['name' => '60×40 mm', 'width_mm' => 60, 'height_mm' => 40],
                ['name' => '80×50 mm', 'width_mm' => 80, 'height_mm' => 50],
                ['name' => '100×60 mm', 'width_mm' => 100, 'height_mm' => 60],
                ['name' => '120×80 mm', 'width_mm' => 120, 'height_mm' => 80],
            ];

            foreach ($rectangleSizes as $index => $size) {
                $slug = 'rect-' . $size['width_mm'] . 'x' . $size['height_mm'];
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $rectangleShape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['width_mm'],
                        'height_mm' => $size['height_mm'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        // Rozmiary kwadratowe
        if ($squareShape) {
            $squareSizes = [
                ['name' => '15×15 mm', 'size' => 15],
                ['name' => '20×20 mm', 'size' => 20],
                ['name' => '25×25 mm', 'size' => 25],
                ['name' => '30×30 mm', 'size' => 30],
                ['name' => '40×40 mm', 'size' => 40],
                ['name' => '50×50 mm', 'size' => 50],
                ['name' => '60×60 mm', 'size' => 60],
                ['name' => '80×80 mm', 'size' => 80],
            ];

            foreach ($squareSizes as $index => $size) {
                $slug = 'square-' . $size['size'];
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $squareShape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['size'],
                        'height_mm' => $size['size'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        // Rozmiary okrągłe (średnica)
        if ($circleShape) {
            $circleSizes = [
                ['name' => 'Ø 15 mm', 'diameter' => 15],
                ['name' => 'Ø 20 mm', 'diameter' => 20],
                ['name' => 'Ø 25 mm', 'diameter' => 25],
                ['name' => 'Ø 30 mm', 'diameter' => 30],
                ['name' => 'Ø 40 mm', 'diameter' => 40],
                ['name' => 'Ø 50 mm', 'diameter' => 50],
                ['name' => 'Ø 60 mm', 'diameter' => 60],
                ['name' => 'Ø 80 mm', 'diameter' => 80],
            ];

            foreach ($circleSizes as $index => $size) {
                $slug = 'circle-' . $size['diameter'];
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $circleShape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['diameter'],
                        'height_mm' => $size['diameter'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        // Rozmiary owalne
        if ($ovalShape) {
            $ovalSizes = [
                ['name' => '25×15 mm', 'width_mm' => 25, 'height_mm' => 15],
                ['name' => '30×20 mm', 'width_mm' => 30, 'height_mm' => 20],
                ['name' => '40×25 mm', 'width_mm' => 40, 'height_mm' => 25],
                ['name' => '50×30 mm', 'width_mm' => 50, 'height_mm' => 30],
                ['name' => '60×40 mm', 'width_mm' => 60, 'height_mm' => 40],
                ['name' => '80×50 mm', 'width_mm' => 80, 'height_mm' => 50],
            ];

            foreach ($ovalSizes as $index => $size) {
                $slug = 'oval-' . $size['width_mm'] . 'x' . $size['height_mm'];
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $ovalShape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['width_mm'],
                        'height_mm' => $size['height_mm'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        // Rozmiary gwiazdy
        if ($starShape) {
            $starSizes = [
                ['name' => '20×20 mm', 'size' => 20],
                ['name' => '25×25 mm', 'size' => 25],
                ['name' => '30×30 mm', 'size' => 30],
                ['name' => '40×40 mm', 'size' => 40],
                ['name' => '50×50 mm', 'size' => 50],
            ];

            foreach ($starSizes as $index => $size) {
                $slug = 'star-' . $size['size'];
                PredefinedSize::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'label_shape_id' => $starShape->id,
                        'name' => $size['name'],
                        'slug' => $slug,
                        'width_mm' => $size['size'],
                        'height_mm' => $size['size'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        $this->command->info('Label data seeded successfully!');
    }
}