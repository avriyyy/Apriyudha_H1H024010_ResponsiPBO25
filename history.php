<?php
require_once 'GameManager.php';
$gm = new GameManager();
$history = $gm->getHistory();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - PokéCare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            overflow: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            height: 90vh;
            width: 90%;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
        }
        .card {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 10px;
            padding: 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .history-table thead th {
            position: sticky;
            top: 0;
            background: rgba(26, 26, 26, 0.95);
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: var(--secondary-color);
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        .history-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
        }
        .history-table tr:last-child td {
            border-bottom: none;
        }
        .history-table tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }
        .card::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Training History</h1>
        </div>

        </div>
    </div>
</body>
</html>
