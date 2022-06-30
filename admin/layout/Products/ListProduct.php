<?php include '../../../common/authorization.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../../../user/css/base.css">
    <link rel="stylesheet" href="./../../css/dashboard.css">
    <link rel="stylesheet" href="./../../css/Addfood.css">
</head>
<body>
    <?php include '../common/header.php'?>
    <main>
        <?php include '../common/left.php'?>
        <div class="right">
            <h1>List Products</h1>
            <h2><a href="#">Dasboard</a>/List Products</h2>
            <div class="bang">
                <p><i class="fas fa-clipboard-list"></i> All Listings</p>
                <table class="table table-bordered" >
                    <thead>
                        <th width=50px>STT</th>
                        <th width=200px>Product's Name</th>
                        <th>Image</th>
                        <th width=65px>Active</th>
                        <th width=50px>Hot</th>
                        <th width=90px>Quantity</th>
                        <th width=200px>Category Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            include '../../../common/connectSQL.php';
                            // start of pagination block 1
                            $currentPage = !empty($_GET["page"]) ? $_GET["page"] : 1;
                            $itemPerPage = !empty($_GET["perPage"]) ? $_GET["perPage"] : 10;
                            $offset = ($currentPage-1)*$itemPerPage;
                            $totalRecords = 0;
                            $totalPages = 0;

                            $pageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            parse_str(parse_url($pageUrl)['query'], $params);
                            $keys = array_keys($params);
                            $queryString="?";
                            for ($i=0; $i<count($keys); $i++){
                                if ($keys[$i]=="perPage" || $keys[$i]=="page") {
                                    continue;
                                }
                                $queryString .= $keys[$i] . "=" . $params[$keys[$i]] . "&";
                            }
                            $queryString .= "perPage=" . $itemPerPage;
                            // end of pagination block 1

                            
                            $sql = "select * from products inner join categories on products.category_id = categories.id order by products.id desc LIMIT $itemPerPage OFFSET $offset";
                            $query = $conn->query($sql);
                            $i = 0;

                           
                            while($row = $query->fetch_row()) {
                                $i++;
                                echo "
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$row[1]."</td>
                                    <td>
                                        <img width=90px src='../../img/".$row[5]."'>
                                    </td>
                                    <td>".$row[6]."</td>
                                    <td>".$row[8]."</td>
                                    <td>".$row[9]."</td>
                                    <td>".$row[12]."</td>
                                    <td> 
                                        <button>
                                            <a href='./EditProduct.php?id=".$row[0]."'>Sửa</a>
                                        </button>
                                        <button>
                                        ";
                                        if($row[6] == 1){
                                            echo "
                                            <a href='./DeleteProduct.php?id=".$row[0] ."'onclick='return XacNhanXoa()'>Khóa</a>";
                                        }else{
                                            echo "
                                            <a href='./UnBlockProduct.php?id=".$row[0] ."&categoryID=".$row[10]."'onclick='return XacNhanHuyXoa()'>Hủy Khóa</a>
                                            ";
                                        }
                                        echo "
                                        </button>
                                        <button>
                                            <a href='../ProductImages/Details.php?id=".$row[0]."'>Images</a>
                                        </button>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <?php 
                 // start of pagination block 2
                 $sqlTotalRecordsForPagination = "select * from products inner join categories on products.category_id = categories.id order by products.id desc";
                 $resultTotalRecords = mysqli_query($conn, $sqlTotalRecordsForPagination);
                 $totalRecords = $resultTotalRecords->num_rows;
                 $totalPages = ceil($totalRecords/$itemPerPage);
                 // end of pagination block 2
                ?>

                <?php include '../../../common/pagination.php' ; ?>
            </div>
        </div>
    </main>
    <footer>
        <span>Copyright @ Your website 2021</span>
        <span>Privacy policy . Term conditions</span>
    </footer>
</body>
<script>
    function XacNhanXoa(){
       return confirm("Bạn có chắc chắc muốn xóa sản phẩm nay hay không ?");
    }
    function XacNhanHuyXoa(){
       return confirm("Bạn có chắc chắc muốn kích hoạt sản phẩm nay hay không ?");
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>