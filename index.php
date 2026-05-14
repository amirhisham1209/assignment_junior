<!DOCTYPE html>
<html>

<head>
    <title>Electricity Calculator</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <!-- Input Form -->
    <div class="card p-4">

        <h2 class="mb-4">Calculate</h2>

        <form method="POST">

            <!-- Voltage -->
            <div class="mb-3">

                <label>Voltage (V)</label>

                <input
                    type="number"
                    step="any"
                    min="0"
                    name="voltage"
                    class="form-control"

                    value="<?php echo $_POST['voltage'] ?? ''; ?>"

                    required
                >

            </div>

            <!-- Current -->
            <div class="mb-3">

                <label>Current (A)</label>

                <input
                    type="number"
                    step="any"
                    min="0"
                    name="current"
                    class="form-control"

                    value="<?php echo $_POST['current'] ?? ''; ?>"

                    required
                >

            </div>

            <!-- Current Rate -->
            <div class="mb-3">

                <label>Current Rate (sen/kWh)</label>

                <input
                    type="number"
                    step="any"
                    min="0"
                    name="rate"
                    class="form-control"

                    value="<?php echo $_POST['rate'] ?? ''; ?>"

                    required
                >

            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">
                Calculate
            </button>

            <a href="index.php" class="btn btn-secondary">
                Reset
            </a>

        </form>

    </div>

<?php

// check if form submitted
if(isset($_POST['voltage']))
{
    // get values
    $voltage = $_POST['voltage'];

    $current = $_POST['current'];

    $rate = $_POST['rate'];

    // validation
    if($voltage < 0 || $current < 0 || $rate < 0)
    {
?>

        <div class="alert alert-danger mt-4">

            Input cannot be negative.

        </div>

<?php
    }
    else
    {
        // calculate power in kW
        $power = ($voltage * $current) / 1000;

        // convert sen to RM
        $rateRM = $rate / 100;
?>

    <!-- Result Section -->
    <div class="card mt-4 p-4">

        <h3>Results</h3>

        <p>
            <b>Voltage :</b>
            <?php echo $voltage; ?> V
        </p>

        <p>
            <b>Current :</b>
            <?php echo $current; ?> A
        </p>

        <p>
            <b>Current Rate :</b>
            <?php echo $rate; ?> sen/kWh
        </p>

        <p>
            <b>Power :</b>
            <?php echo number_format($power, 5); ?> kW
        </p>

        <p>
            <b>Rate :</b>
            RM <?php echo number_format($rateRM, 3); ?>
        </p>

        <!-- Result Table -->
        <table class="table table-bordered mt-3">

            <tr>
                <th>#</th>
                <th>Hour</th>
                <th>Energy (kWh)</th>
                <th>Total (RM)</th>
            </tr>

<?php

        // calculate from 1 hour to 24 hours
        for($hour = 1; $hour <= 24; $hour++)
        {
            // calculate energy
            $energy = $power * $hour;

            // calculate total
            $total = $energy * $rateRM;
?>

            <tr>

                <td><?php echo $hour; ?></td>

                <td><?php echo $hour; ?></td>

                <td><?php echo number_format($energy, 5); ?></td>

                <td><?php echo number_format($total, 2); ?></td>

            </tr>

<?php
        }
?>

        </table>

    </div>

<?php
    }
}
?>

</div>

</body>
</html>