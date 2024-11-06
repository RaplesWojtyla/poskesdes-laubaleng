<!DOCTYPE html>
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(90deg, rgba(26, 136, 137, 1) 0%, rgba(26, 136, 137, 1) 35%, rgba(167, 211, 212, 1) 100%);
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            min-height: 100vh;
        }

        .container {
            background-color: #ffff;
            border-radius: 15px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            /* Adjust the max-width as needed */
            box-shadow: 0 0 10px rgba(4, 6, 4, 0.5);
            text-align: center;
        }

        h1 {
            color: #333;
            font-weight: bold;
        }

        p {
            color: #666;
        }

        .button {
            display: inline-block;
            background-color: #F7A623;
            color: #fff;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 15px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #fff;
            color: #F7A623;
            border: 2px solid #F7A623;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 16px;
                margin-top: 10px;
            }

            .button {
                font-size: 16px;
                padding: 8px 16px;
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ada Pembelian Baru Ni!!!!</h1>
        <p>
            Ada Pembelian Baru Ni Dari Pelanggan, Silahkan Cek Dan Konfirmasi Pembelian Yang Sedang Berlangsung Ya!!!!</p>

        <p>Semangat!!!</p>

        <p>-Apotek Jati Negara-</p>
        <a href="http://apotek-msbd.test/cashier/pesanan-online" class="button">Konfirmasi Pesanan</a>
    </div>
</body>

</html>