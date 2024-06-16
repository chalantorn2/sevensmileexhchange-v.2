<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Exchange</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Urbanist', sans-serif;
            background: linear-gradient(to bottom, white, #89cdf1);
            min-height: 100vh; /* ทำให้ background เต็มจอ */
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            max-width: 1000px;
            width: 100%;
            margin-top: 40px; /* ลดระยะห่างด้านบน */
        }
        img.flag {
            width: 250px;
            height: auto;
        }
        .table-container {
            max-height: 80vh;
            overflow-y: auto;
        }
        .table-auto {
            table-layout: fixed;
            width: 100%;
        }
        .w-40p {
            width: 40%;
        }
        .w-60p {
            width: 60%;
        }
        .font-32-bold {
            font-size: 32px;
            font-weight: 700;
        }
        .header-bg {
            background-color: #1d1b23;
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .row-bg-1 {
            background-color: #3f3c51;
            color: white;
        }
        .row-bg-2 {
            background-color: #302c3a;
            color: white;
        }
        /* ซ่อน Scrollbar */
        .table-container::-webkit-scrollbar {
            display: none;
        }
        .table-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .button-container {
            margin-top: 10px; /* เพิ่มการจัดการระยะห่างด้านบนของปุ่ม */
        }
        .denomination-color {
            color: #ffba00;
        }
        .buying-color {
            color: #10db00;
        }
        .search-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .search-input {
            width: 1000px;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
    <script>
        function searchCountry() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("currencyTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
</head>
<body>

<div class="container mx-auto">
    <div class="text-center mb-5">
        <img src="uploads/exchangeLogo.png" alt="Logo" class="mx-auto h-auto w-48">
    </div>

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchCountry()" placeholder="Search for country names..." class="search-input">
    </div>

    <div class="table-container">
        <table id="currencyTable" class="table-auto w-full bg-white shadow-md rounded mb-5 text-center">
            <thead>
                <tr class="header-bg">
                    <th class="px-4 py-2 w-40p">Currency Flag</th>
                    <th class="px-4 py-2 w-40p">Country Name</th>
                    <th class="px-4 py-2 w-60p font-32-bold">Denomination</th>
                    <th class="px-4 py-2 w-60p font-32-bold">Buying</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "exchange_db");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM currencies") or die($conn->error);
            $rowCount = 0;
            while ($row = $result->fetch_assoc()): 
                $rowClass = ($rowCount % 2 == 0) ? 'row-bg-1' : 'row-bg-2';
                $rowCount++;
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td class="border px-4 py-2">
                        <img src="uploads/<?php echo $row['currency_image']; ?>" alt="Flag" class="flag mx-auto">
                    </td>
                    <td class="border px-4 py-2 font-32-bold"><?php echo $row['country_name']; ?></td>
                    <td class="border px-4 py-2 font-32-bold denomination-color"><?php echo $row['denomination']; ?></td>
                    <td class="border px-4 py-2 font-32-bold buying-color"><?php echo $row['buying']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center button-container">
        <a href="add.php" class="bg-green-500 text-white px-4 py-2 rounded mr-2">Add Currency</a>
        <a href="manage.php" class="bg-blue-500 text-white px-4 py-2 rounded">Edit Currency</a>
    </div>
</div>

</body>
</html>
