<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Date Calculation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f9;
    }

    .container {
      display: flex;
      gap: 20px;
      margin-top: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .calculator {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      width: 45%; /* Set to half width */
      min-width: 300px;
    }

    .display {
      width: 100%;
      height: 50px;
      font-size: 18px;
      text-align: right;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 20px;
    }

    .date-input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }

    .operator {
      background: #4caf50;
      color: #fff;
      padding: 15px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .operator:hover {
      background: #45a049;
    }

    h2 {
      font-size: 20px;
      margin-bottom: 15px;
    }

    h3 {
      margin-top: 15px;
      font-size: 18px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Calculate Difference Form -->
    <div class="calculator">
      <h2>Calculate Date Difference</h2>
      <label for="start-date">Start Date:</label>
      <input type="date" id="start-date" class="date-input" />
      <label for="end-date">End Date:</label>
      <input type="date" id="end-date" class="date-input" />
      <button class="operator" id="calculate-difference">Calculate Difference</button>
      
      <h3>Result:</h3>
      <input type="text" class="display" id="result-difference" readonly />
    </div>

    <!-- Add/Subtract Days Form -->
    <div class="calculator">
      <h2>Add/Subtract Days</h2>
      <label for="start-date-2">Start Date:</label>
      <input type="date" id="start-date-2" class="date-input" />
      <label for="days">Number of Days:</label>
      <input type="number" id="days" class="date-input" />
      <label for="operation">Operation:</label>
      <select id="operation" class="date-input">
        <option value="add">Add Days</option>
        <option value="subtract">Subtract Days</option>
      </select>
      <button class="operator" id="calculate-add-subtract">Calculate</button>

      <h3>Result:</h3>
      <input type="text" class="display" id="result-add-subtract" readonly />
    </div>
  </div>

  <script>
    // Elements for "Calculate Difference"
    const calculateDifferenceBtn = document.getElementById("calculate-difference");
    const resultDifferenceDisplay = document.getElementById("result-difference");
    const startDateInputDifference = document.getElementById("start-date");
    const endDateInputDifference = document.getElementById("end-date");

    // Elements for "Add/Subtract Days"
    const calculateAddSubtractBtn = document.getElementById("calculate-add-subtract");
    const resultAddSubtractDisplay = document.getElementById("result-add-subtract");
    const startDateInputAddSubtract = document.getElementById("start-date-2");
    const daysInput = document.getElementById("days");
    const operationSelect = document.getElementById("operation");

    // Calculate Difference
    calculateDifferenceBtn.addEventListener("click", function() {
      const startDate = new Date(startDateInputDifference.value);
      const endDate = new Date(endDateInputDifference.value);

      const difference = Math.abs((endDate - startDate) / (1000 * 60 * 60 * 24)); // Difference in days
      const dayOfWeek = startDate.toLocaleDateString('en-US', { weekday: 'long' });

      resultDifferenceDisplay.value = `${difference} days (${dayOfWeek})`;
    });

    // Add/Subtract Days
    calculateAddSubtractBtn.addEventListener("click", function() {
      const startDate = new Date(startDateInputAddSubtract.value);
      const days = parseInt(daysInput.value, 10);
      const operation = operationSelect.value;

      const newDate = new Date(startDate);
      if (operation === "add") {
        newDate.setDate(startDate.getDate() + days); // Add days
      } else if (operation === "subtract") {
        newDate.setDate(startDate.getDate() - days); // Subtract days
      }

      const newDayOfWeek = newDate.toLocaleDateString('en-US', { weekday: 'long' });
      const formattedDate = newDate.toISOString().split('T')[0];

      resultAddSubtractDisplay.value = `${newDayOfWeek}, ${formattedDate}`;
    });
  </script>
</body>
</html>
