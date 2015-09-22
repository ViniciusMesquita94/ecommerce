<!DOCTYPE html>
<?php
    session_start();

    include("functions/functions.php");
?>
<html>
    <head lang="pt-br">
        <meta charset="UTF-8">
        <title>Luma Star's</title>
        <link rel="stylesheet" href="styles/style.css" media="all" />
    </head>
    <body>



        <div class="main_wrapper">

            <div class="header_wrapper">
                <!-- Banner -->
               <a href="index.php"> <img id="banner" src="images/banner.png" /> </a>            </div>
            <!-- Menu -->
            <div class="menubar">

                <ul id="menu">
                    <li><a href="index.php">HOME </a></li>
                    <li><a href="all_products.php">TODOS OS PRODUTOS</a>  </li>
                    <li><a href="customer/my_account.php">MINHA CONTA </a></li>
                    <li><a href="#">CONTATO </a></li>
                    <li><a href="cart.php">CARRINHO </a></li>

                </ul>
                <!-- Pesquisar -->

                <div id="form">

                    <form method="get" action="results.php" enctype="multipart/form-data" >
                        <input type="text" name="user_query" placeholder="Pesquisar no Site..."/>
                        <input type="submit" name="search" value="Pesquisar"/>
                    </form>

                </div>


            </div>




            <div class="content_wrapper">

                <!-- Barra Lateral -->
                <div id="sidebar">

                    <div id="sidebar_title">Produtos</div>
                    <div id="cats">

                        <ul>
                            <?php getCats($con); ?>



                        </ul>
                    </div>


                    <div id="sidebar_title">Tipo</div>
                        <!-- Brand-->
                        <div id="cats">
                            <ul>

                                <?php getBrands($con); ?>

                            </ul>
                        </div>


                </div>
                <!-- Conteúdo -->
                <div id="content_area">

                    <?php cart(); ?>

                   <div id="shopping_card">

                    <span style="float: right; font-size:18px; padding:5px; line-height: 40px;">Bem-vindo Carlos!
                        <b style="color: yellow">Carrinho - </b>
                        Itens no Carrinho - <?php total_items(); ?>
                        Valor Total: <?php total_price(); ?>
                        <a href="cart.php" style="color: yellow">Ir Para o Carrinho</a></span>

                   </div>





                    <div id="products_box">
                        <br />

                <form action="" method="post" enctype="mutipart/from-data">

                    <table align="center" width="700" bgcolor="#7fffd4">


                        <tr align="center">
                            <th>Remover</th>
                            <th>Produto(s)</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>


                        <?php
                        $total = 0;

                        global $con;

                        $ip = getIp();

                        $sel_price = "select * from cart where ip_add='$ip'";

                        $run_price = mysqli_query($con, $sel_price);

                        while($p_price=mysqli_fetch_array($run_price)){

                            $pro_id = $p_price['p_id'];

                            $pro_price = "select * from products where product_id='$pro_id'";

                            $run_pro_price = mysqli_query($con, $pro_price);

                            while ($pp_price = mysqli_fetch_array($run_pro_price)){

                                $product_price = array($pp_price['product_price']);

                                $product_title = $pp_price['product_title'];

                                $product_image = $pp_price['product_image'];

                                $single_price = $pp_price['product_price'];

                                $value = array_sum($product_price);

                                $total += $value;


                        ?>

                        <tr align="center">
                            <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
                            <td><?php echo $product_title; ?><br />
                            <img src="admin_area/product_images/<?php echo $product_img;?>" width="60" height="60"/>
                            </td>
                            <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty']; ?>"></td>

                            <?php

                            if(isset($_POST['update_cart'])){

                                $qty = $_POST['qty'];

                                $update_qty = "update cart set qty='$qty'";


                                $run_qty = mysqli_query($con, $update_qty);

                                $_SESSION ['qty']=$qty;

                                $total = $total*$qty;

                            }



                            ?>





                            <td><?php echo "RS " . $single_price; ?></td>
                        </tr>



                    <?php } } ?>

                        <tr align="right">
                            <td colspan="4"><b>Total</b></td>
                            <td><?php echo "R$ " . $total;  ?></td>
                        </tr>
                        <tr align="center">

                            <td colspan="2"><input type="submit" name="update_cart" value="Atualizar Carrinho"></td>
                            <td><input type="submit" name="continue" value="Continuar Comprando"></td>
                            <td><button><a href="checkout.php" style="text-decoration: none; color: black">Finalizar</a></button></td>

                        </tr>


                    </table>


                </form>
                        <?php
                            function updatecart(){
                                global $con;
                                $ip = getIp();

                                if (isset($_POST['update_cart'])) {

                                    foreach ($_POST['remove'] as $remove_id) {

                                        $delete_product = "delete from cart where p_id='$remove_id' and ip_add='$ip'";

                                        $run_delete = mysqli_query($con, $delete_product);

                                        if ($run_delete) ;
                                        {

                                            echo "<script>window.open('cart.php','_self')</script>";

                                        }

                                    }


                                }
                                if (isset($_POST['continue'])) {

                                    echo "<script>window.open('index.php','_self')</script>";
                                }

                                echo @$up_cart = updatecart();
                            }

                        ?>



                    </div>

                </div>

            </div>

            <div id="footer">
                <br /><b>Notice</b>:  Undefined index: qty in <b>C:\xampp\htdocs\ecommerce\cart.php</b> on line <b>155</b><br />
                    <h2 style="text-align: center; padding-top:30px;" >&copy; Luma Star's - 2015  - Proibido a copia parcial ou total desse site.</h2>
            </div>

        </div>

    </body>
</html>  