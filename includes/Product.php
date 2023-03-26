<?php

class Product{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "yoh_db";
	private $productTable = 'inventory_db';    
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}	
	public function cleanString($str){
		return str_replace(' ','_',$str);
	}
	public function getCategories() {		
		$sqlQuery = "
			SELECT TypeID, ItemType
			FROM ".$this->productTable." 
			GROUP BY ItemType";
        return  $this->getData($sqlQuery);
	}
	public function getTotalProducts () {
		$sql= "SELECT distinct ItemId FROM ".$this->productTable."  WHERE ItemQty != 0";
		if(isset($_POST['category']) && $_POST['category']!="") {
			$category = $_POST['category'];
			$sql.=" AND TypeID IN ('".implode("','",$category)."')";
		}
		if(isset($_POST['brand']) && $_POST['brand']!="") {
			$brand = $_POST['brand'];
			$sql.=" AND ItemDesc IN ('".implode("','",$brand)."')";
		}
		if(isset($_POST['material']) && $_POST['material']!="") {
			$material = $_POST['material'];
			$sql.=" AND ItemName IN ('".implode("','",$material)."')";
		}
		if(isset($_POST['size']) && $_POST['size']!="") {
			$size = $_POST['size'];
			$sql.=" AND ItemQty IN (".implode(',',$size).")";
		}		
		$productPerPage = 20;		
		$rowCount = $this->getNumRows($sql);
		$totalData = ceil($rowCount / $productPerPage);
		return $totalData;
	}		
	public function getProducts() {
		$productPerPage = 20;	
		$totalRecord  = strtolower(trim(str_replace("/","",$_POST['totalRecord'])));
		$start = ceil($totalRecord * $productPerPage);		
		$sql= "SELECT * FROM ".$this->productTable." WHERE ItemQty != 0";	
		if(isset($_POST['category']) && $_POST['category']!=""){			
			$sql.=" AND TypeId IN ('".implode("','",$_POST['category'])."')";
		}
		if(isset($_POST['brand']) && $_POST['brand']!=""){			
			$sql.=" AND ItemDesc IN ('".implode("','",$_POST['brand'])."')";
		}
		if(isset($_POST['material']) && $_POST['material']!="") {			
			$sql.=" AND ItemName IN ('".implode("','",$_POST['material'])."')";
		}		
		if(isset($_POST['size']) && $_POST['size']!="") {			
			$sql.=" AND ItemQty IN (".implode(',',$_POST['size']).")";
		}
		$sql.=" AND ItemName LIKE '%" . $_POST['searchValue'] . "%'";

		
		if(isset($_POST['sorting']) && $_POST['sorting']!="") {
			$sorting = implode("','",$_POST['sorting']);			
			if($sorting == 'newest' || $sorting == '') {
				$sql.=" ORDER BY ItemID DESC";
			} else if($sorting == 'low') {
				$sql.=" ORDER BY ItemPrice ASC";
			} else if($sorting == 'high') {
				$sql.=" ORDER BY ItemPrice DESC";
			}
		} else {
			$sql.=" ORDER BY ItemID";
		}		
		$sql.=" LIMIT $start, $productPerPage";	
		$products = $this->getData($sql);
		$rowcount = $this->getNumRows($sql);
		$productHTML = '';
		if(isset($products) && count($products)) {			
            foreach ($products as $key => $product) {	
				$productHTML .= '<div class="col-12 col-md-6 col-lg-4">
									<div class="clean-product-item">
										<a href="InventoryItem.php?id='.$product['ItemID'].'">
											<div class="image"><img class="img-fluid d-block mx-auto rounded" src="'.$product['ItemImg'].'" title="'.$product['ItemImg'].'" alt="'.$product['ItemImg'].'"></div>
										</a>
										<a href="InventoryItem.php?id='.$product['ItemID'].'" style="text-decoration: none;color:rgb(111,66,193); font-weight:bold;">
											<div class="product-name">'.$product['ItemName'].'</div>
										</a>
										<span class="badge" style="background-color:pink; border-color: pink; color:purple;">'.$product['ItemType'].'</span><hr>
									
										<div class="about">
											<a href="ReOrderPoint.php?id='.$product['ItemID'].'"><button class="btn btn-primary" type="button" style="background: indigo;border-color:indigo;width: 40px;"><i class="fas fa-shopping-bag"></i></button></a>
											<div class="price">
												<h6 style="font-weight:bold;"> PHP <span style="color:rgb(111,66,193);" >'.$product['ItemPrice'].'</h6>
												<h6 style="font-weight:bold;"> Quantity: <span style="color:rgb(111,66,193);" >'.$product['ItemQty'].'</h6>
											</div>
										</div>
									</div>
								</div>';
			}
		}
		return 	$productHTML;	
	}	
}
?>