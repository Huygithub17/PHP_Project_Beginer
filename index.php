<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bai 3: quan ly users</title>
	<style>
		table, th, td{
			border: 1px solid black;
		}
		#user-info{
			border: 1px solid #ccc;
			width: 900px;
			margin: 0 auto;
			padding: 25px;
		}
		#user-info table{
			margin: 10px auto 0 auto; 
			text-align: center;
		}
		#user-info h1{
			text-align: center;
		}

	</style>
</head>

<body>
    <?php 
		include './source/connectdb.php';
		$result = mysqli_query($con, "select * from user");
		mysqli_close($con);
	?>
    <div id="user-info">
        <h1> Danh sách tài khoản</h1>
        <a href="./create_user.php"> Tạo tài khoản</a>
        <table id="user-listing" style="width: 900px;">
            <tr>
                <td>Username</td>
                <td>Trạng thái</td>
                <td>Full name</td>
                <td>Email</td>
                <td>Ngày sinh</td>
                <td>Cập nhật lần cuối</td>
                <td>Sửa</td>
                <td>Xoá</td>
            </tr>
            <?php
			while($row = mysqli_fetch_array($result)){
			?>
            <tr>
                <td><?= $row['username']?></td>
                <td><?= $row['status']==1 ? "kích hoạt": "Block"?></td>
                <td><?= $row['fullname']?></td>
                <td><?= $row['email']?></td>
                <td><?= $row['birthday']?></td>
                <td><?= date('d/m/Y H:i',$row['created_time'])?></td>
                <td><a href="./edit_user.php?id=<?= $row['id']?>"> Sửa</a></td>
                <td><a href="./delete_user.php?id=<?= $row['id']?>"> Xoá</a></td>
            </tr>

            <?php } ?>

        </table>

    </div>
</body>

</html>