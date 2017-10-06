<?php include "header.php"; ?>
<?php
include 'config.php';

if(isset($_SESSION['username'])== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
    header('Location: index.php');
}

?>

    <style>
        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
<h4 class="ui-bar ui-bar-a ui-icon-user" style="margin-top: 0px;background: #3b5998;color: #FFFFFF; text-align:right;font-weight: normal">
    <img onclick="" src="images/avatar.png" style="width: 10%;border-radius: 100%;border: 2px solid #fff">   Hai <?php echo $_SESSION['username']; ?> !</h4>

<!--<h5 class="ui-bar ui-bar-a" style="margin-bottom: 0px;background: #3b5998;color: #FFFFFF; text-align: center;font-weight: normal">Copyright 2017 || Ayu Fitri Wulandari || Derry Ajeng S</h5>
-->
<style>
    input[type=text] {
        width: 100px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
        background-color: white;
        background-image: url('searchicon.png');
        background-position: 5px 5px;
        background-repeat: no-repeat;
        padding: 8px 15px 8px 20px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;

    }

    input[type=text]:focus {
        width: 100%;
        padding-left: 30px;
    }
</style>
<form style="padding-left: 40px;padding-right: 10px">
    <input type="text" name="search" placeholder="Search..">
</form>
<div class="container" style="padding-left: 15%">

    <div data-role="main" class="ui-content">
        <div class="ui-corner-all custom-corners">
            <?php
            //pagination
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $per_page = 5;
            // Page will start from 0 and Multiple by Per Page
            $start_from = ($page - 1) * $per_page;

            $query = "select * from mhs ORDER BY tahun DESC LIMIT $start_from, $per_page";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="ui-bar ui-bar-a center-wrapper">
                        <!--                <h3>--><?php //echo $row['nama'] ?><!--</h3>-->
                    </div>
                    <div class="ui-body ui-body-a center-wrapper">
                        <img style="width: 100%" src="img/user/<?php echo $row['foto']?>">
                    </div>
                    <div class="ui-body ui-body-a ui-grid-a center-wrapper">
                        <div class="ui-block-a">
                            <b>Angkatan :</b> <?php echo $row['tahun'] ?>
                        </div>
                        <div class="ui-block-b">
                            <b>Prodi :</b> <?php echo $row['prodi'] ?>
                        </div>
                    </div>
                    <div class="ui-body ui-body-a">
                        <p><b>Nama :</b> <?php echo $row['nama']?></p>
                        <p><b>NIM :</b> <?php echo $row['nim']?></p>
                        <a href="profile_lihat.php?nim=<?php echo $row['nim'] ?>" class="ui-btn">Lihat profile..</a>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="ui-bar center-wrapper">
                <ul class="pagination">
                    <?php
                    $x = mysqli_query($conn, "SELECT * from mhs");
                    // Count the total records
                    $total_records = mysqli_num_rows($x);

                    //Using ceil function to divide the total records on per page
                    $total_pages = ceil($total_records / $per_page);

                    //Going to first page
                    echo "<li><a href='home.php?page=1' >" . '&laquo;' . "</a></li>";

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li><a href='home.php?page=$i' >" . $i . "</a></li>";
                    };
                    // Going to last page
                    echo "<li><a href='home.php?page=$total_pages' >" . '&raquo;' . "</a></li>
                    ?>
            </div>
        </div>
    </div>

</div>


<?php include "footer.php"; ?>

