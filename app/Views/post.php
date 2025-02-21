<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scientific Calculator with History</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .calculator {
            width: 350px;
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .history {
            width: 400px;
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-height: 500px;
            overflow-y: auto;
        }

        .history h3 {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 500;
            color: #333;
        }

        .history ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .history li {
            background-color: #fafafa;
            margin-bottom: 10px;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            font-size: 14px;
            color: #444;
        }

        .history li .btn-delete {
            background-color: #e57373;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 4px 8px;
            cursor: pointer;
            float: right;
            font-size: 12px;
        }

        .history li .btn-delete:hover {
            background-color: #e53935;
        }

        .display {
            width: 100%;
            height: 60px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 12px;
            font-size: 24px;
            color: #333;
            text-align: right;
            margin-bottom: 20px;
            outline: none;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .buttons button {
            padding: 15px;
            border-radius: 8px;
            border: none;
            background-color: #f1f1f1;
            font-size: 18px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #ddd;
        }

        .buttons button:active {
            transform: scale(0.98);
        }

        .operator {
            background-color: #ff8c00;
            color: #fff;
            font-weight: bold;
        }

        .operator:hover {
            background-color: #ff9800;
        }

        .operator:active {
            transform: scale(0.98);
        }

        .history {
            margin-top: 20px;
            width: 100%;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            overflow-y: auto;
            max-height: 300px;
        }

        .history h3 {
            font-size: 18px;
            color: #444;
            margin-bottom: 10px;
        }

        .history ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .history li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .history li .actions {
            display: flex;
            gap: 10px;
        }

        .history li .btn-edit,
        .history li .btn-delete {
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .history li .btn-edit {
            background-color: #42a5f5;
            color: #fff;
        }

        .history li .btn-edit:hover {
            background-color: #1e88e5;
        }

        .history li .btn-delete {
            background-color: #e57373;
            color: #fff;
        }

        .history li .btn-delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Scientific Calculator -->
        <div class="calculator">
            <input type="text" class="display" readonly />
            <div class="buttons">
                <button class="operator" data-value="AC">AC</button>
                <button class="operator" data-value="DEL">DEL</button>
                <button class="operator" data-value="%">%</button>
                <button class="operator" data-value="/">/</button>
                <button class="operator" data-value="π">π</button>

                <button data-value="7">7</button>
                <button data-value="8">8</button>
                <button data-value="9">9</button>
                <button class="operator" data-value="*">*</button>
                <button class="operator" data-value="e">e</button>

                <button data-value="4">4</button>
                <button data-value="5">5</button>
                <button data-value="6">6</button>
                <button class="operator" data-value="-">-</button>
                <button class="operator" data-value="xⁿ">xⁿ</button>

                <button data-value="1">1</button>
                <button data-value="2">2</button>
                <button data-value="3">3</button>
                <button class="operator" data-value="+">+</button>

                <button data-value="0">0</button>
                <button data-value="00">00</button>
                <button data-value=".">.</button>
                <button class="operator" data-value="=">=</button>
            </div>
        </div>

        <!-- History Section -->
        <div class="history">
            <h3>Calculation History</h3>
            <ul id="history-list">
                <!-- Riwayat akan ditambahkan di sini -->
                <?php foreach ($posts as $post): ?>
    <li>
        <strong>Input:</strong> <?= $post->input ?><br>
        <strong>Result:</strong> <?= $post->result ?><br>
        <small><?= $post->created_at ?></small>
        <button class="btn-edit" data-input="<?= $post->input ?>" title="Edit">
            <i class="fas fa-pencil-alt"></i> Continue
        </button>
        <a href="<?= base_url('home/deleteHistory/' . $post->id) ?>" class="btn-delete" title="Delete">
           <i class="fas fa-trash"></i> Delete
        </a>
    </li>
<?php endforeach; ?>

            </ul>
        </div>
    </div>

    <script>
        const display = document.querySelector(".display");
const buttons = document.querySelectorAll("button");
let output = "";

// Fungsi untuk menghitung
const calculate = (btnValue) => {
    display.focus();
    if (btnValue === "=" && output !== "") {
        const result = evaluate(output);
        if (result !== "Error") {
            sendToBackend(output, result); // Kirim input dan hasil ke backend
        }
        output = result;
    } else if (btnValue === "AC") {
        output = "";
    } else if (btnValue === "DEL") {
        output = output.slice(0, -1);
    } else {
        output += btnValue;
    }
    display.value = output;
};

// Fungsi untuk mengevaluasi ekspresi matematika
const evaluate = (expression) => {
    expression = expression
        .replace(/π/g, Math.PI)
        .replace(/e/g, Math.E)
        .replace(/xⁿ/g, "**");
    try {
        return eval(expression).toString();
    } catch {
        return "Error";
    }
};

// Fungsi untuk mengirim data ke backend
const sendToBackend = async (input, result) => {
    try {
        const response = await fetch("/home/addscience", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                calculation_input: input,
                calculation_result: result,
            }),
        });
        const data = await response.json();
        if (data.error) {
            console.error("Error:", data.error);
        } else {
            console.log("Success:", data);
            // Perbarui riwayat secara langsung (opsional)
        }
    } catch (error) {
        console.error("Error while sending data to backend:", error);
    }
};

// Tambahkan event listener untuk setiap tombol
buttons.forEach((button) => {
    button.addEventListener("click", (e) => calculate(e.target.dataset.value));
});

        const editButtons = document.querySelectorAll(".btn-edit");
    editButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            const input = e.target.dataset.input; // Ambil nilai input dari atribut data
            display.value = input; // Masukkan ke layar kalkulator
            output = input; // Simpan ke variabel output agar bisa dilanjutkan
        });
    });
    </script>
</body>

</html>
