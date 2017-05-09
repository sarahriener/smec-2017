<!DOCTYPE html>
<html>
<head>
    <title>Continents</title>
</head>
<body>
    @foreach ($continents as $continent)
        <p>This is continent {{ $continent->name }}</p>
    @endforeach
</body>
</html>