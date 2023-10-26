<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @if ($errors->any() )
        @foreach ($errors->all() as $error)
            <div class="error">
                {{ $error}}
            </div>
        @endforeach
    @endif
    
</body>
</html>