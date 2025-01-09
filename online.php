<?php

$productPrices = [
    "Beyonce Concert" => 10.0,
    "Drake Concert" => 20.0,
];

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['customerName'];
    $email = $_POST['customerEmail'];
    $address = $_POST['customerAddress'];
    $phone = $_POST['customerPhone'];
    $zip = $_POST['customerZip'];
    $product1Qty = (int) $_POST['product1Qty'];
    $product2Qty = (int) $_POST['product2Qty'];
    $shipping = (float) $_POST['shippingMethod'];


    // Calculate money
    $product1Total = $product1Qty * $productPrices["Beyonce Concert"];
    $product2Total = $product2Qty * $productPrices["Drake Concert"];
    $subtotal = $product1Total + $product2Total;
    $grandTotal = $subtotal + $shipping;

    // Save data to file
    $file = fopen("store.txt", "a") or die("Unable to open file!");
    $record = "Name: $name, Email: $email, Address: $address, Phone: $phone, ZIP: $zip, Product 1 Qty: $product1Qty, Product 2 Qty: $product2Qty, Subtotal: $subtotal, Shipping: $shipping, Total: $grandTotal\n";
    fwrite($file, $record);
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store Receipt</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="receipt-container">
        <h1>Thank You for Your Purchase!</h1>
        <p>Your order has been successfully processed. Below is your receipt:</p>
        <hr>
        <h2>Receipt</h2>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><strong>ZIP:</strong> <?php echo $zip; ?></p>
        
        <p><strong>Beyonce Concert Quantity:</strong> <?php echo $product1Qty; ?></p>
        <p><strong>Drake Concert Quantity:</strong> <?php echo $product2Qty; ?></p>
        <p><strong>Subtotal:</strong> $<?php echo number_format($subtotal, 2); ?></p>
        <p><strong>Shipping:</strong> $<?php echo number_format($shipping, 2); ?></p>
        <p><strong>Total:</strong> $<?php echo number_format($grandTotal, 2); ?></p>
        <hr>
        <p>We hope you enjoy your purchase! Please visit again.</p>
    </div>
</body>
</html>
