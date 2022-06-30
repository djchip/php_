<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <!-- <META http-equiv="refresh" content="0;URL=./fragment/header/header.html">  -->
    
    <!-- fontawesome - icon -->
		<link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <!-- bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="../css/base.css" />
		<link rel="stylesheet" href="../css/header.css" />
		<link rel="stylesheet" href="../css/footer.css" />
		<link rel="stylesheet" href="../css/product-list.css" />
    <title>Document</title>
</head>
<body>
 <!-- Header -->
<?php include 'common/header.php'?>

<main>
    <div class="link">  
        <div class="container">
        <div class="sub"><a href="./index.html"><i class="fa-solid fa-house"></i>Trang chủ</a></div>
        <p>></p>
        <div class="sub"><a href="./List_Product.html">Iphone</a></div>
        </div>
    </div>
    <div class="filter">
        <div class="container">
            <div>Lọc danh sách : </div>
            <ul>
                <li class="category">Danh mục <i class="fa-solid fa-angle-down"></i>
                    <ul class="sub-filter">
                    
                        <li>Iphone 13 series</li>
                        <li>Iphone 12 series</li>
                        <li>Iphone 11 series</li>
                        <li>Iphone x series</li>
                        <li>Iphone 8 series</li>
                    
                    </ul>
                </li>
                <li class="price">Giá <i class="fa-solid fa-angle-down"></i>
                    <ul class="sub">
                    
                        <li>12 - 15 triệu</li>
                        <li>15 - 20 triệu</li>
                        <li>20 - 100 tiệu</li>
                    </ul>  
                    
                </li>
                <li class="reorder">Sắp xếp <i class="fa-solid fa-angle-down"></i>
                    <ul class="subs">
                    
                        <li>Sản phẩm cũ - mới</li>
                        <li>Sản phẩm mới - cũ</li>
                        <li>Giá từ thấp đến cao</li>
                        <li>Giá từ cao đến thấp</li>
                        <li>Sản phẩm bán chạy</li>
                    
                </li>
            </ul>
        </div>
        
    </div>
    <div class="list">
        <h4 class="container my-5">Iphone</h4>
        <div class="container row">

            <?php
            // start of pagination block 1
            $currentPage = !empty($_GET["page"]) ? $_GET["page"] : 1;
            $itemPerPage = !empty($_GET["perPage"]) ? $_GET["perPage"] : 8;
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

             $categorySlug = "";
                $sql = "SELECT name, price, thumb, short_desc, slug FROM products where active = 1 LIMIT $itemPerPage OFFSET $offset";
                $sqlTotalRecordsForPagination = "SELECT * FROM products where active = 1"; // lấy ra tất cả sản phẩm để tính số trang

                if (isset($_GET["keyword"]) && isset($_GET["category"])) {
                    $keyword = $_GET["keyword"];
                    $categorySlug = $_GET["category"];
                    $sql = "SELECT p.name, p.price, p.thumb, p.short_desc, p.slug 
                    FROM products p JOIN categories c ON c.id=p.category_id 
                    WHERE (p.name LIKE '%$keyword%' OR p.short_desc LIKE '%$keyword%') AND c.slug='$categorySlug' LIMIT $itemPerPage OFFSET $offset";

                    $sqlTotalRecordsForPagination ="SELECT p.name, p.price, p.thumb, p.short_desc, p.slug 
                    FROM products p JOIN categories c ON c.id=p.category_id 
                    WHERE (p.name LIKE '%$keyword%' OR p.short_desc LIKE '%$keyword%') AND c.slug='$categorySlug'";

                }
                if (isset($_GET["category"])) {
                    $categorySlug = $_GET["category"];
                    $sql = "SELECT p.name, p.price, p.thumb, p.short_desc, p.slug FROM products p JOIN categories c ON c.id=p.category_id 
                    WHERE c.slug='$categorySlug' LIMIT $itemPerPage OFFSET $offset";
                    $sqlTotalRecordsForPagination = "SELECT p.name, p.price, p.thumb, p.short_desc, p.slug FROM products p JOIN categories c ON c.id=p.category_id WHERE c.slug='$categorySlug'";
                } 
                if (isset($_GET["keyword"])) {
                    $keyword = $_GET["keyword"];
                    $sql = "SELECT name, price, thumb, short_desc, slug FROM products 
                    WHERE name LIKE '%$keyword%' OR short_desc LIKE '%$keyword%' LIMIT $itemPerPage OFFSET $offset";
                    $sqlTotalRecordsForPagination = "SELECT name, price, thumb, short_desc, slug FROM products WHERE name LIKE '%$keyword%' OR short_desc LIKE '%$keyword%'";
                }
                $result = mysqli_query($conn, $sql);

                // start of pagination block 2
                $resultTotalRecords = mysqli_query($conn, $sqlTotalRecordsForPagination);
                $totalRecords = $resultTotalRecords->num_rows;
                $totalPages = ceil($totalRecords/$itemPerPage);
                // end of pagination block 2

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='item col col-sm-3'>
                        <div class='parent-wrapper'>
                        <a href='product-detail.php?slug=" . $row['slug'] . "' class='wrapper'>
                            <div class='img-wrapper'>
                                <img
                                    src='../../admin/img/" . $row["thumb"]
                                    . "'alt='" . $row["short_desc"] . 
                                "'/>" .
                            "</div>
                            <div class='info'>
                                <div class='name'>" . 
                                        $row["name"]
                                . "</div>
                                <span class='price'>".  $row["price"] ." ₫</span>
                            </div>
                            <div class='note'>
                                <span class='badge badge-primary'>KM</span>
                                <span>Sẵn hàng, giảm thêm tới 1.500.000đ ...</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    ";
                }

                include '../../common/pagination.php';
					?>
        </div>
        <div class="plus">Xem thêm sản phẩm</div>
    </div>
    <div class="note">
        <div class="container">
        <h5>Điện thoại iPhone chính hãng</h5>
        <br>
        <p>Sự ra đời của những chiếc điện thoại iPhone không nghi ngờ gì khi đã thay đổi bộ mặt của giới công nghệ. Bằng vào sự thành công của hãng Apple trong suốt những năm qua đã là một mình chứng rõ nét nhất cho chuyện đó. điện thoại iPhone xuất hiện và bùng nổ tại Việt Nam chính xác vào khoảng năm 2008 khi chiếc điện thoại iPhone 3g ra mắt. Với kiểu dáng vô cùng mới lạ, điện thoại iPhone đã khuấy đảo cả thế giới công nghệ - cũng là 1 bước tiến không nhỏ cho Apple. Cắt cạnh, bo viền, đen bóng sang trọng, hệ điều hành là độc nhất vô nhị, tôi ưu và đơn giản để sử dụng với mọi đối tượng người tiêu dùng. Và kể từ khi những chiếc điện thoại iPhone được đưa ra thị trường, có khá nhiều ý kiến trái chiều được đưa ra, quá nhiều cuộc tranh cãi về những chiếc điện thoại iPhone. Nhưng dù sao, Apple vẫn thành công trên con đường của mình, theo chiến lược “Luôn là kẻ dẫn đầu, nếu không thể dẫn đầu, hãy là kẻ giỏi nhất”</p>
        <br>
        <h6>Cấu hình và thiết kế điện thoại iPhone</h6>
        <br>
        <p>Apple là một công ty chuyên phát triển các sản phẩm khoa học và công nghệ, và điện thoại iPhone là một ví dụ điển hình và hoàn hảo. Theo cương lĩnh là tạo ra chiếc điện thoại được trang bị tính năng phong phú, điện thoại iPhone đã đánh trúng tâm lý và nhu cầu của người tiêu dùng và đã rất nhanh xây dựng được lượng fan hâm mộ mạnh mẽ. Chiếc điện thoại iPhone thay đổi thế giới -iPhone 3g là một tỏng những chiếc điện thoại di động thông minh – smartphone nhỏ nhất. điện thoại iPhone có phong cách thiết kế nhỏ gọn tiện không giống bất cứ chiếc điện thoại nào khác. Với phần kính che mặt chống trầy xướt – 1 trong những yếu tố vô cùng cần thiết. Điện thoại iPhone sở hữu màn hình với độ hiển thị ban đầu là 16 triệu điểm màu với độ phân giải 480 x 320 pixel, cảm biến định hướng cùng giao diện người dùng dựa trên cảm ứng, hệ điều hành mang lại cảm giác lướt web và chơi game vô cùng mượt mà. Về ngoại hình, trên thực tế hầu như toàn bộ phần mặt trước là phần màn hình hiển thị , phần loa nghe phía trên và nút Home phía dưới.</p>
        <br>
        <h6>Điện thoại iPhone giá rẻ</h6>
        <br>
        <p>Do nhu cầu của người tiêu dùng Việt nam càng ngày càng tăng cao nên số lượng điện thoại iPhone đổ về thị trường Việt rất nhiều. Điều này khiến rất nhiều người tiêu dùng không biết nên chọn cơ sở nào để mua hàng chất lượng tốt giá cả hợp lý. Trong đó, Hoàng Hà Mobile là một trong những công ty kinh doanh và phân phối điện thoại iPhone chất lượng từ rất sớm. Và điện thoại iPhone cũng phân chia ra thành rất nhiều loại mặt hàng khác nhau. Một loại iPhone 5 nhưng có tới hơn 10 loại điện thoại iPhone 5 khác nhau: chia ra thành các loại như bộ nhớ 16 gb, 32gb, 64gb,…. Hay là hàng nhập khẩu, hàng công ty FPT Trading phân phối,… thậm chí, các phiên bản iPhone 6 còn khác nhau ở kích thước màn hình. Người tiêu dùng có thể có cho mình nhiều sự lựa chọn. Việc xuất xứ của những chiếc điện thoại iPhone cũng là một tỏng những vấn đề được quan tâm nhất. Những chiếc điện thoại iPhone được bán ra tại Hoàng Hà đề là hàng chính hãng nhập khẩu từ Apple của các thị trường uy tín như Mỹ hay Singapore, HongKong và Nhật.</p>
        <br>
        <p>Nếu bạn đang quan tâm tới một chiếc điện thoại iPhone thì đừng ngần ngại, bởi có một khảo sát cho ra kết luận rằng 90% những người sử dụng điện thoại iPhone sẽ không đổi sang một hãng điện thoại nào khác. Đây là một mình chứng thuyết phục cho chất lượng của những chiếc điện thoại iPhone. Hệ điều hành tối ưu và khác biệt cũng là 1 trong những yếu tố níu chân người tiêu dùng. Hiện nay, sản phẩm điện thoại iPhone 7 và 7 plus với khả năng chống nước đang dấy lên những cơn sốt trong giới công nghệ. Và cũng không dừng lại tại đó, cả thế giới đặt rất nhiều kỳ vọng vào hãng Apple với điện thoại iPhone 8 được cho là sẽ ra mắt trong năm sau. Chống nước, chông bụi, kháng va đạp, nút Home cảm ứng… Apple sẽ còn cho ra những sản phẩm bất ngờ tới mức nào! Hãy cùng Hoàng Hà khám phá thế giới công nghệ trong hệ sinh thái IOS nhé.</p>
    </div>
</div>
</main> 
<!-- Footer -->
<?php include 'common/footer.php'?>
</body>
</html>