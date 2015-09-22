<!DOCTYPE html>
<?php
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

                   <div id="shopping_card">

                    <span style="float: right; font-size:18px; padding:5px; line-height: 40px;">Bem-vindo Carlos! <b style="color: yellow">Carrinho - </b>  Itens no Carrinho -  Valor Total:  <a href="cart.php" style="color: yellow">Ir Para o Carrinho</a></span>

                   </div>




                    <div id="products_box">

                       <?php

                       if(isset($_GET['search'])) {

                           $search_query = $_GET['user_query'];

                           $get_pro = "select * from products where product_keywords like '%$search_query%'";

                           $run_pro = mysqli_query($con, $get_pro);


                           while ($row_pro = mysqli_fetch_array($run_pro)) {

                               $pro_id = $row_pro['product_id'];
                               $pro_cat = $row_pro['product_cat'];
                               $pro_brand = $row_pro['product_brand'];
                               $pro_title = $row_pro['product_title'];
                               $pro_price = $row_pro['product_price'];
                               $pro_image = $row_pro['product_image'];

                               echo "
            <div id='single_product'>

                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='180' height='180' />

                <p><b> R$ $pro_price</b></p>

                <a href='details.php?pro_id=$pro_id' STYLE='float: left'>Mais Detalhes</a>
                <a href='index.php?pro_id=$pro_id'><button STYLE='float: right'> Add to Cart</button></a>


            </div>
        ";

                           }
                       }


                       ?>

                    </div>

                </div>

            </div>

            <div id="footer">
                    <h2 style="text-align: center; padding-top:30px;" >&copy; Luma Star's - 2015  - Proibido a copia parcial ou total desse site.</h2>
            </div>

        </div>

    </body>
</html>  