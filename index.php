<?php session_start();
$_SESSION['balance'] = $_SESSION['balance'] ?? 100;

if ($_POST['rest'] ?? false) {
    session_unset();
    $_SESSION['balance'] = 100;
}
function rollTheDices($type)
{
    $dice1 = rand(1, 6);
    $dice2 = rand(1, 6);
    $sumDices = $dice1 + $dice2;
    $profit = match ($type) {
        0 => ($sumDices < 7) ? 20 : -10,
        1 => ($sumDices == 7) ? 30 : -10,
        2 => ($sumDices > 7) ? 20 : -10,
        default => -10,
    };
    return [$dice1, $dice2, $sumDices, $profit];
}

function getCurrentBalance($currbalance, $bet, $profit)
{
    $balance = ($currbalance - $bet) + $profit;
    return $balance;
}

if ($_POST['game_start'] ?? false) {
    $gameType = (int)$_POST['game_type'];
    $bet = (int)($_POST['game_bet'] ?? 10);
    [$dice1, $dice2, $sum, $profit] = rollTheDices($gameType);
    $_SESSION['balance'] = getCurrentBalance($_SESSION['balance'], $bet, $profit);
    $message = $profit > 0 ? "Congratulations! You win!" : "Loss!";
}
?>
<!DOCTYPE html>
<html>
<style>
    body {
        font-family: fantasy;
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    #container {
        width: 350px;
        padding: 20px;
        border: 1px solid #2e2e2e;
        margin: 100px auto;
        box-shadow: 2px 2px 10px #aaa;
        text-align: center;
        box-shadow: 4px 4px 10px #c87979;
        background-color: #edf4f3;
        border-radius: 20px;
    }
</style>

<body>
    <div id="container">
        <h2>Welcome to Lucky 7 Game </h2>
        <h3>Place your bet Rs ( <input type="int" value=10 name="game_bet" size="3" /> )</h3>
        <form method="post">
            <select name="game_type">
                <option value=0>Below 7</option>
                <option value=1> 7</option>
                <option value=2>Above 7</option>
            </select>
            <br />
            <?php if (isset($dice1)): ?>
                <p>Dice 1: <?= $dice1 ?></p>
                <p>Dice 2: <?= $dice2 ?></p>
                <p>Profit: <?= $profit ?></p>
                <p>Sum: <?= $sum ?></p>
                <p><?= $message ?> Your balance is now <?= $_SESSION['balance'] ?> Rs</p>
            <?php endif; ?>
            <br />
            <input type="submit" name="game_start" value="PLAY" style="width:30%;padding:5px;border-radius:8px;">
            <br /> <br />
            <input type="submit" name="rest" value="Reset and Play again">
            <input type="submit" name="continue" value="Continue Playing">
        </form>
    </div>
</body>

</html>