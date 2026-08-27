<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow&display=swap" rel="stylesheet">

    @livewireStyles

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%; /* ✅ IMPORTANT */
            font-family: 'Barlow', sans-serif;
            color: white;
            overflow-x: hidden; /* ✅ IMPORTANT */
        }

        /* BACKGROUND */
        .bg {
            position: fixed;
            inset: 0;
            background: url("/images/gym-bg.jpg") no-repeat center center;
            background-size: cover;
            z-index: -2;
        }

        /* OVERLAY */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            z-index: -1;
        }

        /* ✅ MAIN CONTENT FIX */
        .content {
            width: 100%;   /* ✅ THIS FIXES YOUR ISSUE */
            min-height: 100vh;
        }
    </style>

</head>
<body>

    <div class="bg"></div>
    <div class="overlay"></div>

    <!-- ✅ FIXED -->
    <div class="content w-full">
        {{ $slot }}
    </div>

    @livewireScripts

</body>
</html>