<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working Days Calculation</title>
</head>
<body>
    <h2>Enter your desired dates</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Date1: <input type="date" name="date1" value="<?php echo $_SESSION['date1']; ?>" required><br><br>
        Date2: <input type="date" name="date2" value="<?php echo $_SESSION['date2']; ?>" required><br><br>
        <input type="submit" value="Calculate" style="background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 10px;">

    </form>
</body>
</html>
<?php
session_start();
$govt_holidays = [
    '2024-01-07', '2024-02-21', '2024-02-26', '2024-03-17', '2024-03-26', 
    '2024-04-10', '2024-04-11', '2024-04-14', '2024-05-01', '2024-05-23', 
    '2024-06-16', '2024-06-17', '2024-06-18', '2024-07-17', '2024-08-15', 
    '2024-08-26', '2024-09-16', '2024-10-13', '2024-12-16', '2024-12-25'
];


function workingDays($date1, $date2, $govt_holidays) {
    $working_Days = 0;
    $start = new DateTime($date1);
    $end = new DateTime($date2);

    //iterating from start to end date
    while ($start <= $end) {
        $dayOfWeek = $start->format('N'); //format checking
        if ($dayOfWeek != 5 && $dayOfWeek !=6 && !in_array($start->format('Y-m-d'), $govt_holidays)) { //whether there is any fridays or govt holidays in between
            $working_Days++;
        }
        $start->modify('+1 day'); //moves to next day
    }

    return $working_Days;
}

if (!isset($_SESSION['date1'])) {
    $_SESSION['date1'] = '2024-04-01'; // Default start date
}
if (!isset($_SESSION['date2'])) {
    $_SESSION['date2'] = '2024-04-30'; // Default end date
}

// Process user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['date1'] = $_POST["date1"];
    $_SESSION['date2'] = $_POST["date2"];
}

// Calculate working days
$working_Days = workingDays($_SESSION['date1'], $_SESSION['date2'], $govt_holidays);

// Display result
echo "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333; font-weight: bold;'>Number of working days between {$_SESSION['date1']} and {$_SESSION['date2']}: <span style='color: Blue;'>$working_Days</span></p>";



?>

