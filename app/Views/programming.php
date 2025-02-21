<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programmer Calculator</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 50px;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 50px auto;
    }

    .calculator, .history {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 45%; /* Adjust width for a balanced layout */
      min-width: 300px;
    }

    h2, h3 {
      color: #333;
      margin-bottom: 20px;
    }

    .display {
      width: 100%;
      height: 60px;
      font-size: 28px;
      text-align: right;
      border: 2px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
      background-color: #f9f9f9;
      color: #333;
    }

    select, input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 10px;
      border: 1px solid #ddd;
      font-size: 16px;
      background-color: #fff;
      color: #333;
    }

    .buttons {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    button {
      padding: 20px;
      font-size: 20px;
      border: none;
      border-radius: 10px;
      background: #f0f0f0;
      cursor: pointer;
      transition: background 0.3s ease;
      color: #333;
    }

    button:hover {
      background: #e0e0e0;
    }

    .operator {
      background: #4caf50;
      color: white;
    }

    .operator:hover {
      background: #45a049;
    }

    .history ul {
      list-style: none;
      padding: 0;
      margin: 0;
      max-height: 300px;
      overflow-y: auto;
    }

    .history li {
      display: flex;
      justify-content: space-between;
      background: #f9f9f9;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 8px;
      font-size: 14px;
      color: #333;
    }

    .history li button {
      background: #e57373;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 5px 12px;
      font-size: 12px;
    }

    .history li button:hover {
      background: #d32f2f;
    }

    .history h3 {
      font-size: 20px;
      font-weight: 600;
      color: #333;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }

      .calculator, .history {
        width: 90%;
        min-width: 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Kalkulator -->
    <div class="calculator">
      <h2>Programmer Calculator</h2>
      <select id="base-select">
        <option value="dec">Decimal</option>
        <option value="bin">Binary</option>
        <option value="oct">Octal</option>
        <option value="hex">Hexadecimal</option>
      </select>
      <input type="text" class="display" id="display" readonly />

      <div class="buttons">
        <button data-value="A">A</button>
        <button data-value="B">B</button>
        <button data-value="C">C</button>
        <button class="operator" data-value="clear">C</button>
        <button data-value="D">D</button>
        <button data-value="E">E</button>
        <button data-value="F">F</button>
        <button class="operator" data-value="DEL">DEL</button>
        <button data-value="1">1</button>
        <button data-value="2">2</button>
        <button data-value="3">3</button>
        <button class="operator" data-value="+">+</button>
        <button data-value="4">4</button>
        <button data-value="5">5</button>
        <button data-value="6">6</button>
        <button class="operator" data-value="-">-</button>
        <button data-value="7">7</button>
        <button data-value="8">8</button>
        <button data-value="9">9</button>
        <button class="operator" data-value="*">*</button>
        <button data-value="0">0</button>
        <button class="operator" data-value="=">=</button>
        <button class="operator" data-value="/">/</button>
      </div>
    </div>

    <!-- History -->
    <div class="history">
      <h3>History</h3>
      <ul id="history-list"></ul>
    </div>
  </div>

  <script>
    const display = document.getElementById("display");
    const buttons = document.querySelectorAll("button");
    const historyList = document.getElementById("history-list");
    const baseSelect = document.getElementById("base-select");
    let output = "";

    const calculate = (btnValue) => {
      const base = baseSelect.value;
      if (btnValue === "clear") {
        output = "";
      } else if (btnValue === "DEL") {
        output = output.slice(0, -1);
      } else if (btnValue === "=") {
        try {
          let result;
          if (base === "bin") {
            result = evalBinaryExpression(output);
          } else if (base === "oct") {
            result = evalOctalExpression(output);
          } else if (base === "hex") {
            result = evalHexExpression(output);
          } else {
            result = eval(output);
          }

          const finalResult = convertResult(result, base);
          addHistory(output, finalResult);
          output = finalResult.toString();
        } catch {
          output = "Error";
        }
      } else {
        output += btnValue;
      }
      display.value = output;
    };

    const evalBinaryExpression = (expr) => {
      return eval(expr.split(/([+\-*/])/).map((item) => {
        return item.match(/^[01]+$/) ? parseInt(item, 2) : item;
      }).join(''));
    };

    const evalOctalExpression = (expr) => {
      return eval(expr.split(/([+\-*/])/).map((item) => {
        return item.match(/^[0-7]+$/) ? parseInt(item, 8) : item;
      }).join(''));
    };

    const evalHexExpression = (expr) => {
      return eval(expr.split(/([+\-*/])/).map((item) => {
        return item.match(/^[0-9A-Fa-f]+$/) ? parseInt(item, 16) : item;
      }).join(''));
    };

    const convertResult = (result, base) => {
      switch (base) {
        case "bin":
          return result.toString(2);
        case "oct":
          return result.toString(8);
        case "hex":
          return result.toString(16).toUpperCase();
        default:
          return result;
      }
    };

    const addHistory = (input, result) => {
      const li = document.createElement("li");
      li.innerHTML = `${input} = ${result} <button onclick="continueCalculation('${input}')">Continue</button><button onclick="this.parentElement.remove()">Delete</button>`;
      historyList.prepend(li);
    };

    const continueCalculation = (input) => {
      // Load the previous calculation into the display
      output = input;
      display.value = output;
    };

    buttons.forEach((button) => {
      button.addEventListener("click", (e) => calculate(e.target.dataset.value));
    });
  </script>
</body>
</html>
