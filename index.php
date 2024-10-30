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
    $sumDice = $dice1 + $dice2;
    $profit = match ($type) {
        0 => ($sumDice < 7) ? 20 : -10,
        1 => ($sumDice == 7) ? 30 : -10,
        2 => ($sumDice > 7) ? 20 : -10,
        default => -10,
    };
    return ['dice1' => $dice1, 'dice2' => $dice2, 'sum' => $sumDice, 'profit' => $profit];
}

function getCurrentBalance($currbalance, $bet, $profit)
{
    $balance = ($currbalance - $bet) + $profit;
    return $balance;
}

if ($_POST['game_start'] ?? false) {
    $gameType = (int)$_POST['game_type'];
    $bet = (int)($_POST['game_bet'] ?? 10);
    $diceInfo = rollTheDices($gameType);
    $_SESSION['balance'] = getCurrentBalance($_SESSION['balance'], $bet, $diceInfo['profit']);
    $message = $diceInfo['profit'] > 0 ? "Congratulations! You win!" : "Loss!";
}
?>
<!DOCTYPE html>
<html>
<style>
    #container {
        width: 350px;
        padding: 20px;
        border: 1px solid #ccc;
        margin: 100px auto;
        box-shadow: 2px 2px 10px #aaa;
        text-align: center;
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
            <?php if (isset($diceInfo)): ?>
                <p>Dice 1: <?= $diceInfo['dice1'] ?></p>
                <p>Dice 2: <?= $diceInfo['dice2'] ?></p>
                <p>Profit: <?= $diceInfo['profit'] ?></p>
                <p>Sum: <?= $diceInfo['sum'] ?></p>
                <p><?= $message ?> Your balance is now <?= $_SESSION['balance'] ?> Rs</p>
            <?php endif; ?>
            <br />
            <input type="submit" name="game_start" value="PLAY" style="width:30%;padding:10px;border-radius:8px;">
            <br /> <br />
            <input type="submit" name="rest" value="Reset and Play again">
            <input type="submit" name="continue" value="Continue Playing">
        </form>
    </div>
</body>

</html>