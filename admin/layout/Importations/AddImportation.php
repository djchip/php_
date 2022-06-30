<?php include '../../../common/authorization.php'; ?>
<?php
    include '../../../common/connectSQL.php';
    
    
    $sql_ven = "select * from vendors";
    $qr_ven = mysqli_query($conn, $sql_ven);
    $sql_user = "select * from users";
    $qr_user = mysqli_query($conn, $sql_user);
    $sql_pro = "select * from products";
    $qr_pro = mysqli_query($conn, $sql_pro);
    
    // $sql_pros.$i = "select * from products";
    // $qr_pros = mysqli_query($conn, $sql_pros);
    //var_dump($_POST);
    if(isset($_POST['upload'])){

        $date = gmdate("Y-m-d H:i:s", time()+7*60*60);
        //var_dump($date);
        $vendors = $_POST['vendors'];
        $user = $_POST['users'];
        $sql_im ="INSERT INTO `importations`(`vendor_id`, `user_id`, `import_date`) VALUES ($vendors,$user,'$date')";
        $qr_im = mysqli_query($conn, $sql_im);
        //var_dump($qr_im);
        $sql_id =  "select * from `importations` where import_date = '$date'";
        
        $qr_idm = mysqli_query($conn, $sql_id);
        $row_idm = mysqli_fetch_assoc($qr_idm);
        //var_dump($row_idm['id']);
        $idm = $row_idm['id']; // id cua imporation
        //
        //
        $sql_impro = "INSERT INTO `importation_products`(`product_id`, `importation_id`, `quantity`, `price`) VALUES ";
        
        // echo "<pre>" . print_r($_POST, true) . "</pre>";
        $products = $_POST['product'];
        $products = array_values($products);// convert array de lap for
        // $quantity = $_POST['quantity'];
        // $price= $_POST['price'];
        for($i = 0 ; $i < count($products) ; $i++){
            $product_id = $products[$i]['id'];
            $quantity = $products[$i]['quantity'];
            $price = $products[$i]['price'];
            $sql_impro .= " ($product_id,$idm, $quantity, $price) ,";
            //var_dump($products[$i]);
        }
        $sql_impro = substr_replace($sql_impro ,"", -1);//loai bo dau , cuoi cung
        // var_dump($sql_impro);
        $qr_impro = mysqli_query($conn,$sql_impro);
        // var_dump($qr_impro);

        // update quantity
        for($i = 0 ; $i < count($products) ; $i++){
        $product_id = $products[$i]['id'];
        $sql_update = "UPDATE products join importation_products on products.id = importation_products.product_id join importations on importations.id = importation_products.importation_id set products.quantity = products.quantity + importation_products.quantity where importations.id = $idm and products.id = $product_id"; 
        $qr_update = mysqli_query($conn,$sql_update);
        // var_dump($qr_update);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./../../css/dashboard.css">
    <link rel="stylesheet" href="./../../css/Addfood.css">
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
    <?php  include '../common/left.php'?>
        <div class="right">
            <h1>Add Importation</h1>
            <h2><a href="#">Dasboard</a>/Add Importation</h2>
            <div class="content_basic">
                <p>Basic info</p>
                <hr/>
                <form method ="POST" action="" id="createForm">
                    <label>Nhà cung cấp</label>
                    <select name="vendors">
                        <?php 
                            while($row_ven = $qr_ven->fetch_assoc()){
                        ?>
                            <option value="<?php echo $row_ven['id'] ?>"><?php echo $row_ven['name'] ?></option>
                           <?php } ?>
                        
                    </select><br><br>
                    <lable>Nhân viên nhận hàng</lable>
                    <select name="users">
                        <?php 
                            while($row_user = $qr_user->fetch_assoc()){
                        ?>
                            <option value="<?php echo $row_user['id'] ?>"><?php echo $row_user['first_name'] ?></option>

                           <?php } ?>
                        
                    </select><br><br>


                    
                    <h2 class="">Danh sách sản phẩm muốn nhập</h2>
                    

                    <div class="item-row mb-5">
                        <label>Tên Sản phẩm</label>
                        <select name="product[product0][id]">
                            <?php 
                                while($row_pro = $qr_pro->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row_pro['id'] ?>"><?php echo $row_pro['name'] ?></option>
                            <?php } 
                                    mysqli_data_seek($qr_pro, 0);
                            ?>
                        </select><br><br>
                        <label>Số lượng </label>
                        <input type="text" name="product[product0][quantity]" class="col-4" pattern="[0-9]+" title="Chỉ được nhập số" required><br/><br>
                        <label>Đơn giá</label>
                        <input type="text" name="product[product0][price]" class="col-4" pattern="[0-9]+" title="Chỉ được nhập số" required><br/><br>
                    </div>
                    <br>
                    <button id="btnAddItem" type="button" class="btn btn-primary">+</button><br>
                    <button id="btnSubmit" name="upload" type="submit" class="end text-right blue" >Lưu</button>
                </form>
                
            </div>
        </div>
        
        
    </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    let indexOfImportationItem = 1;
     handleAddNewItem(indexOfImportationItem);
    function handleAddNewItem(indexOfImportationItem){
        const btnAdd = document.getElementById('btnAddItem');
        const form = document.getElementById('createForm');

        const btnSubmit = document.getElementById('btnSubmit');

        $('#btnAddItem').click(function(){
            $.ajax({
                url: '../get-list-product-ajax.php',
                success: function(result) {
                    const content = `
                    <div class="item-row mb-5">
                    <label>Tên Sản phẩm</label>
                    <select name="product[product${indexOfImportationItem}][id]">
                        ${result}
                    </select><br><br>
                    <label>Số lượng </label>
                    <input type="text" name="product[product${indexOfImportationItem}][quantity]" class="col-4"><br/><br>
                    <label>Đơn giá</label>
                    <input type="text" name="product[product${indexOfImportationItem}][price]" class="col-4"><br/><br>
                    </div>
                    `;
                    $(content).insertBefore('#btnAddItem');
                    indexOfImportationItem = indexOfImportationItem + 1;
                }
            })
        });
    }
</script>                            
</html>