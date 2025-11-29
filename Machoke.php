<?php

require_once 'Pokemon.php';
class Machoke extends Pokemon {
    private $movesList = [
        ['level' => 1, 'name' => 'Karate Chop', 'type' => 'Fighting', 'power' => 50, 'accuracy' => '100%', 'pp' => 25, 'details' => 'The target is attacked with a sharp chop. Critical hits land more easily.'],
        ['level' => 1, 'name' => 'Low Kick', 'type' => 'Fighting', 'power' => '-', 'accuracy' => '100%', 'pp' => 20, 'details' => 'A powerful low kick that makes the target fall over. The heavier the target, the greater the move\'s power.'],
        ['level' => 25, 'name' => 'Leer', 'type' => 'Normal', 'power' => '-', 'accuracy' => '100%', 'pp' => 30, 'details' => 'The user gives opposing Pokémon an intimidating leer that lowers the Defense stat.'],
        ['level' => 36, 'name' => 'Focus Energy', 'type' => 'Normal', 'power' => '-', 'accuracy' => '-', 'pp' => 30, 'details' => 'The user takes a deep breath and focuses so that critical hits land more easily.'],
        ['level' => 44, 'name' => 'Seismic Toss', 'type' => 'Fighting', 'power' => '-', 'accuracy' => '100%', 'pp' => 20, 'details' => 'The target is thrown using the power of gravity. It inflicts damage equal to the user\'s level.'],
        ['level' => 52, 'name' => 'Submission', 'type' => 'Fighting', 'power' => 80, 'accuracy' => '80%', 'pp' => 20, 'details' => 'The user grabs the target and recklessly dives for the ground. This also damages the user a little.']
    ];

    public function __construct($level = 1, $hp = 80, $attack = 100, $defense = 70, $speed = 45, $exp = 0, $maxExp = 100, $maxHp = 80) {
        parent::__construct("Machoke", "Fighting", $level, $hp, $attack, $defense, $speed);
        $this->exp = $exp;
        $this->maxExp = $maxExp;
        $this->maxHp = $maxHp;
    }

    public function getMoves() {
        $unlockedMoves = [];
        foreach ($this->movesList as $move) {
            if ($this->level >= $move['level']) {
                $unlockedMoves[] = $move;
            }
        }
        return $unlockedMoves;
    }

    public function specialMove() {
        $moves = $this->getMoves();
        if (empty($moves)) return "None";
        return end($moves)['name'];
    }

    public function getLatestMoveDetail() {
        $moves = $this->getMoves();
        if (empty($moves)) return "";
        return end($moves)['details'];
    }

    public function calculateStatGain($trainingType, $intensity) {
        $levelMultiplier = 1 + ($this->level * 0.05);
        $expGain = 0;
        $hpGain = 0;
        $statGains = [];

        switch ($trainingType) {
            case 'Strength': 
                $expGain = ceil(($intensity * 20) * $levelMultiplier);
                $hpGain = ceil(2 * $levelMultiplier); 
                $statGains['attack'] = ceil(($intensity * 0.8) * $levelMultiplier);
                break;
            case 'Speed': 
                $expGain = ceil(($intensity * 15) * $levelMultiplier);
                $hpGain = ceil(1 * $levelMultiplier);
                $statGains['speed'] = ceil(($intensity * 0.8) * $levelMultiplier);
                break;
            case 'Defense': 
                $expGain = ceil(($intensity * 12) * $levelMultiplier);
                $hpGain = ceil(5 * $levelMultiplier);
                $statGains['defense'] = ceil(($intensity * 0.8) * $levelMultiplier);
                break;
        }

        return array_merge(['exp' => $expGain, 'hp' => $hpGain], $statGains);
    }

    public function getTrainingDescription($trainingType) {
        switch ($trainingType) {
            case 'Strength':
                return "Machoke lifts heavy boulders! Attack rose!";
            case 'Speed':
                return "Machoke practices rapid punches! Speed rose!";
            case 'Defense':
                return "Machoke hardens its body! Defense rose!";
            default:
                return "Machoke is training hard!";
        }
    }


    public static function fromArray($data) {
        $attack = $data['attack'] ?? 100;
        $defense = $data['defense'] ?? 70;
        $speed = $data['speed'] ?? 45;

        return new Machoke(
            $data['level'],
            $data['hp'],
            $attack,
            $defense,
            $speed,
            $data['exp'],
            $data['maxExp'],
            $data['maxHp']
        );
    }
}
