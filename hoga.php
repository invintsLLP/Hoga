<?php



include 'hoga_config.php';

header("Access-Control-Allow-Origin: *");


if(isset($_POST) && !empty($_POST))
{

    $product_price = trim($_POST['price']['totalCost']);
    $product_title = trim($_POST['product_title']);
    //$product_name = $product_title.' '.'installation');

        $product = array(
                "product"=>array(
                "title"=> $product_title,
                "status"=> "active",
                "tags" => "draft",
                "variants"=>array(
                    array(  
                    "price" => $product_price
                    )
                )
                )
            );
    // Add new customer.
    $add_cus = add_new_customer($product);    
        }


// Add custome API(API version: 2020-10)
 function add_new_customer($product)
 {
     $data_string = json_encode($product);
     $url= API_URL ."/admin/api/2021-04/products.json";
        //   print_r($url);

     $ch = curl_init($url);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             'Content-Length: ' . strlen($data_string))
     );

     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $result = curl_exec($ch);
     curl_close($ch);

 	echo $result;
 }
 
?>	
