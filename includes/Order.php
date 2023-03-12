<?php
class Order{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "yoh_db";
	private $orderTable = 'orders_db';    
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
			SELECT TypeID, OrderType
			FROM ".$this->orderTable."
			GROUP BY OrderType";
        return  $this->getData($sqlQuery);
    }
    
    public function getTotalOrders () {
        $sql= "SELECT distinct OrderID FROM ".$this->orderTable."  WHERE order_qty != 0";
        if(isset($_POST['category']) && $_POST['category']!="") {
            $category = $_POST['category'];
            $sql.=" AND TypeID IN ('".implode("','",$category)."')";
        }
        if(isset($_POST['material']) && $_POST['material']!="") {
            $material = $_POST['material'];
            $sql.=" AND ItemName IN ('".implode("','",$material)."')";
        }
        if(isset($_POST['size']) && $_POST['size']!="") {
            $size = $_POST['size'];
            $sql.=" AND ItemPrice IN (".implode(',',$size).")";
        }
        $orderPerPage = 20;
        $rowCount = $this->getNumRows($sql);
        $totalData = ceil($rowCount / $orderPerPage);
        return $totalData;
    }
    public function getOrders() {
        $orderPerPage = 20;
        $totalRecord  = strtolower(trim(str_replace("/","",$_POST['totalRecord'])));
        $start = ceil($totalRecord * $orderPerPage);
        $sql= "SELECT * FROM ".$this->orderTable." WHERE order_qty != 0";
        if(isset($_POST['category']) && $_POST['category']!=""){
            $sql.=" AND TypeID IN ('".implode("','",$_POST['category'])."')";
        }
        if(isset($_POST['material']) && $_POST['material']!="") {
            $sql.=" AND OrderName IN ('".implode("','",$_POST['material'])."')";
        }
        if(isset($_POST['size']) && $_POST['size']!="") {
            $sql.=" AND ItemPrice IN (".implode(',',$_POST['size']).")";
        }
        
        if(isset($_POST['sorting']) && $_POST['sorting']!="") {
            $sorting = implode("','",$_POST['sorting']);
            if($sorting == 'newest' || $sorting == '') {
                $sql.=" ORDER BY OrderID DESC";
            } else if($sorting == 'low') {
                $sql.=" ORDER BY ItemPrice ASC";
            } else if($sorting == 'high') {
                $sql.=" ORDER BY ItemPrice DESC";
            }
        } else {
            $sql.=" ORDER BY OrderID DESC";
        }
        $sql.=" LIMIT $start, $orderPerPage";
        $orders = $this->getData($sql);
        $rowcount = $this->getNumRows($sql);
        $orderHTML = '';
        if(isset($orders) && count($orders)) {
            foreach ($orders as $key => $order) {
                
                $orderHTML .= '<div class="col-12 col-md-6 col-lg-4">
									<div class="clean-product-item">
										<a href="OrderPageAdmin.php?id='.$order['OrderID'].'">
											<div class="image"><img class="img-fluid d-block mx-auto rounded" src="" title="" alt=""></div>
										</a>
                                        
										<a href="OrderPageAdmin.php?id='.$order['OrderID'].'" style="text-decoration: none;">
											<div class="product-name"></div>
                                            
										</a>
										<span class="badge bg-dark">'.$order['OrderType'].'</span><hr>
									
										<div class="about">
                                        <a href="OrderPageAdmin.php" class="btn btn-primary" type="button" style="font-weight: bold;background: rgb(119,13,253);border-color: var(--bs-purple);width: 40px;"><i class="far fa-edit" style="text-align: center;"></i></a>
										
                                        <h6>Php 200</h6>
                                        <div class="price">
                                        <h6>Quantity: '.$order['OrderQty'].'</h6>
                                        </div>
                                        <button id="myBtn" class="btn btn-primary" type="button" style="font-weight: bold;background: var(--bs-red);width: 40px;margin-left: 4px;border-color: var(--bs-red);"><i class="fas fa-trash" style="text-align: center;"></i></button></div>	
                                        <div class="price">
											</div>
										</div>
									</div>
								</div>
                             
                                <script> 
                var modal = document.getElementById("myModal");
            
                var btn = document.getElementById("myBtn");
            
                var yesBtn = document.getElementById("yesBtn");
            
                var noBtn = document.getElementById("noBtn");
            
                var yesModal = document.getElementById("yesMess");
            
                var span = document.getElementsByClassName("close1")[0];
            
                var span1 = document.getElementsByClassName("close2")[0];
            
                btn.onclick = function() {
                modal.style.display = "block";
                }
            
                btn2.onclick = function() {
                modal.style.display = "block";
                }
            
                btn3.onclick = function() {
                modal.style.display = "block";
                }
            
                btn4.onclick = function() {
                modal.style.display = "block";
                }
            
                btn5.onclick = function() {
                modal.style.display = "block";
                }
            
                btn6.onclick = function() {
                modal.style.display = "block";
                }
            
                btn7.onclick = function() {
                modal.style.display = "block";
                }
            
                btn8.onclick = function() {
                modal.style.display = "block";
                }
            
                btn9.onclick = function() {
                modal.style.display = "block";
                }
            
                span.onclick = function() {
                modal.style.display = "none";
                }
            
                span1.onclick = function() {
                    yesModal.style.display = "none";
                }
            
                yesBtn.onclick = function() {
                    modal.style.display = "none";
                    yesModal.style.display = "block";
                }
            
                noBtn.onclick = function() {
                    modal.style.display = "none";
                }
            
                window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                }
                </script>';
			}
		}
		return 	$orderHTML;	
	}	
}
?>