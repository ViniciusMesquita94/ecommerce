<!DOCTYPE html>
<?php

include("includes/db.php");


?>


<html>
    <head lang="pt-br">
        <meta charset="UTF-8">
        <title>Adicionar Produto</title>

        <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>

    </head>
    <body bgcolor="skyblue">
        <div >

           <form action="insert_product.php" method="post" enctype="multipart/form-data">

                <table align="center" width="750" border="2" bgcolor="orange">

                    <tr align="center">
                        <td colspan="7"><h2>Insira o Novo Post Aqui</h2></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Titulo do Produto:</b></td>
                        <td><input type="text" name="product_title" size="60" required></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Categoria do Produto</b></td>
                        <td>
                            <select name="product_cat" required>
                                <option>Selecione a categoria</option>
                                <?php
                                    $get_cats = "Select * from categories";

                                    $run_cats = mysqli_query($con, $get_cats);

                                    while ($row_cats=mysqli_fetch_array($run_cats)){
                                        $cat_id = $row_cats['cat_id'];
                                        $cat_title = $row_cats['cat_title'];
                                        echo "<option value='$cat_id'>$cat_title</option>";
                                    }
                                ?>
                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td align="right"><b>Tipo do Produto</b></td>
                        <td>
                            <select name="product_brand" required>
                                <option>Selecione o Tipo</option>
                                <?php
                                $get_brands = "Select * from brands";

                                $run_brands = mysqli_query($con, $get_brands);

                                while ($row_brands=mysqli_fetch_array($run_brands)){

                                    $brand_id = $row_brands['brand_id'];
                                    $brand_title = $row_brands['brand_title'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><b>Imagem do Produto</b></td>
                        <td><input type="file" name="product_image" required></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Preço do Produto</b></td>
                        <td><input type="text" name="product_price" required></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Descrição do Produto</b></td>
                        <td><textarea name="product_desc" cols="40" rows="10"></textarea></td>
                    </tr>

                    <tr>
                        <td align="right"><b>Keywords do Produto</b></td>
                        <td><input type="text" name="product_keywords" size="50" required></td>
                    </tr>

                    <tr align="center">
                        <td colspan="7"><input type="submit" name="insert_post" value="Inserir"></td>
                    </tr>

                </table>


           </form>


            <?php

            ?>
        </div>
    </body>
</html>
<?php
// Adicionando os textos para o DB
    if(isset($_POST['insert_post'])){

        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];

//  Adicionando a Imagem para o DB

        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        move_uploaded_file($product_image_tmp,"product_images/$product_image");


        $insert_product = "insert into products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) values('$product_cat','$product_brand','$product_title','$product_price',' $product_desc','$product_image','$product_keywords')";


       $insert_pro = mysqli_query($con, $insert_product);

        if($insert_pro){

        echo "<script>alert('produto foi inserido com sucesso!')</script>";
        echo "<script>window.open('insert_product.php','_self')</script>";
        }
    }
?>