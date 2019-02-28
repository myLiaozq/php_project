<?php
   //上传文件限制
    $file=$_FILES['file'];
    $max_size='500000';      // 最大文件限制（单位：byte）
    $arrType=array('image/jpg','image/gif','image/png','image/bmp','image/jpeg');

    if(!$_SERVER['REQUEST_METHOD']=='POST'){ //判断提交方式是否为POST
      exit;
    }
    if(!is_uploaded_file($file['tmp_name'])){ //判断上传文件是否存在
       echo "<font color='#FF0000'>文件不存在！</font>";
       exit;
    }
    
    if(!in_array($file['type'],$arrType)){  //判断图片文件的格式
       echo "<font color='#FF0000'>上传文件格式不对！</font>";
       exit;
    }
    if($file['size']>$max_size){  //判断文件大小是否大于500000字节
      echo "<font color='#FF0000'>上传文件太大！</font>";
      exit;
    } 
    //文件上传是否出错
    if ($file["error"] > 0){
      echo "上传出错: " . $file["error"] . "<br />";
    }else{
      //输出文件信息
      /*echo "文件名: " . $_FILES["file"]["name"] . "<br />";
      echo "类型: " . $_FILES["file"]["type"] . "<br />";
      echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
      echo "临时路径: " . $_FILES["file"]["tmp_name"] . "<br />";*/
      //判断文件是否已存在
      // echo file_exists("images/" . $file["name"]);exit;
      if (file_exists("images/" . $_FILES["file"]["name"])){
            echo "<script language='javascript'>alert('".$_FILES["file"]["name"]."已经存在！')</script>";
      }else{
        //存储路径
        $filename = "images/" . $_FILES["file"]["name"];
        //移动图片至保存路径，解决中文乱码问题
          move_uploaded_file($_FILES["file"]["tmp_name"],iconv("UTF-8","gb2312",$filename));
          echo "该文件存储在了: " . "D:/xampp/htdocs/php_project/FileUpload/demo2/images/" . $_FILES["file"]["name"];
          echo "<script language='javascript'>parent.showimg('".$filename."')</script>";


          include('connect.php');//链接数据库

          $icon_arr = array("$filename");
          // $icon = implode($icon_arr);
          $icon = "images/" . $_FILES["file"]["name"];
          // die("D:/xampp/htdocs/php_project/FileUpload/demo2/images/" . $_FILES["file"]["name"]);
          $conn->query("set names 'utf8'");
          $sql = "INSERT INTO photo(src) values('$icon')";//需要执行的sql语句
          $result2 = $conn->query($sql);
          if($result2 && $result2->rowCount()){
            echo '插入成功';
              // $suc_json = array('code'=>1,'message'=>'注册成功');
              // echo json_encode($suc_json);
              exit;
          }
      }
    } 
?>