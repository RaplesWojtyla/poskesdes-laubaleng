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
            align-items: center;
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
    <div class="container" style="background-color: #ffff; border-radius: 15px; padding: 20px; width: 90%; max-width: 400px; box-shadow: 0 0 10px rgba(4, 6, 4, 0.5); text-align: center;">

        <h1 style="color: #333; font-weight: bold; text-align:center">Verifikasi Alamat Email Anda</h1>
        <p style="color: #666;">Untuk mengonfirmasi alamat email Anda, silahkan klik tombol di bawah ini.</p>
        <a href="{{ $actionUrl }}" class="button" style="display: inline-block; background-color: #F7A623; color: #fff; padding: 10px 20px; font-weight: 600; border-radius: 15px; text-decoration: none; font-size: 18px; margin-top: 20px;">Verifikasi</a>

    </div>
</body>

</html>