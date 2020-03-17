<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = [
            'Diesel mechanisms' => [
                'Front support installation', 'Cylinderblock', 'Drive and counter installation',
                'Cylinder head and intake line installation', 'Pistons and connecting rods. Crankshaft. Flywheel.',
                'Clutch coupling installation', 'Distributing gear', 'Exhaust manifold installation',
                'Oil crankcase installation', 'Gear-type pump installation'
            ],
            'Feed system' => [
                'Air cleaner installation', 'Fuel equipment installation', 'Fine fuel filter', 'Coarse fuel filter'
            ],
            'Cooling system' => [
                'Thermostat housing installation', 'Water pump installation', 'Fan installation'
            ],
            'Lubrication system' => [
                'Oil pump installation', 'Centrifugal filter installation'
            ],
            'Pneumatic compressor' => [
                'Pneumatic compressor installation'
            ]
        ];

        $catalogs = [
            'Коробка передач' => [
                'Коробка передач. Корпус коробки передач', 'Вал первичный. Вал вторичный', 'Вал внутренний. Вал промежуточный',
                'Вал первой передачи и заднего хода', 'Редуктор', 'Коробка передач с рычагом переключения по центру',
                'Управление редуктором'
            ],
            'Раздаточная коробка' => [
                'Раздаточная коробка привода ПВМ (для трактора «БЕЛАРУС-92»)'
            ],
            'Привод карданный' => [
                'Карданный вал. Промежуточная опора карданного вала (для трактора «БЕЛАРУС-92»)',
                'Ограждение карданного вала (для трактора «БЕЛАРУС-92»)'
            ],
            'Передний ведущий мост' => [
                'Передний ведущий мост в сборе. Корпус и крышка. Дифференциал. (для трактора «БЕЛАРУС-92»)',
                'Главная передача. (Для трактора «БЕЛАРУС-92»)', 'Редуктор конечной передачи ПВМ (для трактора «БЕЛАРУС-92»)'
            ],
            'Задний мост' => [
                'Корпус заднего моста. Конечная передача', 'Дифференциал. Стакан подшипников', 'Механизм блокировки дифференциала'
            ],
            'Рама' => [
                'Полурама', 'Крюк прицепной гидрофицированный'
            ],
            'Ось передняя' => [
                'Ось передняя и тяга рулевая (для трактора «БЕЛАРУС-90»)'
            ]
        ];

        collect($catalogs)->each(function($catalogs, $name) {
            $parentCatalog = Catalog::create([
                'name' => $name
            ]);

            collect($catalogs)->each(function($catalog) use ($parentCatalog) {
                Catalog::create([
                    'name' => $catalog,
                    'parent_id' => $parentCatalog->id
                ]);
            });
        });
    }
}
