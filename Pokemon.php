<?php

abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $maxHp;
    protected $attack;
    protected $defense;
    protected $speed;
    protected $exp;
    protected $maxExp;

    const MAX_LEVEL = 55;

    public function __construct($name, $type, $level, $hp, $attack, $defense, $speed) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->maxHp = $hp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->exp = 0;
        $this->maxExp = 100;
    }

    public function getName() { return $this->name; }
    public function getType() { return $this->type; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
    public function getMaxHp() { return $this->maxHp; }
    public function getAttack() { return $this->attack; }
    public function getDefense() { return $this->defense; }
    public function getSpeed() { return $this->speed; }
    public function getExp() { return $this->exp; }
    public function getMaxExp() { return $this->maxExp; }

    abstract public function getMoves();
    abstract public function specialMove();
    abstract public function getLatestMoveDetail();
    abstract public function calculateStatGain($trainingType, $intensity);
    abstract public function getTrainingDescription($trainingType);

    public function getCardTier() {
        if ($this->level >= 44) return 'legendary';
        if ($this->level >= 36) return 'ultra-rare';
        if ($this->level >= 25) return 'rare';
        return 'common';
    }

    public function train($trainingType, $intensity) {

        
        $gains = $this->calculateStatGain($trainingType, $intensity);
        

        if ($this->level < self::MAX_LEVEL) {
            $this->exp += $gains['exp'];
        }
        
        $this->hp += $gains['hp'];
        if ($this->hp > $this->maxHp) $this->hp = $this->maxHp;
        
        if (isset($gains['attack'])) $this->attack += $gains['attack'];
        if (isset($gains['defense'])) $this->defense += $gains['defense'];
        if (isset($gains['speed'])) $this->speed += $gains['speed'];


        $levelUp = false;
        while ($this->exp >= $this->maxExp && $this->level < self::MAX_LEVEL) {
            $this->level++;
            $this->exp -= $this->maxExp;
            $this->maxExp = floor($this->maxExp * 1.1);
            $this->maxHp = floor($this->maxHp * 1.1);
            $this->attack = floor($this->attack * 1.1);
            $this->defense = floor($this->defense * 1.1);
            $this->speed = floor($this->speed * 1.1);
            $this->hp = $this->maxHp;
            $levelUp = true;
        }

        return [
            'gains' => $gains,
            'levelUp' => $levelUp,
            'currentStats' => [
                'level' => $this->level,
                'hp' => $this->hp,
                'maxHp' => $this->maxHp,
                'attack' => $this->attack,
                'defense' => $this->defense,
                'speed' => $this->speed,
                'exp' => $this->exp
            ]
        ];
    }


    public function toArray() {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'level' => $this->level,
            'hp' => $this->hp,
            'maxHp' => $this->maxHp,
            'attack' => $this->attack,
            'defense' => $this->defense,
            'speed' => $this->speed,
            'exp' => $this->exp,
            'maxExp' => $this->maxExp
        ];
    }

    public static function fromArray($data) {

    }
}
