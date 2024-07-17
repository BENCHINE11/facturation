<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Home</h1>
    <h2>BONJOUR {{ $nom }} </h2>

    <p>Voici une liste des roles :</p>
    <table border="2">
        <tr>
            <th>Role</th>
        </tr>
        @foreach ($roles as $role)
        <tr>
            <td>{{ $role }}</td>
        </tr>
        @endforeach 
       
    </table>

</body>
</html>