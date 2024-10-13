<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md">
            <h2 class="text-2xl font-bold text-center text-green-600 mb-4">Email Verification</h2>

            @if(session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">Invalid or expired verification link.</span>
                </div>
            @endif

            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Go to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
