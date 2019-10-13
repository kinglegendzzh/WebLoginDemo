<?php
//注册处理程序
    //声明变量

    $username = isset($_POST['username'])?$_POST['username']:NULL;
    $password = isset($_POST['password'])?$_POST['password']:NULL;
    $re_password = isset($_POST['re_password'])?$_POST['re_password']:NULL;
    $sex = isset($_POST['sex'])?$_POST['sex']:NULL;
    $qq = isset($_POST['qq'])?$_POST['qq']:NULL;
    $email = isset($_POST['email'])?$_POST['email']:NULL;
    $phone = isset($_POST['phone'])?$_POST['phone']:NULL;
    $address = isset($_POST['address'])?$_POST['address']:NULL;
	
    if($password == $re_password) {
        //建立连接
        $conn = mysqli_connect('127.0.0.1','root','wxhzzh','login');

        //准备SQL语句,查询用户名
        $sql_select="SELECT username FROM user WHERE username = '$username'";
        //执行SQL语句
        $ret = mysqli_query($conn,$sql_select);
        if (!$ret) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }
        $row = mysqli_fetch_array($ret);
        //判断用户名是否已存在
        if($username == $row['username']) {
            //用户名已存在，显示提示信息
            header("Location:register.php?err=1");
        } else {

            //用户名不存在，插入数据
            //准备SQL语句
            $sql_insert = "INSERT INTO user(username,password,sex,qq,email,phone,address) VALUES('$username','$password','$sex','$qq','$email','$phone','$address')";
            //执行SQL语句
            mysqli_query($conn,$sql_insert);
			/* if(!mysqli_query($conn,$sql_insert)){
				echo mysqli_errno($conn);
				echo mysqli_error($conn);
				echo "!!!!!!!!!!!!!!! \n";
				if(!$conn){
					echo "数据库连接失败".mysqli_connect_errno();
				}else{
					echo "数据库连接成功";
					echo "(测试数据是否键入成功)数据内容:"."$username"."$password"."$re_password"."$sex"."$qq"."$email"."$phone"."$address";
				}
			}else{
				echo "成功了";
				echo "(测试数据是否键入成功)数据内容:"."$username"."$password"."$re_password"."$sex"."$qq"."$email"."$phone"."$address";
				echo "<br/> 准备测试数据库内容是否插入正确,内容:";
				//执行查询
				$get=mysqli_query($conn,"SELECT username,password,sex,qq,email,phone,address FROM user WHERE username = '$username'");
				$arr=mysqli_fetch_array($get);
				echo "<br/> ".$arr["username"].$arr['password'].$arr['sex'].$arr['email'].$arr['qq'].$arr['phone'].$arr['address'];
			} */
            header("Location:register.php?err=3");
        }

        //关闭数据库
        mysqli_close($conn);
    } else {
        header("Location:register.php?err=2");
    }

?>