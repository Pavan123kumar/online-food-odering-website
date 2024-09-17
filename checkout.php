<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Your CSS and other head content goes here -->
</head>
<body>
    <!-- Your header/navigation content goes here -->
    
    <!-- Main content section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Checkout</h1>
                <!-- PHP code for order placement and validation -->
                <?php
                session_start();
                include("connection/connect.php");
                error_reporting(0);
                
                function function_alert() { 
                    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
                    echo "<script>window.location.replace('your_orders.php');</script>"; 
                }
                
                if(empty($_SESSION["user_id"])) {
                    header('location:login.php');
                } else {
                    if(isset($_POST['submit'])) {
                        $total_items = 0;
                        foreach ($_SESSION["cart_item"] as $item) {
                            $total_items += $item["quantity"];
                        }
                        
                        if($total_items > 200) {
                            $error = "Cannot place order for 200 or more food items.";
                        } else {
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_total += ($item["price"] * $item["quantity"]);
                                
                                $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) VALUES ('".$_SESSION["user_id"]."', '".$item["title"]."', '".$item["quantity"]."', '".$item["price"]."')";
                                mysqli_query($db, $SQL);
                            }
                            
                            unset($_SESSION["cart_item"]);
                            unset($item["title"]);
                            unset($item["quantity"]);
                            unset($item["price"]);
                            
                            $success = "Thank you. Your order has been placed!";
                            function_alert();
                        }
                    }
                }
                ?>
                
                <!-- Display error message if any -->
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Display success message if any -->
                <?php if(isset($success)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Checkout form -->
                <form method="post" action="">
                    <!-- Your form fields (e.g., order summary, payment options) go here -->
                    
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Your footer content goes here -->
    
    <!-- Your JavaScript and other script content goes here -->
</body>
</html>

<!--  Author Name: MH RONY.
GigHub Link: https://github.com/dev-mhrony
Facebook Link:https://www.facebook.com/dev.mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com  
Visit My Website : developerrony.com -->