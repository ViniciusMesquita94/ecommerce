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

                    <?php cart(); ?>

                   <div id="shopping_card">

                    <span style="float: right; font-size:18px; padding:5px; line-height: 40px;">Bem-vindo Carlos!
                        <b style="color: yellow">Carrinho - </b>
                        Itens no Carrinho - <?php total_items(); ?>
                        Valor Total: <?php total_price(); ?>
                        <a href="cart.php" style="color: yellow">Ir Para o Carrinho</a></span>

                   </div>





                    <div id="products_box">

                        <?php getPro();?>
                        <?php getCatPro(); ?>
                        <?php getBrandPro(); ?>

                    </div>

                </div>

            </div>

            <div id="footer">
                    <h2 style="text-align: center; padding-top:30px;" >&copy; Luma Star's - 2015  - Proibido a copia parcial ou total desse site.</h2>
            </div>

        </div>

    </body>
</html>  