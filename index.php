<?php
require_once 'GameManager.php';
$gm = new GameManager();
$pokemon = $gm->getPokemon();
$tier = $pokemon->getCardTier();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Machoke</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-layout">

        <div class="dashboard-column">
            <div class="card">
                <h1>PokéCare</h1>
                
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-label">EXP Level</div>
                        <div class="stat-value">
                            <?php if ($pokemon->getLevel() >= Pokemon::MAX_LEVEL): ?>
                                <span style="color: #f1c40f;">Lv. MAX</span>
                            <?php else: ?>
                                Lv. <?= $pokemon->getLevel() ?> <small style="font-size: 0.6em; color: #bdc3c7;">(<?= $pokemon->getExp() ?>/<?= $pokemon->getMaxExp() ?>)</small>
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
                    <div class="stat-item">
                        <div class="stat-label">HP</div>
                        <div class="stat-value"><?= $pokemon->getHp() ?> / <?= $pokemon->getMaxHp() ?></div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= ($pokemon->getHp() / $pokemon->getMaxHp()) * 100 ?>%"></div>
                        </div>
                    </div>
                    <div class="stat-item" style="grid-column: span 2; text-align: left;">
                        <div class="stat-label" style="margin-bottom: 5px;">Current Moves</div>
                        <div style="font-size: 0.85rem;">
                            <table style="width: 100%; border-collapse: collapse; color: #ecf0f1;">
                                <thead>
                                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.2); color: #bdc3c7;">
                                        <th style="text-align: left; padding: 2px;">Lv.</th>
                                        <th style="text-align: left; padding: 2px;">Name</th>
                                        <th style="text-align: left; padding: 2px;">Type</th>
                                        <th style="text-align: left; padding: 2px;">Power</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pokemon->getMoves() as $move): ?>
                                    <tr>
                                        <td style="padding: 2px;"><?= $move['level'] ?></td>
                                        <td style="padding: 2px;"><?= $move['name'] ?></td>
                                        <td style="padding: 2px;">
                                            <span style="background: <?= $move['type'] == 'Fighting' ? '#c0392b' : '#95a5a6' ?>; padding: 1px 4px; border-radius: 3px; font-size: 0.7em;"><?= $move['type'] ?></span>
                                        </td>
                                        <td style="padding: 2px;"><?= $move['power'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 15px; text-align: left; padding: 10px; background: rgba(0,0,0,0.2); border-radius: 8px;">
                    <h3 style="margin: 0 0 5px 0; color: var(--secondary-color); font-size: 0.9rem;">Card Status</h3>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.85rem;">Tier: <strong style="text-transform: uppercase; color: white;"><?= $tier ?></strong></span>
                        <span style="font-size: 0.75rem; color: #bdc3c7;">
                            <?php if ($tier === 'common'): ?>
                                Lvl 25 &rarr; Rare
                            <?php elseif ($tier === 'rare'): ?>
                                Lvl 36 &rarr; Ultra Rare
                            <?php elseif ($tier === 'ultra-rare'): ?>
                                Lvl 44 &rarr; Legendary
                            <?php else: ?>
                                MAX TIER
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <div class="actions" style="margin-top: 20px;">
                    <a href="train.php" class="btn">Start Training</a>
                    <a href="history.php" class="btn btn-secondary">Training History</a>
                </div>
            </div>
        </div>


        <div class="card-column">
            <div class="pokemon-card-container">
                <div class="pokemon-card card-<?= $tier ?>">

                    <div class="card-face card-front">
                        <div class="card-header">
                            <span>
                                <?= $pokemon->getName() ?> 
                                <?php if ($pokemon->getLevel() >= Pokemon::MAX_LEVEL): ?>
                                    <small class="level-max-text">Lv. MAX!</small>
                                <?php else: ?>
                                    <small style="font-size: 0.8em; opacity: 0.8;">Lv. <?= $pokemon->getLevel() ?></small>
                                <?php endif; ?>
                            </span>
                            <span style="color: #e74c3c;"><?= $pokemon->getHp() ?> HP</span>
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
                                    <div class="stat-value"><?= $pokemon->getAttack() ?></div>
                                </div>
                                <div>
                                    <div class="stat-label">DEFENSE</div>
                                    <div class="stat-value"><?= $pokemon->getDefense() ?></div>
                                </div>
                                <div>
                                    <div class="stat-label">SPEED</div>
                                    <div class="stat-value"><?= $pokemon->getSpeed() ?></div>
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
</body>
</html>
