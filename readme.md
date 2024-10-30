# Lucky 7 Game - README

## Overview

The **Lucky 7 Game** is a simple PHP-based dice game where players bet on the outcome of two rolled dice. Players can choose to bet on whether the sum of the two dice will be **below 7**, **exactly 7**, or **above 7**. The initial balance is set to 100, and players can reset it as needed.

## How It Works

- **Starting Balance**: Players start with an initial balance of 100.
- **Bet Types**:
  - **Below 7**: Wins if the sum is less than 7.
  - **Exactly 7**: Wins if the sum is exactly 7.
  - **Above 7**: Wins if the sum is greater than 7.
- **Profit/Loss**:
  - Betting on "Below 7" or "Above 7" yields a profit of 20 if the prediction is correct; otherwise, a loss of 10.
  - Betting on "Exactly 7" yields a profit of 30 if the sum is 7; otherwise, a loss of 10.
  
## Features

- **Dice Roll Simulation**: Simulates rolling two dice and calculates the sum.
- **Profit Calculation**: Adjusts the balance based on the bet type and outcome.
- **Session Management**: Uses PHP sessions to track the player’s balance across rounds.
- **Reset Option**: Players can reset the game to start with a fresh balance.

## Installation and Setup

1. Ensure your server supports PHP.
2. Place all files in a directory on your server.
3. Run the application by accessing the HTML page in a browser.

## File Structure

- `index.php`: Contains the core game logic and HTML interface.

## Code Explanation

### PHP Logic

- `session_start()`: Starts a PHP session to keep track of the player’s balance.
- `$_SESSION['balance']`: Holds the player’s balance, initialized to 100.
- `rollTheDices($type)`: Simulates the rolling of two dice and calculates profit or loss based on bet type.
- `getCurrentBalance($currbalance, $bet, $profit)`: Adjusts the current balance based on the result of the dice roll.

### HTML Structure

- Contains a simple form with fields for:
  - Bet amount input
  - Bet type selection (Below 7, Exactly 7, Above 7)
  - Game action buttons (Play, Reset, Continue)
  
### CSS Styling

A basic container style for a centered and visually appealing game interface.

## Usage

1. Set your bet amount.
2. Choose the type of bet.
3. Click **PLAY** to roll the dice and view the results.
4. Click **Reset and Play again** to restart the game with an initial balance of 100.
5. Click **Continue Playing** to place another bet without resetting the balance.

Enjoy the game!