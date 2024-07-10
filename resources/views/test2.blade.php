<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heatmap with Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Heatmap with Collection</h1>
    <div class="grid grid-flow-row grid-cols-7 gap-1">
    @foreach ($result as $tile)
            <div class='w-16 h-16 {{$tile->description}} text-black rounded flex items-center justify-center border border-gray-300'></div>
    @endforeach
    </div>
</div>
</body>
</html>
