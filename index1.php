
<!-- // Please dont touch or change the codes.//
// create by sudoweb ; telegram id : sudoweb_5026 //-->
    <!DOCTYPE html>
    <html lang="fa">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> پنل اختصاصی sudoweb </title>
        <style>
            body {
                background: #111;
                color: white;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            form {
                background: #222;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 15px #4CAF50;
                width: 320px;
                text-align: center;
            }
            input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border-radius: 5px;
                border: none;
                font-size: 1rem;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                border: none;
                border-radius: 5px;
                color: white;
                cursor: pointer;
                font-size: 1rem;
            }
            button:hover {
                background-color: #45a049;
            }
            .error {
                color: #ff5555;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <form method="post" action="">
            <h2> پنل قوی </h2>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <input type="text" name="username" placeholder="نام کاربری" required autofocus />
            <input type="password" name="password" placeholder="رمز عبور" required />
            <button type="submit" name="login">ورود</button>
        </form>
    </body>
    </html>
    <?php
    exit; 
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> پنل اختصاصی سافت اتر sudoweb </title>
    <style>

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: rgb(15, 15, 15);
            background: linear-gradient(135deg, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.8), rgba(85, 0, 255, 0.8));
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 100%;
            height: 100vh;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.7);
            margin: 0 auto;
            color: white;
            overflow-y: auto;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: none;
            width: 50%;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #555;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        td form input[type="text"] {
            padding: 5px;
            width: 200px;
            font-size: 1rem;
        }
        td form input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        td form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

            

    <div class="container">
        <h1>لیست کاربران</h1>

        <form method="GET" action="">
            <input type="text" name="search" placeholder="جستجو بر اساس نام کاربری..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
            <button type="submit">جستجو</button>
        </form>

        <a href="create_user.php">
            <button>ایجاد کاربر جدید</button>
        </a>
        <a href="expired_users.php" style="margin-right: 10px;">
            <button style="background-color: #ff4c4c;"> کاربران منقضی شده </button>
        </a>

        <?php
                 // create by sudoweb  telegram id : sudoweb_5026 //
        $sessionCommand = '/opt/softether/vpncmd localhost /SERVER /HUB:VPN /CMD sessionlist';
        $sessionOutput = shell_exec($sessionCommand);
        $onlineCount = substr_count($sessionOutput, 'User Name');
        echo "<p style='color: #00ff99; font-weight: bold; text-align: center;'>تعداد کاربران آنلاین: $onlineCount نفر</p>";
        ?>

        <table>
            <tr>
                <th>نام کاربری</th>
                <th>تاریخ انقضا</th>
                <th>ویرایش</th>
            </tr>

            <?php
            $command = '/opt/softether/vpncmd localhost /SERVER /HUB:VPN /CMD userlist';
            $output = shell_exec($command);
                                     // create by sudoweb  telegram id : sudoweb_5026 //
            $lines = explode("\n", $output);
            $users = [];
            $username = '';
            $expiration_date = '';

            foreach ($lines as $line) {
                if (strpos($line, 'User Name') !== false) {
                    preg_match('/User Name\s+\|(\S+)/', $line, $matches);
                    $username = trim($matches[1]);
                }
                if (strpos($line, 'Expiration Date') !== false) {
                    preg_match('/Expiration Date\s+\|(.+)/', $line, $matches);
                    $expiration_date = trim($matches[1]);

                    if ($username && $expiration_date) {
                        $users[] = [
                            'username' => $username,
                            'expiration_date' => $expiration_date
                        ];
                    }
                }
            }

            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $searchTerm = strtolower(trim($_GET['search']));
                $users = array_filter($users, function($user) use ($searchTerm) {
                    return strpos(strtolower($user['username']), $searchTerm) !== false;
                });
            }
                 // create by sudoweb  telegram id : sudoweb_5026 //

            foreach ($users as $user) {
                echo "<tr>
                        <td>{$user['username']}</td>
                        <td>{$user['expiration_date']}</td>
                        <td>
                            <form action='update_expiration.php' method='post'>
                                <input type='hidden' name='username' value='{$user['username']}'>
                                <input type='text' name='expiration_date' value='{$user['expiration_date']}'>
                                <input type='submit' value='بروزرسانی'>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
