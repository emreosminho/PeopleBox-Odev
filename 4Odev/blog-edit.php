<?php
    require "libs/vars.php";
    require "libs/functions.php";  

    $title = $description = "";
    $title_err = $description_err = "";

    $id = $_GET["id"];
    $result = getBlogByID($id);
    $selectedMovie = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $image = $_POST["image"];
        $url = $_POST["url"];
        $isActive =isset($_POST["isActive"]) ? 1 : 0;

        $input_title = trim($title); // Odev 4

        if(empty($input_title)){
            $title_err = "Burada title boş olamaz !!!";
            echo "<div class='alert alert-danger mb-0 text-center'>{$title_err}</div>";
        }else if(strlen($input_title) > 150){
            $title_err = "Bu title için fazla karakter... Max: 100kr";
            echo "<div class='alert alert-danger mb-0 text-center'>{$title_err}</div>";
        }else{
            $title = control_input($input_title);
        }

        $input_description = trim($description); // Odev 4

        if(empty($input_description)){
            $description_err = "Burası boş olmamalıdır...";
            echo "<div class='alert alert-danger mb-0 text-center'>{$description_err}</div>";
        }else if(strlen($input_description) < 10){
            $description_err = "Bu description karakter sınırını aştınız. Min: 10kr";
            echo "<div class='alert alert-danger mb-0 text-center'>{$description_err}</div>";
        }else{
            $description = $input_description;
        }

        if(empty($title_err) && empty($description_err)) {
            if(editBlog($id,$title,$description,$image,$url,$isActive)){
                header('Location: index.php');
            }else{
                echo "Güncelleme sırasında hata oluştu";
            }
        }
    }
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">

        <div class="col-3">
            <?php include "views/_menu.php" ?>     
        </div>
        <div class="col-9">

           <div class="card">
           
                <div class="card-body">
                    <form method="POST">

                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $selectedMovie["title"] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama</label>
                            <textarea name="description" id="description" class="form-control"><?php echo $selectedMovie["description"] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Resim</label>
                            <input type="text" class="form-control" name="image" id="image" value="<?php echo $selectedMovie["image"] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url" value="<?php echo $selectedMovie["url"] ?>">
                        </div>
                        <div class="form-check mb-3">
                            <label for="isActive" class="form-check-label">Is Active</label>
                            <input type="checkbox" class="form-check-input" name="isActive" id="isActive" <?php if($selectedMovie["isActive"]){echo "checked";} ?>>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-primary">

                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

