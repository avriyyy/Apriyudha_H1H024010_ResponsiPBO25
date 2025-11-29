<?php
require_once 'GameManager.php';
$gm = new GameManager();
$pokemon = $gm->getPokemon();
$tier = $pokemon->getCardTier();
$message = "";
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $intensity = (int)$_POST['intensity'];
    $result = $gm->trainPokemon($type, $intensity);
    $message = $pokemon->getTrainingDescription($type);

    $pokemon = $gm->getPokemon();
    $tier = $pokemon->getCardTier();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train - PokéCare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-layout">

        <div class="dashboard-column">
            <div class="card">
                <h1>Training Session</h1>
                                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Training Type</label>
                        <div class="type-selector">
                            <input type="radio" name="type" id="type_strength" value="Strength">
                            <label for="type_strength" class="type-btn">Strength</label>
                            
                            <input type="radio" name="type" id="type_speed" value="Speed">
                            <label for="type_speed" class="type-btn">Speed</label>
                            
                            <input type="radio" name="type" id="type_defense" value="Defense">
                            <label for="type_defense" class="type-btn">Defense</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Intensity (1-10)</label>
                        <div class="intensity-selector">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <input type="radio" name="intensity" id="int_<?= $i ?>" value="<?= $i ?>">
                                <label for="int_<?= $i ?>" class="intensity-btn"><?= $i ?></label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.9rem; color: #bdc3c7;">
                            <span>EXP Level</span>
                            <?php if ($pokemon->getLevel() >= Pokemon::MAX_LEVEL): ?>
                                <span style="color: #f1c40f; font-weight: bold;">MAX!</span>
                            <?php else: ?>
                                <span><?= $pokemon->getExp() ?> / <?= $pokemon->getMaxExp() ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="progress-bar">
                            <?php 
                                $width = ($pokemon->getLevel() >= Pokemon::MAX_LEVEL) ? 100 : ($pokemon->getExp() / $pokemon->getMaxExp()) * 100;
                                $color = ($pokemon->getLevel() >= Pokemon::MAX_LEVEL) ? 'linear-gradient(90deg, #f1c40f, #e67e22)' : 'linear-gradient(90deg, var(--secondary-color), var(--primary-color))';
                            ?>
                            <div class="progress-fill" style="width: <?= $width ?>%; background: <?= $color ?>;"></div>
                        </div>
                    </div>
                    <br>

                    <div class="actions">
                        <button type="submit" class="btn" id="trainBtn" disabled>Train Now</button>
                        <a href="index.php" class="btn btn-secondary">Back Home</a>
                        <a href="history.php" class="btn btn-secondary">History</a>
                    </div>
                </form>
            </div>
        </div>


        <div class="card-column">
            <div class="pokemon-card-container">
                <div class="pokemon-card card-<?= $tier ?> <?= ($result && $result['levelUp']) ? 'level-up-anim' : '' ?>">

                    <div class="card-face card-front">
                        <div class="card-header">
                            <span>
                                <?= $pokemon->getName() ?> 
                                <?php if ($pokemon->getLevel() >= Pokemon::MAX_LEVEL): ?>
                                    <small class="level-max-text">Lv. MAX!</small>
                                <?php else: ?>
                                    <small style="font-size: 0.8em; opacity: 0.8;">
                                        Lv. <?= $pokemon->getLevel() ?>
                                        <?php if ($result && $result['levelUp']): ?>
                                            <span class="level-up-badge">Level Up!</span>
                                        <?php endif; ?>
                                    </small>
                                <?php endif; ?>
                            </span>
                            <span style="color: #e74c3c;">
                                <?= $pokemon->getHp() ?> HP
                                <?php if ($result && isset($result['gains']['hp'])): ?>
                                    <span class="stat-increase-badge">▲ +<?= $result['gains']['hp'] ?></span>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="card-image-container">
                            <img src="https://pokestop.io/img/pokemon/machoke-256x256.png" alt="Machoke" class="card-image">
                        </div>

                        <div class="card-stats-box">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 5px;">
                                <span>NO. 067</span>
                                <span>Fighting Pokémon</span>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px;">
                                <div>
                                    <div class="stat-label">ATTACK</div>
                                    <div class="stat-value">
                                        <?= $pokemon->getAttack() ?>
                                        <?php if ($result && isset($result['gains']['attack'])): ?>
                                            <span class="stat-increase-badge">▲ +<?= $result['gains']['attack'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="stat-label">DEFENSE</div>
                                    <div class="stat-value">
                                        <?= $pokemon->getDefense() ?>
                                        <?php if ($result && isset($result['gains']['defense'])): ?>
                                            <span class="stat-increase-badge">▲ +<?= $result['gains']['defense'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="stat-label">SPEED</div>
                                    <div class="stat-value">
                                        <?= $pokemon->getSpeed() ?>
                                        <?php if ($result && isset($result['gains']['speed'])): ?>
                                            <span class="stat-increase-badge">▲ +<?= $result['gains']['speed'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="stat-label">CURRENT MOVES</div>
                                    <div class="stat-value" style="font-size: 0.8rem; line-height: 1.2;">
                                        <?php 
                                            $moves = array_map(function($m) { return $m['name']; }, $pokemon->getMoves());
                                            echo implode(', ', array_slice($moves, -2));
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 15px; text-align: left;">
                                <div style="font-size: 0.7rem; color: #bdc3c7; text-transform: uppercase; font-weight: bold; margin-bottom: 3px;">Details Moves</div>
                                <div style="font-style: italic; font-size: 0.8rem; color: #ecf0f1; background: rgba(0,0,0,0.3); padding: 8px; border-radius: 5px;">
                                    "<?= $pokemon->getLatestMoveDetail() ?>"
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-face card-back">
                        <div class="pokeball-design">
                            <div class="pokeball-top"></div>
                            <div class="pokeball-bottom"></div>
                            <div class="pokeball-center"></div>
                        </div>
                        <div class="card-back-title">PokéCare</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trainBtn = document.getElementById('trainBtn');
            const typeInputs = document.querySelectorAll('input[name="type"]');
            const intensityInputs = document.querySelectorAll('input[name="intensity"]');

            function checkInputs() {
                const typeSelected = document.querySelector('input[name="type"]:checked');
                const intensitySelected = document.querySelector('input[name="intensity"]:checked');

                if (typeSelected && intensitySelected) {
                    trainBtn.disabled = false;
                    trainBtn.style.opacity = '1';
                    trainBtn.style.cursor = 'pointer';
                } else {
                    trainBtn.disabled = true;
                    trainBtn.style.opacity = '0.5';
                    trainBtn.style.cursor = 'not-allowed';
                }
            }

            typeInputs.forEach(input => input.addEventListener('change', checkInputs));
            intensityInputs.forEach(input => input.addEventListener('change', checkInputs));

            checkInputs();
        });
    </script>
</body>
</html>
