<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon</title>
    <style>
        body {
            font-family: Arial, sans-serif;

            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        
        .container, .history-container {
            background: white;

            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .wrapper {
            display: flex;
            gap: 20px;
            max-width: 800px;
            width: 100%;
        }

        .container, .history-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 350px;
            text-align: center;
        }

        .history-container {
            width: 400px;
            overflow-y: auto;
            max-height: 400px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus {
            border-color: #28a745;
            outline: none;
        }

        .error {
            color: red;
            font-size: 12px;
            display: none;
            margin-top: 5px;
            text-align: left;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:disabled {
            background: gray;
            cursor: not-allowed;
        }

        .result {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .history-card {
            background: #fafafa;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .history-card small {
            display: block;
            color: gray;
            font-size: 12px;
        }
        /* Tambahkan styling untuk tombol delete */
.delete-btn {
    background: red;
    color: white;
    border: none;
    border-radius: 2px;
    padding: 4px 4px;
    font-size: 12px;
    cursor: pointer;
    margin-top: 5px;
}

.delete-btn:hover {
    background: darkred;
}


    </style>

</head>
<body>

    <div class="wrapper">
        <!-- Form Section -->
        <div class="container">
            <h2>Kalkulator Diskon</h2>
            <form id="discountForm">
                <label for="price">Harga (Rp):</label>
                <input type="text" id="price" required>
                <div class="error" id="priceError"></div>

                <label for="discount">Diskon (%):</label>
                <input type="text" id="discount" min="0" max="100" required>
                <div class="error" id="discountError"></div>

                <button type="submit" id="submitButton" disabled>Hitung</button>
            </form>

            <div class="result">Total Harga: <span id="totalPrice">Rp 0</span></div>
        </div>

        <!-- History Section -->
        <div class="history-container">
            <h3>Riwayat Perhitungan</h3>
            <ul id="history-list"></ul>
        </div>
    </div>

    <script>
        const priceInput = document.getElementById("price");
        const discountInput = document.getElementById("discount");
        const submitButton = document.getElementById("submitButton");
        const totalPriceDisplay = document.getElementById("totalPrice");
        const historyList = document.getElementById("history-list");
        const priceError = document.getElementById("priceError");
        const discountError = document.getElementById("discountError");

        function formatRupiah(number) {
            return "Rp " + number.toLocaleString("id-ID");
        }

        function unformatRupiah(value) {
            return parseInt(value.replace(/\./g, ""), 10);
        }

        function validateInputs() {
    let priceValue = priceInput.value.trim();
    let discountValue = discountInput.value.trim().replace(',', '.'); // Ubah koma menjadi titik
    let isValid = true;

    if (!/^\d{1,3}(\.\d{3})*$/.test(priceValue)) {
        priceError.textContent = "Format harga tidak valid!";
        priceError.style.display = "block";
        isValid = false;
    } else {
        priceError.style.display = "none";
    }

    let price = unformatRupiah(priceValue);
    if (isNaN(price) || price <= 0) {
        priceError.textContent = "Harga harus lebih dari 0!";
        priceError.style.display = "block";
        isValid = false;
    }

    let discount = parseFloat(discountValue);
    if (isNaN(discount) || discount < 0 || discount > 100) {
        discountError.textContent = "Diskon harus antara 0% - 100%!";
        discountError.style.display = "block";
        isValid = false;
    } else {
        discountError.style.display = "none";
    }

    submitButton.disabled = !isValid;
}


        priceInput.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, ""); 
            if (value !== "") {
                this.value = parseInt(value, 10).toLocaleString("id-ID");
            }
            validateInputs();
        });

        discountInput.addEventListener("input", validateInputs);

    document.getElementById("discountForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    let price = unformatRupiah(priceInput.value);
    let discount = parseFloat(discountInput.value.replace(',', '.')); // Ubah koma menjadi titik
    let total = price - (price * (discount / 100));

    total = Math.round(total); // Pembulatan ke angka terdekat

    totalPriceDisplay.textContent = formatRupiah(total);

    try {
        const response = await fetch('/home/addcalc', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                calculation_input: `Price: Rp ${price.toLocaleString("id-ID")}, Discount: ${discount}%`,
                calculation_result: `Rp ${total}`
            })
        });
        const data = await response.json();
        if (data.success) {
            updateHistory();
        }
    } catch (error) {
        console.error("Error adding history:", error);
    }
});


        // Fungsi untuk mengupdate history dengan tombol delete
const updateHistory = async () => {
    try {
        const response = await fetch('/home/getLatestHistory');
        const historyData = await response.json();

        if (historyData.error) {
            console.error(historyData.error);
            return;
        }

        historyList.innerHTML = ''; 
        historyData.forEach((post) => {
            const listItem = document.createElement('li');
            listItem.classList.add('history-card');
            listItem.innerHTML = `
                <strong>${post.input}</strong><br>
                <span style="color: green;">${post.result}</span><br>
                <small class="history-date">${post.created_at}</small><br>
                <button class="delete-btn" data-id="${post.id}">Hapus</button>
            `;
            historyList.appendChild(listItem);
        });

        // Tambahkan event listener ke setiap tombol "Hapus"
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const id = this.getAttribute('data-id');
                await deleteHistory(id);
            });
        });

    } catch (error) {
        console.error("Error fetching history:", error);
    }
};

// Fungsi untuk menghapus riwayat perhitungan
const deleteHistory = async (id) => {
    try {
        const response = await fetch(`/home/deleteHistory/${id}`, {
            method: 'POST', // Ganti dari DELETE ke POST
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ _method: 'DELETE' }) // Kirim _method=DELETE
        });

        const data = await response.json();
        if (data.success) {
            updateHistory(); // Refresh daftar history setelah dihapus
        }
    } catch (error) {
        console.error("Error deleting history:", error);
    }
    document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', async function () {
        const id = this.getAttribute('data-id');
        console.log("Tombol diklik! ID:", id); // Debugging
        await deleteHistory(id);
    });
});

};

document.addEventListener("DOMContentLoaded", updateHistory);
setInterval(updateHistory, 5000);

    </script>

</body>
</html>
