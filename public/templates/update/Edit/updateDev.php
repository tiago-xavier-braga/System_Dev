<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/base/header.css">
    <link rel="stylesheet" href="../../../css/templates/form.css">
    <script src="https://kit.fontawesome.com/8ceb46e887.js" crossorigin="anonymous"></script>
    <title>Developer Update</title>
</head>
<body>
    <?php
        require_once '../../base/header.php';
    ?>
    <main>
        <?php
            require_once '../../../../class/rb-mysql.php';
    
            $conn = R::setup( 'mysql:host=localhost;dbname=SYSTEM_DEV', 'root', '' );

            if ($conn) {
                # code...
                echo '<script>console.log("Success connection database")</script>';
            } else {
                echo '<script>console.log("Failed connection database"</script>';
            }

            if (isset($_GET['id'])) {
                $id = (int) $_GET['id'];
                list($developerDB, $credentialDB) = R::loadMulti('developer,credential', $id);
            }
        $renderHTML = <<<RENDER
        <form action="../store/storeDev.php" method="get">
            <input type="number" name="id" value="$id" class="idInput">
            <div class="container">
                <div class="boxTitle divDefault">
                    <h1>Register <e class="boldWord">Dev Form</e></h1>
                </div>

                <div class="boxInput divDefault">
                    <div class="inputConfig divDefault">
                        <p>Developer</p>
                        <div class="inputLine" id="inputLineUser">
                            <input type="text" name="name" id="name" placeholder="name" value="$developerDB->name">
                            <p><i class="fa-solid fa-user"></i></p>
                        </div>
                    </div>
                    <div class="inputConfig divDefault">
                        <p>Date of Birth</p>
                        <div class="inputLine">
                            <input type="date" name="birth" placeholder="Date of Birth" value="$developerDB->birth">
                            <p><i class="fa-solid fa-calendar-days"></i></p>
                        </div>
                    </div>
                    <div class="inputConfig divDefault">
                        <p>Level</p>
                        <div class="inputLine">
                            <input type="text" name="level" id="level" placeholder="Level" value="$developerDB->level">
                            <p><i class="fa-solid fa-filter"></i></p>
                        </div>
                    </div>
                    <div class="inputConfig divDefault">
                        <p>Email</p>
                        <div class="inputLine">
                            <input type="email" name="email" id="email" placeholder="Email" maxlength="250" value="$credentialDB->email">
                            <p><i class="fa-solid fa-envelope"></i></p>
                        </div>
                    </div>
                    <div class="inputConfig divDefault">
                        <p>Password</p>
                        <div class="inputLine" id="inputLinePassword">
                        <input type="text" name="password" id="password" placeholder="Password" maxlength="64" value="$credentialDB->password">
                            <p onclick="viewPassword()"><i id="eye"class="fa-solid fa-eye-slash"></i></p>
                            <!--<i class="fa-solid fa-eye"></i>-->
                        </div>
                    </div>
                    <div class="checkboxContainer">
                    <div>
                        <label for="active">Active:</label>
                        <input type="checkbox" name="active">
                    </div>
                    <div>
                        <label for="admin">Manager:</label>
                        <input type="checkbox" name="admin">
                    </div>
                </div>
                </div>
                <div class="boxButton divDefault">
                    <input type="submit" value="Login" class="login"">
                </div>
            </div>
        </form>

RENDER;
    echo $renderHTML;
    ?>
    </main>
</body>

</html>