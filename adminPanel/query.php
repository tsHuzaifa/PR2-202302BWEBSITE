<?php
include('dbcon.php');
session_start();
if(isset($_POST['login'])){
    $userEmail = $_POST['uEmail'];
    $userPassword = $_POST['uPassword'];
    $query = $pdo->prepare('select * from users where email = :uEmail AND password = :uPassword ');
    $query->bindParam('uEmail',$userEmail);
    $query->bindParam('uPassword',$userPassword);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($user);
    if($user['role_id'] == 1){
            $_SESSION['adminEmail'] = $user['email'];
            $_SESSION['adminName'] = $user['name'];
            $_SESSION['adminId'] = $user['id'];
            echo "<script>alert('Admin login successfully');
            location.assign('index.php')</script>";
    }
    else if($user['role_id'] == 2){
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userName'] = $user['name'];
        echo "<script>alert(' User login successfully');
        location.assign('website.php')</script>";
}
}

// add category Work
        if(isset($_POST['addCategory'])){
            $cName = $_POST['categoryName'];
            $cDes = $_POST['categoryDes'];
             $imageName = $_FILES['categoryImage']['name'];
             $imageTmpName = $_FILES['categoryImage']['tmp_name'];
             $extension = pathinfo($imageName,PATHINFO_EXTENSION);
            //  print_r($extension);
             $destination = "img/".$imageName;
             if($extension == "jpg" || $extension  == "png" || $extension == "jpeg"){
                        if(move_uploaded_file($imageTmpName , $destination)){
                              $query = $pdo->prepare("insert into categories (name, image, description) values (:cName  , :cImage, :cDes)");
                              $query->bindParam('cName',$cName);
                              $query->bindParam('cImage', $imageName);          
                              $query->bindParam('cDes',$cDes);
                              $query->execute();
                              echo "<script>alert('category added successfully');
                              location.assign('index.php')</script>";
                        }
             }
             else{
                echo "<script>alert('invalid extension');
                             </script>";
             }
            
        }



        // addProduct
if(isset($_POST['addProduct'])){
$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productDes = $_POST['productDes'];
$productQty = $_POST['productQty'];
$cId = $_POST['cId'];
$productImageName = $_FILES['productImage']['name'];
$productImageTmpName = $_FILES['productImage']['tmp_name'];
$extension = pathinfo($productImageName, PATHINFO_EXTENSION);
$destination = "img/".$productImageName;
if($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
if(move_uploaded_file($productImageTmpName, $destination)){
$query = $pdo->prepare("insert into product (name, price, image,des, qty,c_id) values (:pName, :pPrice, :pImage, :pDes, :pQty, :cId)");
$query->bindParam('pName', $productName);
$query->bindParam('pImage',$productImageName);
$query->bindParam('pDes', $productDes);
$query->bindParam('pQty',$productQty);
$query->bindParam('pPrice', $productPrice);
$query->bindParam('cId', $cId);
$query->execute();
echo "<script>alert('product added Successfully');
</script>";
}
}
}
?>