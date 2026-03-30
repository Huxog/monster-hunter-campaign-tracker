<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Monster;
use Illuminate\Database\Seeder;

class MonsterSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedMonsters();
        $this->seedDrops();
    }

    private function seedMonsters(): void
    {
        $monsters = [
            [
                'name' => 'Rathalos',
                'description' => 'The King of the Skies. A flying wyvern that rules the skies and attacks anything that enters its territory.',
                'stars' => 5,
                'elementalWeaknesses' => ['Fire' => 0, 'Water' => 1, 'Thunder' => 3, 'Ice' => 1, 'Dragon' => 2],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 0, 'Sleep' => 2, 'Stun' => 0, 'Blast' => 1],
            ],
            [
                'name' => 'Rathian',
                'description' => 'The Queen of the Land. The female counterpart of Rathalos, known for its powerful tail sweeps laced with poison.',
                'stars' => 4,
                'elementalWeaknesses' => ['Fire' => 0, 'Water' => 1, 'Thunder' => 3, 'Ice' => 1, 'Dragon' => 2],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 0, 'Sleep' => 2, 'Stun' => 0, 'Blast' => 1],
            ],
            [
                'name' => 'Nargacuga',
                'description' => 'A swift and agile fanged wyvern with jet-black fur. Its incredible speed makes it one of the most dangerous predators in the wild.',
                'stars' => 4,
                'elementalWeaknesses' => ['Fire' => 1, 'Water' => 1, 'Thunder' => 2, 'Ice' => 1, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 1, 'Paralysis' => 2, 'Sleep' => 2, 'Stun' => 1, 'Blast' => 1],
            ],
            [
                'name' => 'Tigrex',
                'description' => 'A primitive flying wyvern with powerful forelimbs and thunderous roars. Its raw strength and aggression make it extremely hazardous.',
                'stars' => 4,
                'elementalWeaknesses' => ['Fire' => 0, 'Water' => 1, 'Thunder' => 2, 'Ice' => 1, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 2, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 1],
            ],
            [
                'name' => 'Zinogre',
                'description' => 'A fanged wyvern that channels the power of thunder through its body. It grows stronger as it charges up, making it increasingly dangerous.',
                'stars' => 5,
                'elementalWeaknesses' => ['Fire' => 1, 'Water' => 1, 'Thunder' => 0, 'Ice' => 3, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 1, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 1],
            ],
            [
                'name' => 'Diablos',
                'description' => 'A flying wyvern that dwells in arid desert regions. Its enormous twin horns and powerful frame make it one of the most feared creatures.',
                'stars' => 5,
                'elementalWeaknesses' => ['Fire' => 1, 'Water' => 1, 'Thunder' => 1, 'Ice' => 3, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 1, 'Paralysis' => 3, 'Sleep' => 1, 'Stun' => 2, 'Blast' => 1],
            ],
            [
                'name' => 'Brachydios',
                'description' => 'A brute wyvern that uses slime mould on its fists to create explosive attacks. Its forearms are coated in a self-produced explosive compound.',
                'stars' => 6,
                'elementalWeaknesses' => ['Fire' => 0, 'Water' => 2, 'Thunder' => 1, 'Ice' => 3, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 1, 'Paralysis' => 1, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 3],
            ],
            [
                'name' => 'Teostra',
                'description' => 'An elder dragon that manipulates fire and explosive powder. Its body is constantly shedding fire scales that can ignite at any moment.',
                'stars' => 6,
                'elementalWeaknesses' => ['Fire' => 0, 'Water' => 3, 'Thunder' => 1, 'Ice' => 2, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 1, 'Paralysis' => 1, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 3],
            ],
            [
                'name' => 'Kushala Daora',
                'description' => 'An elder dragon with a metallic hide that controls wind and creates impenetrable barriers of storm around itself.',
                'stars' => 6,
                'elementalWeaknesses' => ['Fire' => 2, 'Water' => 1, 'Thunder' => 3, 'Ice' => 1, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 1, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 1],
            ],
            [
                'name' => 'Rajang',
                'description' => 'A fanged beast of extraordinary power that can transform into an electrified golden state, dramatically boosting all its capabilities.',
                'stars' => 7,
                'elementalWeaknesses' => ['Fire' => 1, 'Water' => 1, 'Thunder' => 0, 'Ice' => 3, 'Dragon' => 1],
                'ailmentWeaknesses' => ['Poison' => 2, 'Paralysis' => 2, 'Sleep' => 1, 'Stun' => 1, 'Blast' => 1],
            ],
        ];

        foreach ($monsters as $data) {
            Monster::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedDrops(): void
    {
        $dropTable = [
            'Rathalos' => [
                'Rathalos Scale', 'Rathalos Shell', 'Rathalos Wing',
                'Rathalos Tail', 'Rathalos Plate', 'Rathalos Ruby',
                'Wyvern Gem',
            ],
            'Rathian' => [
                'Rathian Scale', 'Rathian Shell', 'Rathian Wing',
                'Rathian Spike', 'Rathian Plate', 'Rathian Ruby',
                'Wyvern Gem',
            ],
            'Nargacuga' => [
                'Nargacuga Fur', 'Nargacuga Scale', 'Nargacuga Claw',
                'Nargacuga Tail', 'Nargacuga Plate', 'Swift Fang',
            ],
            'Tigrex' => [
                'Tigrex Scale', 'Tigrex Shell', 'Tigrex Claw',
                'Tigrex Fang', 'Tigrex Tail', 'Tigrex Plate',
            ],
            'Zinogre' => [
                'Zinogre Scale', 'Zinogre Shell', 'Zinogre Claw',
                'Zinogre Tail', 'Zinogre Horn', 'Zinogre Plate', 'Zinogre Ruby',
            ],
            'Diablos' => [
                'Diablos Scale', 'Diablos Shell', 'Diablos Horn',
                'Diablos Tailblade', 'Diablos Carapace', 'Diablos Plate',
            ],
            'Brachydios' => [
                'Monster Bone L', 'Monster Bone+', 'Heavy Bone',
                'Wyvern Claw', 'Wyvern Gem',
            ],
            'Teostra' => [
                'Elder Dragon Blood', 'Elder Dragon Gem',
                'Dragon Scale', 'Dragon Bone', 'Firecell Stone',
            ],
            'Kushala Daora' => [
                'Elder Dragon Blood', 'Elder Dragon Gem',
                'Dragon Scale', 'Dragon Bone', 'Dragonite Ore',
            ],
            'Rajang' => [
                'Monster Bone+', 'Heavy Bone', 'Fierce Dragonbone',
                'Wyvern Claw', 'Wyvern Fang', 'Wyvern Gem',
            ],
        ];

        foreach ($dropTable as $monsterName => $materialNames) {
            $monster = Monster::where('name', $monsterName)->first();

            if (! $monster) {
                continue;
            }

            $materialIds = Material::whereIn('name', $materialNames)
                ->pluck('id')
                ->toArray();

            $monster->materials()->syncWithoutDetaching($materialIds);
        }
    }
}
