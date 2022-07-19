<!DOCTYPE html>
<!--
Nguyễn Duy Huy _ 18/7/2022 _ok
-->
<html>
    <head>
        <title>Bài 4: Tạo form đăng ký, đăng nhập hệ thống</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #user_register form{
                width: 200px;
                margin: 40px auto;
            }
            #user_register form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        include './connectdb.php'; 
        include './function.php'; 
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'reg') {
            if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                $fullname = $_POST['fullname'];
                $birthday = $_POST['birthday']; // Đang là chuỗi 12-01-2000
                //echo $birthday; exit;
                $check = validateDateTime($birthday);
                if ($check) {
                    $birthday = strtotime($birthday); // giá trị sau khi chuyển: 947635200
                    //echo $birthday; exit;  
                    //$result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`username`, `password`, `birthday`, `status`, `created_time`) VALUES ('" . $_POST['fullname'] . "', '" . $_POST['username'] . "', MD5('" . $_POST['password'] . "'), '" . $birthday . "', 1, '" . time() . "');");
                    //$result = mysqli_query($con, "INSERT INTO `user`(`id`, `username`, `password`, `fullname`, `birthday`, `status`, `created_time`) VALUES (NULL,'" . $_POST['username'] . "',MD5('" . $_POST['password'] . "'),'" .$fullname. "','" . time() . "',1 ,'" . time() . "');");
                    $result = mysqli_query($con, "INSERT INTO `user`(`id`, `username`, `password`, `fullname`, `birthday`, `status`, `created_time`) VALUES (NULL,'" . $_POST['username'] . "',MD5('" . $_POST['password'] . "'),'" .$fullname. "',". $birthday .",1 ,'" . time() . "');");
                    if (!$result) {
                        if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
                            $error = "Tài khoản đã tồn tại. Bạn vui lòng chọn tài khoản khác."; // nếu trùng username;
                        }
                    }
                    mysqli_close($con);
                } else {
                    $error = "Ngày tháng nhập chưa chính xác";
                }
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./register.php">Quay lại</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Đăng ký tài khoản thành công" ?></h1>
                        <a href="./login.php">Mời bạn đăng nhập</a> <br>
                        <a href="../index.php">Danh sách tài khoản</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để đăng ký tài khoản</h1>
                    <a href="./register.php">Quay lại đăng ký</a>
                </div>
                <?php
            }
        } else {
            ?>
            <div id="user_register" class="box-content">
                <h1>Đăng ký tài khoản</h1>
                <form action="./register.php?action=reg" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value=""><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <label>Họ tên</label></br>
                    <input type="text" name="fullname" value="" /><br/>
                    <label>Ngày sinh (DD-MM-YYYY)</label></br>
                    <input type="text" name="birthday" value="" /><br/>
                    </br>
                    </br>
                    <input type="submit" value="Đăng ký"/>
                </form>
            </div>
            <?php
        }
        ?>
    </body>
</html>
