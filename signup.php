<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    form{
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        width: 300px;
    }
    input, select{
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button{
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    button:hover{
        background-color: #218838;
    }
</style>
<body>
    <form action="tableconn.php" method="post">
        <label for="names">Amazina</label><br>
        <input type="text" name="name"><br>

        <label for="username">Amazina wifuza Gukoresha</label><br>
        <input type="text" name="username"><br>

        <label for="type">Icyo Ukora</label><br>
        <select name="type" id="type">
            <option value="Cashier">Umubitsi</option>
            <option value="Manager">Umuyobozi</option>
        </select><br>
        <label for="password">Ijambo Ry'ibanga</label><br>
        <input type="password" name="password"><br>

        <button type="submit">Emeza</button>
    </form>
</body>
</html>