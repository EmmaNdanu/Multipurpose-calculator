<!DOCTYPE html>
<html>
<head>
    <title>Versatile Calculator</title>
    <style>
       body {
    background-color: grey;
    text-align: center;
  }
  fieldset {
    width: 800px;
    margin: 0 auto;
    text-align: left;
  }
  legend {
    text-align: center;
  }
  label {
    display: inline-block;
    width: 150px;
    text-align: right;
    margin-right: 10px; /* Add some margin between label and input */
  }
  .output {
    text-align: center; /* Center align the output */
    margin-top: 20px; /* Add some spacing between the form and output */  
 }</style>
    <script>
        function toggleNum2Field() {
            const operation = document.getElementById('operation').value;
            const num2Field = document.getElementById('num2Field');
            if (operation === 'sqrt' || operation === 'log') {
                num2Field.style.display = 'none';
            } else {
                num2Field.style.display = 'block';
            }
        }
    </script>
</head>
<body>
<fieldset>
    <div align="center"></div>
    <h1>Versatile Calculator</h1>
    <form method="post"style="text-align: center;">
        <label for="num1">Enter First number:</label>
        <input type="number" id="num1" name="num1" step="any" required>

        <label for="operation">Operation:</label>
        <select id="operation" name="operation" onchange="toggleNum2Field()">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="divide">Divide</option>
            <option value="exponent">Exponentiate</option>
            <option value="percentage">Percentage</option>
            <option value="sqrt">Square Root</option>
            <option value="log">Logarithm</option>
        </select>

        <div id="num2Field">
            <label for="num2">Second number (optional):</label>
            <input type="number" id="num2" name="num2" step="any">
        </div>

        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $num1 = isset($_POST['num1']) ? (float)$_POST['num1'] : 0;
        $num2 = isset($_POST['num2']) ? (float)$_POST['num2'] : 0;
        $operation = $_POST['operation'];
        $result = '';

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                $result = $num2 != 0 ? $num1 / $num2 : 'Error: Division by zero';
                break;
            case 'exponent':
                $result = pow($num1, $num2);
                break;
            case 'percentage':
                $result = ($num1 / 100) * $num2;
                break;
            case 'sqrt':
                $result = $num1 >= 0 ? sqrt($num1) : 'Error: Negative number for square root';
                break;
            case 'log':
                $result = $num1 > 0 ? ($num2 > 0 ? log($num1, $num2) : log($num1)) : 'Error: Logarithm of non-positive number';
                break;
            default:
                $result = 'Invalid operation';
        }
        echo "<h1>Result: $result</h1>";
    } else {
        echo "<h1>Invalid request</h1>";
    }
    ?>
    </fieldset>
</body>
</html>