<?php
    session_start();
    include 'database.php';
    //include 'function.php';
    // db password: ljihu38HkU3mMbjy
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>Cart</a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="pName">Product Name</label>
                    <input type="text" class="form-control" name="query" id="pName" placeholder="Name">
                    Category: 
                    <select  name="category">
                        <?php echo getCategoriesHTML(); ?>
                    </select>
                    <br/>
                    Price:  
                    From: <input type="text" name="price-from" />
                    To: <input type="text" name="price-to" />
                    <br/>
                    Order Results by: 
                    <input type="radio" name="ordering" value="product"> Product 
                    <input type="radio" name="ordering" value="price"> Price
                    <br/>
                    <input name="show-images" type="checkbox"> Display images
                    <br/>
                </div>
                <input type="submit" name="search-submitted" value="Submit" class="btn btn-default">
                <br /><br />
            </form>

            
            <!-- Display Search Results -->
            <br/> <br/> <br/> <br/>
            <?php
                echo "Post request: <br/>";
                print_r($_POST);
                echo "<br/>";
                
                if(isset($_POST['itemName'])) {
                    $_SESSION['cart'] = $_POST['itemName'];
                }
                
                echo "session: <br/>";
                print_r($_SESSION);
                
                include 'function.php';
                
                $category = '';
                $query = '';
                $pricefrom = '';
                $priceTo = '';
                $ordering = '';
                $showImages = false;
                
                //print_r($_GET);
                if (isset($_GET["category"]) && !empty($_GET["category"])) {
                    $category = $_GET["category"]; 
                }
                
                if (isset($_GET["price-from"]) && !empty($_GET["price-from"])) {
                    $priceFrom =  $_GET["price-from"]; 
                }
                
                if (isset($_GET["price-to"]) && !empty($_GET["price-to"])) {
                    $priceTo = $_GET["price-to"];
                }
                
                if (isset($_GET["ordering"]) && !empty($_GET["ordering"])) {
                    $ordering = $_GET["ordering"];
                }
                
                if (isset($_GET["show-images"]) && !empty($_GET["show-images"])) {
                    $showImages = true;
                }
                
                if(isset($_GET['query'])) {
                    $query = $_GET['query'];
                }
                
                
                
                if(isset($_GET["search-submitted"])){
                    //form was submitted
                    //pass all of the form fileds and filters into the getMatchingItems()
                    $items = getMatchingItems($query, $category, $priceFrom, $priceTo, $ordering, $showImages);
                }
                


                // echo "query: $query <br/>"; 
                // echo "category: $category <br/>"; 
                // echo "priceFrom: $priceFrom <br/>"; 
                // echo "priceTo: $priceTo <br/>"; 
                // echo "ordering: $ordering <br/>"; 
                // echo "showImages: $showImages <br/>"; 


                displayResults();
                //insertItemsIntoDB($items)
            ?>
            
        </div>
    </div>
    </body>
</html>