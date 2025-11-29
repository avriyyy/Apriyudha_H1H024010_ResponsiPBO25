<?php

require_once 'Machoke.php';

class GameManager {
    private $pokemonFile = __DIR__ . '/pokemon.json';
    private $historyFile = __DIR__ . '/history.json';
    private $pokemon;

    public function __construct() {
        $this->loadPokemon();
    }

    public function getPokemon() {
        return $this->pokemon;
    }

    private function loadPokemon() {
        if (file_exists($this->pokemonFile)) {
            $data = json_decode(file_get_contents($this->pokemonFile), true);
            if ($data) {
                $this->pokemon = Machoke::fromArray($data);
                return;
            }
        }

        $this->pokemon = new Machoke();
        $this->savePokemon();
    }

    public function savePokemon() {
        file_put_contents($this->pokemonFile, json_encode($this->pokemon->toArray(), JSON_PRETTY_PRINT));
    }

    public function trainPokemon($type, $intensity) {
        $levelBefore = $this->pokemon->getLevel();
        $hpBefore = $this->pokemon->getHp();
        
        $result = $this->pokemon->train($type, $intensity);
        $this->savePokemon();
        
        $this->logHistory($type, $intensity, $result, $levelBefore, $hpBefore);
        return $result;
    }

    private function logHistory($type, $intensity, $result, $levelBefore, $hpBefore) {
        $history = [];
        if (file_exists($this->historyFile)) {
            $history = json_decode(file_get_contents($this->historyFile), true) ?? [];
        }

        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'intensity' => $intensity,
            'level_before' => $levelBefore,
            'level_after' => $result['currentStats']['level'],
            'hp_before' => $hpBefore,
            'hp_after' => $result['currentStats']['hp'],
            'exp_gained' => $result['gains']['exp']
        ];

        array_unshift($history, $entry);
        file_put_contents($this->historyFile, json_encode($history, JSON_PRETTY_PRINT));
    }

    public function getHistory() {
        if (file_exists($this->historyFile)) {
            return json_decode(file_get_contents($this->historyFile), true) ?? [];
        }
        return [];
    }
    
    public function resetGame() {
        if (file_exists($this->pokemonFile)) unlink($this->pokemonFile);
        if (file_exists($this->historyFile)) unlink($this->historyFile);
        $this->loadPokemon();
    }
}
