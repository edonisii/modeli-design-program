<!DOCTYPE html>
<html>
<head>
<title>Form</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea,
        input[type="file"],
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <form action="process_form.php" method="post" enctype="multipart/form-data">
            <label>Emri i Instagramit:</label>
            <input type="text" name="instagram_username">

            <label>Emri dhe Mbiemri i personit:</label>
            <input type="text" name="full_name">

            <label>Shteti:</label>
            <select name="country">
                <option value="Zgjedh Shtetin">Zgjedh Shtetin</option>
                <option value="Vje Ne Lokal">Vje Ne Lokal</option>
                <option value="Belgjik">Kosov</option>
                <option value="Belgjik">Maqedoni</option>
                <option value="Belgjik">Shqiperi</option>
                <option value="Belgjik">Franc</option>
                <option value="Belgjik">Zvicerr</option>
                <option value="Belgjik">Austri</option>
                <option value="Belgjik">Holand</option>
                <option value="Gjermani">Gjermani</option>
                <option value="Belgjik">Belgjik</option>
                <option value="Amerik">Amerik</option>
                <option value="Angli">Angli</option>
                <option value="Serbi">Serbi</option>
                <option value="Kanad">Kanad</option>
                <option value="Kroaci">Kroaci</option>
                <option value="Itali">Itali</option>
                <option value="Suedi">Suedi</option>
                <option value="Spanj">Spanj</option>
                
                
            </select>

            <label>Qyteti/Adresa:</label>
            <input type="text" name="address">

            <label>Numri i Telefonit:</label>
            <input type="text" name="phone_number">

            <label>Data e Dorzimit:</label>
            <input type="date" name="delivery_date">

            <label>Data e Porosis:</label>
            <input type="date" name="order_date">

            <label>Modeli i Fustanit:</label>
            <input type="text" name="dress_model">

            <label>Kodi Postar:</label>
            <input type="text" name="postal_code">

            <label>Komenti:</label>
            <textarea name="comment"></textarea>

            <label>Foto e Fustanit:</label>
            <input type="file" name="dress_image">

            <input type="submit" value="SHTO POROSIN">
            <input type="reset" value="FILLO PREJ FILLIMIT">
        </form>
    </div>
</body>
</html>
