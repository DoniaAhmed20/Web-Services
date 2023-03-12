<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>part 1</title>
    <style>
        body{
            background: linear-gradient(to left,
            #d7dfe5,#afccdf,#607eb5f5);
            justify-content: center;
        }
        section{
            display: block;
            text-align: center;
        }
        section h1{
            font-size: 70px;
            font-weight: bold;
            color: #607eb5f5;
        }
        select{
            height: 50px;
            width: 500px;
            padding-left: 5px;
        }
        #submit{
            color: #607eb5f5;
            font-size: 20px;
            width: 200px;
            text-align: center;
            height: 40px;
            background: linear-gradient(to left,
            #d7dfe5,#afccdf,#607eb5f5);
            border: 1px solid  #607eb5f5;
            cursor: pointer;

        }
        form{
            box-shadow: rgba(149, 157, 165, 1.5) 0px 8px 24px;
            background: #d7dfe5;
            width: 700px;
            height: 400px;
            margin-left: 350px;
        }

    </style>
</head>

<body >
    
    <section>
        <form method="post" action="index.php">
            <h1>Weather Forcase</h1>
            <select  name="city">
                <option selected>Select Your City...</option>
                <?php
                foreach ($egyptCities as $key => $value) {
                    echo '<option value=' . $value['id'] . '>' . $value['country'] . '>>' . $value['name'] . '</option>';
                }
                ?>
            </select>
            <br><br><br><br><br><input id="submit" name="submit" type="submit" value="Get Weather" style="background-color:#30534c"/>
        </form>

    </section>
</body>

</html>