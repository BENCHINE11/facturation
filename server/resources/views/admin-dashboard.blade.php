<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            padding: 1rem;
            background-color: #1e90ff;
        }
        .header form {
            margin: 0;
        }
        .header button {
            background-color: #ff4c4c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            margin-right: 10px;
        }
        .header button:hover {
            background-color: #e04343;
        }
        .dashboard-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            text-align: center;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 60px;
        }
        .dashboard-container h2 {
            width: 100%;
            margin-bottom: 1.5rem;
            color: #1e90ff;
        }
        .dashboard-container form {
            width: 23%;
            margin: 0.5rem;
        }
        .dashboard-container button {
            width: 100%;
            padding: 3rem;
            border: none;
            border-radius: 10px;
            background-color: #1e90ff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .dashboard-container button:hover {
            background-color: #1c86ee;
        }
        @media (max-width: 768px) {
            .dashboard-container form {
                width: 45%;
            }
            .dashboard-container button {
                padding: 2rem;
            }
        }
        @media (max-width: 480px) {
            .dashboard-container form {
                width: 90%;
            }
            .dashboard-container button {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    </div>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <form method="GET" action="{{ url('/users') }}">
            @csrf
            <button type="submit">Gestion des utilisateurs</button>
        </form>
        <form method="GET" action="{{ url('/ports') }}">
            @csrf
            <button type="submit">Gestion des ports</button>
        </form>
        <form method="GET" action="{{ url('/regions') }}">
            @csrf
            <button type="submit">Gestion des régions</button>
        </form>
        <form method="GET" action="{{ url('/clients') }}">
            @csrf
            <button type="submit">Consulter les clients</button>
        </form>
        <form method="GET" action="{{ url('/factures') }}">
            @csrf
            <button type="submit">Consulter les factures</button>
        </form>
    </div>
</body>
</html>
