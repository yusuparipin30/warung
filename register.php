<?php

include 'config.php';


//Untuk memeriksa apakah sebuah objek form telah didefenisikan atau telah di-set sebelumnya, 
//kita bisa menggunakan fungsi bawaan PHP: isset(). Fungsi isset() akan menghasilkan nilai true jika sebuah
// variabel telah didefenisikan, dan false jika variabel tersebut belum dibuat.
if(isset($_POST['submit'])){

//$_POST berfungsi untuk memanggil data yang telah diinputkan agar bisa ditampilkan di file action.
   $name = $_POST['name'];
   $name = filter_var($name,FILTER_SANITIZE_STRING);

   //FILTER_SANITIZE_STRING filter untuk menghilangkan karakter yang tidak diinginkan atau dikodekan.
   //filter menghapus aplikasi yang berpotensi data yang berbahaya.
   //Hal ini digunakan untuk menghapus label dan menghapus karakter yang tidak diinginkan atau dikodekan.
   $email = $_POST['email'];
   $email = filter_var($email,FILTER_SANITIZE_STRING);

   $pass = $_POST['pass'];
   $pass = filter_var($pass,FILTER_SANITIZE_STRING);

   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass,FILTER_SANITIZE_STRING);

   $image = $_FILES ['image']['name'];
   $image_size = $_FILES ['image']['size'];
   $image_tmp_name = $_FILES ['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;


   //Prepared statements adalah sebuah fitur yang disediakan MySQL (dan juga beberapa aplikasi database lainnya), dimana kita bisa mengirim query (perintah) secara terpisah antara query inti dengan “data” dari query. Tujuannya, 
   //agar query menjadi lebih aman dan cepat (jika perintah yang sama akan digunakan beberapa kali).
   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   
   // execute untuk menjalankan query
   $select->execute([$email]);
   
   //RowCount m3nampilkann hasil query
   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }
   }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!--custom css link componet  -->
   <link rel="stylesheet" href="Css/components.css">

</head>
<body>

   <section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="text" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="register now" class="btn" name="submit" >
      <p>already have an acount? <a href="login.php">login now</a></p>
   </form>

   </section>
   
</body>
</html>
