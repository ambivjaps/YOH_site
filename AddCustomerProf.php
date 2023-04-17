<?php 
    session_start();

    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");
    access('USER');
    $user_data = check_login($con);

    require 'layouts/Header.php';

?>

<?php 
    if(isset($_POST['c_name'])) {
        $CID = $_SESSION['login_id'];

        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
        $c_label = mysqli_real_escape_string($con, $_POST['c_label']);

        $address = mysqli_real_escape_string($con, $_POST['address_1']).", ".mysqli_real_escape_string($con, $_POST['address_2']);
        $region = mysqli_real_escape_string($con, $_POST['region']);
        $city = mysqli_real_escape_string($con, $_POST['city']);

        $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
        $zip_code = mysqli_real_escape_string($con, $_POST['zip_code']);
        
        $sql = "SELECT * from cust_profile where c_id = $CID";
            $sql_run = mysqli_query($con, $sql);

        if ($sql_run && mysqli_num_rows($sql_run) < 3) {
             $user_data = mysqli_fetch_assoc($sql_run);
            if(empty($user_data['cust_status'])){
                 $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id, cust_status) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID', 1)";
                 $query_run = mysqli_query($con, $query);
             }else if($user_data['cust_status'] == 0){
                $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id, cust_status) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID', 1)";
                $query_run = mysqli_query($con, $query);
             }else{
        $query = "INSERT INTO cust_profile (c_id, c_name, c_label, address, region, city, phone_no, zip_code, login_id) VALUES ('$CID', '$c_name', '$c_label', '$address', '$region', '$city', '$phone_no', '$zip_code', '$CID')";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) {
            $_SESSION['c_name'] = $_POST['c_name'];
            $_SESSION['c_label'] = $_POST['c_label'];

            $_SESSION['region'] = $_POST['region'];
            $_SESSION['city'] = $_POST['city'];

            $_SESSION['phone_no'] = $_POST['phone_no'];
            $_SESSION['zip_code'] = $_POST['zip_code'];
 
            header("Location: ProfileAccntView.php");
            mysqli_close($con);
            
            exit();

        } else {
            echo "<script> alert('Problem occured.') </script>";
        }
    } 
    header("Location: ProfileAccntView.php");
    mysqli_close($con);
    
    exit();
 }else  if ($sql_run && mysqli_num_rows($sql_run) >= 3 ) {
    header("Location: ProfileAccntView.php?profile=error");
 }
}
?>
<head>
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Customer Profile | Yarn Over Hook </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/ProdListDesign.css.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <style>
        #myModal2 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }
        #myModal3 {
            display: none;
            position: fixed;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            top: 30%;
            width: 23%;
            background-color: #fee8e8;
            margin: auto;
            padding: 20px;
        }

        .modal-footer {
            border: none;
        }

        .modal-footer button {
            background-color: white;
            margin: 0 auto;
            border: none;
        }
    </style>
</head>


<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>
		
    <div class="container my-5">

        <h1 style="font-weight:bold;"> Add Profile <span><button class="btn btn-primary pull-right" type="button" style="font-weight:bold;border-color:indigo;background:indigo;width:40px;"><a href="ProfileAccntView.php" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i></a></button></span> </h1><hr>
        <div class="form-group">
            <form action="AddCustomerProf.php" method="POST" id="form">
                <div class="row my-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Label</label>
                        <input type="text" name="c_label" id="c_label" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Name</label>
                        <input type="text" name="c_name" id="c_name" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Address</label><br>
                        <label> House no./Lot no./Block no./Unit no., Street </label>
                        <input type="text" name="address_1" id="address_1" class="form-control rounded" required>
                        <label>Village/Subdivision, Building, Barangay</label>
                        <input type="text" name="address_2" id="address_2" class="form-control rounded" required>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">Region</label>
                            <select class="form-select rounded" name="region" id="region" required>
                                <option value="">Select Region</option>
                                <option value="I">I - Ilocos Region</option>
                                <option value="II">II - Cagayan Valley</option>
                                <option value="III">III - Central Luzon</option>
                                <option value="IVA">IV-A - CALABARZON</option>
                                <option value="IVB">IV-B - MIMAROPA</option>
                                <option value="V">V - Bicol Region</option>
                                <option value="VI">VI - Western Visayas</option>
                                <option value="VII">VII - Central Visayas</option>
                                <option value="VIII">VIII - Eastern Visayas</option>
                                <option value="IX">IX - Zamboanga Peninsula</option>
                                <option value="X">X - Northern Mindanao</option>
                                <option value="XI">XI - Davao Region</option>
                                <option value="XII">XII - SOCCSKSARGEN</option>
                                <option value="XIII">XIII - Caraga Region</option>
                                <option value="CAR">Cordillera Administrative Region (CAR)</option>
                                <option value="NCR">National Capital Region (NCR)</option>
                                <option value="BARMM">Bangsamoro Autonomous Region in Muslim Mindanao</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">City</label>
                        <select class="form-select rounded" name="city" id="city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label style="font-weight:bold;">ZIP Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control rounded" required>
                    </div>
                    <div class="col-md-12">
                        <label style="font-weight:bold;">Mobile Number</label>
                        <input type="text" name="phone_no" id="phone_no" minlength="11" maxlength="11" onkeypress="return restrictAlphabets(event)" class="form-control rounded" required>
                    </div>
                    <div class="button-group float-end">
                        <input class="btn btn-success mt-3" id="add-btn"  name="add_profile" value="Submit" style="width:150px;border-color:indigo;background-color:indigo;" readonly>
                        <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:150px;">
                    </div>
                </div>
            </form>
        </div>

        <div id="addModal" class="modal" style="display: none">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;">Are you sure you want to add this?</p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" onClick="addProfile()" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                    <button class="btn mt-3" onClick="closeModal()" style="border-color:red;background-color:red;font-weight:bold;color:white;width:100px;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="myModal3" class="modal">
            <div class="modal-content">
                <p style="text-align:center; font-weight: bold;color:red;font-size:32px;">Unable to save!</p>
                <p style="text-align:center;" id="error-message"></p>
                <div class="modal-footer">
                    <button class="btn btn-success mt-3" id="errorBtnClode" style="border-color:indigo;background-color:indigo;font-weight:bold;width:100px;">OK</button>
                </div>
            </div>
        </div>

    <script>
            document.getElementById('add-btn').addEventListener('click', (e) => {
            var modalError = document.getElementById("myModal3");
            var errorBtn = document.getElementById("errorBtnClode");
            
            errorBtn.onclick = function() {
                modalError.style.display = "none";
            }
            
            document.getElementById('add-btn').onclick = function() {
                let fields = {
                    'c_label': 'Label',
                    'c_name': 'Name',
                    'address_1': 'Address Line 1',
                    'address_2': 'Address Line 2',
                    'city': 'City',
                    'zip_code': 'Zip code',
                    'region': 'Region',
                    'phone_no': 'Phone Number',
                    
                }

                for (const key in fields) {
                    if (document.getElementsByName(key)[0].value.length === 0) {
                        document.getElementById('error-message').innerHTML = fields[key] + ' is required';
                        modalError.style.display = "block";
                        return;
                    }
                }
                
            e.preventDefault();
            document.getElementById('addModal').style.display = 'block';
        }});

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function addProfile() {
            
            document.getElementById("form").submit();
        }
    
        </script>

<script>
        // Define cities for each region
        var cities = {
            I: ["ILOCOS NORTE:", "Adams", "Bacarra", "Badoc", "Bangui", "Banna", "Batac", "Burgos", "Carasi", "Currimao", "Dingras", "Dumalneg", "Laoag", "Marcos", "Nueva Era", "Pagudpud", "Paoay", "Pasuquin", "Pinili", "San Nicolas", "Sarrat", "Solsona", "Vintar", 
            "ILOCOS SUR:", "Alilem", "Banayoyo", "Bantay", "Burgos", "Cabugao", "Candon", "Caoayan", "Cervantes", "Galgala", "Lidlidda", "Magsingal", "Nagbukel", "Narvacan", "Quirino", "Salcedo", "San Emilio", "San Esteban", "San Ildefonso", "San Juan", "San Vicente", "Santa", "Santiago", "Santo Domingo", "Sigay", "Sinait", "Sugpon", "Suyo", "Tagudin", "Vigan",
            "LA UNION:", "Agoo", "Aringay", "Bacnotan", "Bagulin", "Balaoan", "Bangar", "Bauang", "Burgos", "Caba", "Luna", "Naguilian", "Pugo", "Rosario", "San Fernando", "San Gabriel", "San Juan", "Santo Tomas", "Santol", "Sudipen", "Tubao", 
            "PANGASINAN:", "Agno", "Aguilar", "Alaminos", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dasol", "Infanta", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiztondo", "Villasis"],
            
            II: ["BATANES", "Basco", "Itbayat", "Ivana", "Mahatao", "Sabtang", "Uyugan",
            "CAGAYAN", "Abulug", "Alcala", "Allacapan", "Amulung", "Aparri", "Baggao", "Ballesteros", "Buguey", "Calayan", "Camalaniugan", "Claveria", "Enrile", "Gattaran", "Gonzaga", "Iguig", "Lal-lo", "Lasam", "Pamplona", "Penablanca", "Piat", "Rizal", "Sanchez-Mira", "Santa Ana", "Santa Praxedes", "Santa Teresita", "Santo Nino", "Solana", "Tuao", "Tuguegarao City",
            "ISABELA", "Alicia", "Angadanan", "Aurora", "Benito Soliven", "Burgos", "Cabagan", "Cabatuan", "Cauayan City", "Cordon", "Delfin Albano", "Dinapigue", "Divilacan", "Echague", "Gamu", "Ilagan City", "Jones", "Luna", "Maconacon", "Mallig", "Naguilian", "Palanan", "Quezon", "Quirino", "Ramon", "Reina Mercedes", "Roxas", "San Agustin", "San Guillermo", "San Isidro", "San Manuel", "San Mariano", "San Mateo", "San Pablo", "Santa Maria", "Santiago City", "Santo Tomas", "Tumauini", 
            "NUEVE VIZCAYA", "Alfonso Castaneda", "Ambaguio", "Aritao", "Bagabag", "Bambang", "Bayombong", "Diadi", "Dupax del Norte", "Dupax del Sur", "Kasibu", "Kayapa", "Quezon", "Santa Fe", "Solano", "Villaverde",
            "QUIRINO", "Aglipay", "Cabarroguis", "Diffun", "Maddela", "Nagtipunan", "Saguday"],
            
            III: ["AURORA:", "Alfonso Castaneda", "Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis",
            "BATAAN:", "Abucay", "Bagac", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Pilar", "Samal",
            "BULACAN:", "Angat", "Balagtas", "Baliuag", "Bocaue", "Bulacan", "Bustos", "Calumpit", "Dona Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos", "Marilao", "Meycauayan", "Norzagaray", "Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose del Monte", "San Miguel", "San Rafael", "Santa Maria",
            "NUEVA ECIJA:", "Aliaga", "Bongabon", "Cabanatuan", "Cabiao", "Carranglan", "Cuyapo", "Gabaldon", "General Mamerto Natividad", "General Tinio", "Guimba", "Jaen", "Laur", "Licab", "Llanera", "Lupao", "Nampicuan", "Palayan", "Pantabangan", "Penaranda", "Quezon", "Rizal", "San Antonio", "San Isidro", "San Jose", "San Leonardo", "Santa Rosa", "Santo Domingo", "Talavera", "Talugtug", "Zaragoza",
            "PAMPANGA:", "Apalit", "Arayat", "Bacolor", "Candaba", "Floridablanca", "Guagua", "Lubao", "Mabalacat", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando", "San Luis", "San Simon", "Santa Ana", "Santa Rita", "Santo Tomas", "Sasmuan",
            "TARLAC:", "Anao", "Bamban", "Camiling", "Capas", "Concepcion", "Gerona", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Manuel", "Santa Ignacia", "Tarlac City", "Victoria",
            "ZAMBALES:", "Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc", "Olongapo", "Palauig", "San Antonio", "San Felipe", "San Marcelino", "San Narciso", "Santa Cruz", "Subic"],
            
            IVA: ["BATANGAS:","Balete", "Batangas City", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa City", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan City", "Taysan", "Tingloy", "Tuy",
            "CAVITE:","Alfonso", "Amadeo", "Bacoor City", "Carmona", "Cavite City", "Dasmarinas City", "Gen. Emilio Aguinaldo", "Gen. Mariano Alvarez", "Imus City", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay City", "Tanza", "Ternate", "Trece Martires City",
            "LAGUNA:","Alaminos", "Bay", "Binan City", "Cabuyao City", "Calamba City", "Calauan", "Cavinti", "Famy", "Kalayaan", "Liliw", "Los Banos", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Majayjay", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo City", "San Pedro City", "Santa Cruz", "Santa Maria", "Santa Rosa City", "Siniloan", "Sta. Maria", "Sta. Rosa", "Victoria",
            "QUEZON:","Agdangan", "Alabat", "Atimonan", "Buenavista", "Burdeos", "Calauag", "Candelaria", "Catanauan", "Dolores", "General Luna", "General Nakar", "Guinayangan", "Gumaca", "Infanta", "Jomalig", "Lopez", "Lucban", "Lucena City", "Macalelon", "Mauban", "Mulanay", "Padre Burgos", "Pagbilao", "Panukulan", "Patnanungan", "Perez", "Pitogo", "Plaridel", "Polillo", "Quezon", "Real", "Sampaloc", "San Andres", "San Antonio", "San Francisco", "San Narciso", "Sariaya", "Tagkawayan", "Tayabas City", "Tiaong", "Unisan",
            "RIZAL:","Angono", "Baras", "Binangonan", "Cainta", "Cardona", "Jalajala", "Morong", "Pililla", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
            
            IVB: ["PALAWAN", "Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza", "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion", "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan", "Magsaysay", "Narra", "Quezon", "Rizal", "Roxas", "San Vicente", "Sofronio Espanola", "Taytay",
            "MARINDUQUE", "Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos",
            "ROMBLON", "Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion", "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", "Romblon", "San Agustin", "San Andres", "San Fernando", "San Jose", "Santa Fe", "Santa Maria",
            "MINDORO OCCIDENTAL", "Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz",
            "MINDORO ORIENTAL", "Baco", "Bansud", "Bongabong", "Bulalacao", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
            
            V: ["ALBAY:", "Barcelona", "Daraga", "Guinobatan", "Jovellar", "Legazpi City", "Libon", "Ligao City", "Malilipot", "Malinao", "Manito", "Oas", "Pio Duran", "Polangui", "Rapu-Rapu", "Santo Domingo", "Tabaco City", "Tiwi",
            "CAMARINES NORTE:", "Basud", "Capalonga", "Daet", "Jose Panganiban", "Labo", "Mercedes", "Paracale", "San Lorenzo Ruiz", "San Vicente", "Santa Elena", "Talisay", "Vinzons",
            "CAMARINES SUR:", "Baao", "Balatan", "Bato", "Bombon", "Buhi", "Bula", "Cabusao", "Calabanga", "Camaligan", "Canaman", "Caramoan", "Del Gallego", "Gainza", "Garchitorena", "Goa", "Iriga City", "Lagonoy", "Libmanan", "Lupi", "Magarao", "Milaor", "Minalabac", "Nabua", "Naga City", "Ocampo", "Pamplona", "Pasacao", "Pili", "Presentacion", "Ragay", "Sagnay", "San Fernando", "San Jose", "Sipocot", "Siruma", "Tigaon", "Tinambac",
            "CATANDUANES:", "Bagamanoc", "Baras", "Bato", "Caramoran", "Gigmoto", "Pandan", "Panganiban", "San Andres", "San Miguel", "Viga", "Virac",
            "MASBATE:", "Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson",
            "SORSOGON:", "Barcelona", "Bulan", "Bulusan", "Casiguran", "Castilla", "Donsol", "Gubat", "Irosin", "Juban", "Magallanes", "Matnog", "Pilar", "Prieto Diaz", "Santa Magdalena", "Sorsogon City"],
            
            VI: ["AKLAN:", "Altavas", "Balete", "Banga", "Batan", "Buruanga", "Ibajay", "Kalibo", "Lezo", "Libacao", "Madalag", "Makato", "Malay", "Malinao", "Nabas", "New Washington", "Numancia", "Tangalan",
            "ANTIQUE:", "Anini-y", "Barbaza", "Belison", "Bugasong", "Caluya", "Culasi", "Hamtic", "Laua-an", "Libertad", "Pandan", "Patnongon", "San Jose", "San Remigio", "Sebaste", "Sibalom", "Tibiao", "Tobias Fornier", "Valderrama",
            "CAPIZ:", "Cuartero", "Dao", "Dumalag", "Dumarao", "Ivisan", "Jamindan", "Maayon", "Mambusao", "Panay", "Panitan", "Pilar", "Pontevedra", "President Roxas", "Roxas City", "Sapian", "Sigma", "Tapaz",
            "GUIMARAS:",  "Buenavista", "Jordan", "Nueva Valencia", "San Lorenzo", "Sibunag",
            "ILOILO:","Ajuy", "Alimodian", "Anilao", "Badiangan", "Balasan", "Banate", "Barotac Nuevo", "Barotac Viejo", "Batad", "Bingawan", "Cabatuan", "Calinog", "Carles", "Concepcion", "Dingle", "Duenas", "Dumangas", "Estancia", "Guimbal", "Igbaras", "Iloilo City", "Janiuay", "Lambunao", "Leganes", "Lemery", "Leon", "Maasin", "Miagao", "Mina", "New Lucena", "Oton", "Passi City", "Pavia", "Pototan", "San Dionisio", "San Enrique", "San Joaquin", "San Miguel", "San Rafael", "Santa Barbara", "Sara", "Tigbauan", "Tubungan", "Zarraga",
            "NEGROS OCCIDENTAL", "Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Don Salvador Benedicto", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"],
            
            VII: ["BOHOL:","Alburquerque", "Alicia", "Anda", "Antequera", "Baclayon", "Balilihan", "Batuan", "Bien Unido", "Bilar", "Buenavista", "Calape", "Candijay", "Carmen", "Catigbian", "Clarin", "Corella", "Cortes", "Dagohoy", "Danao", "Dauis", "Dimiao", "Duero", "Garcia Hernandez", "Getafe", "Guan", "Inabanga", "Jagna", "Lila", "Loay", "Loboc", "Loon", "Mabini", "Maribojoc", "Panglao", "Pilar", "Pres. Carlos P. Garcia", "Sagbayan", "San Isidro", "San Miguel", "Sevilla", "Sierra Bullones", "Sikatuna", "Tagbilaran City", "Talibon", "Trinidad", "Tubigon", "Ubay", "Valencia",
            "CEBU:","Alcantara", "Alcoy", "Alegria", "Aloguinsan", "Argao", "Asturias", "Badian", "Balamban", "Bantayan", "Barili", "Bogo City", "Boljoon", "Borbon", "Carcar City", "Carmen", "Catmon", "Cebu City", "Compostela", "Consolacion", "Cordova", "Daanbantayan", "Dalaguete", "Danao City", "Dumanjug", "Ginatilan", "Lapu-Lapu City", "Liloan", "Madridejos", "Malabuyoc", "Mandaue City", "Medellin", "Minglanilla", "Moalboal", "Naga City", "Oslob", "Pilar", "Pinamungajan", "Poro", "Ronda", "Samboan", "San Fernando", "San Francisco", "San Remigio", "Santa Fe", "Santander", "Sibonga", "Sogod", "Tabogon", "Tabuelan", "Talisay City", "Toledo City", "Tuburan", "Tudela",
            "NEGROS ORIENTAL:", "Amlan", "Ayungon", "Bacong", "Bais City", "Basay", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita",
            "SIQUIJOR:","Enrique Villanueva", "Larena", "Lazi", "Maria", "San Juan", "Siquijor"],
            
            
            VIII: ["BILIRAN:", "Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi",
            "EASTERN SAMAR:","Arteche", "Balangiga", "Balangkayan", "Borongan", "Can-avid", "Dolores", "General MacArthur", "Giporlos", "Guiuan", "Hernani", "Jipapad", "Lawaan", "Llorente", "Maslog", "Maydolong", "Mercedes", "Oras", "Quinapondan", "Salcedo", "San Julian", "San Policarpo", "Sulat", "Taft",
            "LEYTE:","Abuyog", "Alangalang", "Albuera", "Babatngon", "Barugo", "Bato", "Baybay", "Burauen", "Calubian", "Capoocan", "Carigara", "Dagami", "Dulag", "Hilongos", "Hindang", "Inopacan", "Isabel", "Jaro", "Javier", "Julita", "Kananga", "La Paz", "Leyte", "MacArthur", "Mahaplag", "Matag-ob", "Matalom", "Mayorga", "Merida", "Ormoc", "Palo", "Palompon", "Pastrana", "San Isidro", "San Miguel", "Santa Fe", "Tabango", "Tabontabon", "Tacloban", "Tanauan", "Tolosa", "Tunga", "Villaba",
            "NORTHERN SAMAR:","Allen", "Biri", "Bobon", "Capul", "Catarman", "Catubig", "Gamay", "Laoang", "Lapinig", "Las Navas", "Lavezares", "Lope de Vega", "Mapanas", "Mondragon", "Palapag", "Pambujan", "Rosario", "San Antonio", "San Isidro", "San Jose", "San Roque", "San Vicente", "Silvino Lobos", "Victoria",
            "SAMAR:","Basey", "Calbiga", "Daram", "Gandara", "Hinabangan", "Jiabong", "Marabut", "Matuguinao", "Motiong", "Pagsanghan", "Paranas", "Pinabacdao", "San Jorge", "San Jose de Buan", "San Sebastian", "Santa Margarita", "Santa Rita", "Santo Nino", "Tagapul-an", "Talalora", "Tarangnan", "Villareal", "Zumarraga",
            "SOUTHERN LEYTE:","Anahawan", "Bontoc", "Hinundayan", "Hinunangan", "Libagon", "Liloan", "Limasawa", "Maasin", "Macrohon", "Malitbog", "Padre Burgos", "Pintuyan", "Saint Bernard", "San Francisco", "San Juan", "San Ricardo", "Silago", "Sogod", "Tomas Oppus"],
            
            IX: ["ZAMBOANGA DEL NORTE:", "Baliguian", "Dapitan City", "Dipolog City", "Godod", "Gutalac", "Jose Dalman", "Kalawit", "Katipunan", "La Libertad", "Labason", "Liloy", "Manukan", "Mutia", "Pinan", "Polanco", "Pres. Manuel A. Roxas", "Rizal", "Salug", "Sergio Osmena Sr.", "Siayan", "Sibuco", "Sibutad", "Sindangan", "Sirawai", "Tampilisan",
            "ZAMBOANGA DEL SUR:", "Aurora", "Bayog", "Dimataling", "Dinas", "Dumalinao", "Dumingag", "Goddess", "Guipos", "Josefina", "Kumalarang", "Lakewood", "Lapuyan", "Mahayag", "Margosatubig", "Midsalip", "Molave", "Pagadian City", "Pitogo", "Ramon Magsaysay", "San Miguel", "San Pablo", "Sominot", "Tabina", "Tambulig", "Tigbao", "Tukuran", "Vincenzo A. Sagun",
            "ZAMBOANGA SIBUGAY:", "Alicia", "Buug", "Diplahan", "Imelda", "Ipil", "Kabasalan", "Mabuhay", "Malangas", "Naga", "Olutanga", "Payao", "Roseller Lim", "Siay", "Talusan", "Titay", "Tungawan"],
            
            X: ["BUKIDNON:", "Cabanglasan", "Damulog", "Dangcagan", "Don Carlos", "Impasug-ong", "Kadingilan", "Kalilangan", "Kibawe", "Kitaotao", "Lantapan", "Libona", "Malaybalay", "Malitbog", "Manolo Fortich", "Maramag", "Pangantucan", "Quezon", "San Fernando", "Sumilao", "Talakag", "Valencia City",
            "CAMIGUIN", "Catarman", "Guinsiliban", "Mahinog", "Mambajao", "Sagay",
            "LANAO DEL NORTE:","Baloi", "Baroy", "Iligan City", "Kapatagan", "Kauswagan", "Kolambugan", "Lala", "Linamon", "Magsaysay", "Maigo", "Matungao", "Munai", "Nunungan", "Pantao Ragat", "Pantar", "Poona Piagapo", "Salvador", "Sapad", "Sultan Naga Dimaporo", "Tagoloan", "Tangcal", "Tubod",
            "MISAMIS OCCIDENTAL:","Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Don Victoriano Chiongbian", "Jimenez", "Lopez Jaena", "Oroquieta City", "Ozamiz City", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub City", "Tudela",
            "MISAMIS ORIENTAL:", "Alubijid", "Balingasag", "Balingoan", "Binuangan", "Cagayan de Oro City", "Claveria", "El Salvador City", "Gingoog City", "Gitagum", "Initao", "Jasaan", "Kinita-an", "Kinoguitan", "Lagonglong", "Laguindingan", "Libertad", "Lugait", "Magsaysay", "Manticao", "Medina", "Naawan", "Opol", "Salay", "Sugbongcogon", "Tagoloan", "Talisayan", "Villanueva"],
            
            XI: ["DAVAO DEL NORTE:","Asuncion", "Braulio E. Dujali", "Carmen", "Kapalong", "New Corella", "Panabo City", "Samal City", "San Isidro", "Santo Tomas", "Tagum City", "Talaingod",
            "DAVAO DEL SUR:", "Bansalan", "Davao City", "Digos City", "Don Marcelino", "Hagonoy", "Jose Abad Santos", "Kiblawan", "Magsaysay", "Malalag", "Matanao", "Padada", "Santa Cruz", "Santa Maria", "Sarangani", "Sulop",
            "DAVAO OCCIDENTAL:", "Don Marcelino", "Jose Abad Santos", "Malita", "Santa Maria", "Sarangani",
            "DAVAO ORIENTAL:", "Baganga", "Banaybanay", "Boston", "Caraga", "Cateel", "Governor Generoso", "Lupon", "Manay", "Mati City", "San Isidro", "Tarragona"],
            
            XII: ["SULTAN KUDARAT:","Bagumbayan", "Columbio", "Esperanza", "Isulan", "Kalamansig", "Lambayong", "Lebak", "Lutayan", "Palimbang", "President Quirino", "Senator Ninoy Aquino",
            "SOUTH COTABATO:", "Banga", "General Santos", "Koronadal", "Lake Sebu", "Norala", "Polomolok", "Santo Nino", "Surallah", "T'boli", "Tampakan", "Tantangan", "Tupi",
            "SARANGANI:", "Alabel", "Glan", "Kiamba", "Maasim", "Maitum", "Malapatan",
            "COTABATO:", "Alamada", "Aleosan", "Antipas", "Arakan", "Banisilan", "Carmen", "Kabacan", "Kidapawan", "Libungan", "M'lang", "Magpet", "Makilala", "Matalam", "Midsayap", "Pigkawayan", "Pikit", "President Roxas", "Tulunan"],
            
            XIII: ["AGUSAN DEL NORTE:","Buenavista", "Cabadbaran", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay",
            "AGUSAN DEL SUR:","Bayugan", "Bunawan", "Esperanza", "La Paz", "Loreto", "Prosperidad", "Rosario", "San Francisco", "San Luis", "Santa Josefa", "Sibagat", "Talacogon", "Trento", "Veruela",
            "DINAGAT ISLANDS:", "Basilisa", "Cagdianao", "Dinagat", "Libjo", "Loreto", "San Jose", "Tubajon",
            "SURIGAO DEL NORTE:", "Alegria", "Bacuag", "Burgos", "Claver", "Dapa", "Del Carmen", "General Luna", "Gigaquit", "Mainit", "Malimono", "Pilar", "Placer", "San Benito", "San Francisco", "San Isidro", "Santa Monica", "Sison", "Socorro", "Surigao City", "Tagana-an", "Tubod",
            "SURIGAO DEL SUR:", "Barobo", "Bayabas", "Bislig", "Cagwait", "Cantilan", "Carmen", "Carrascal", "Cortes", "Hinatuan", "Lanuza", "Lianga", "Lingig", "Madrid", "Marihatag", "San Agustin", "San Miguel", "Tagbina", "Tago", "Tandag"],
            
            CAR: ["ABRA:","Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Penarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa",
            "APAYAO:","Calanasan", "Conner", "Flora", "Kabugao", "Luna", "Pudtol", "Santa Marcela",
            "BENGUET:", "Atok", "Baguio City", "Bakun", "Bokod", "Buguias", "Itogon", "Kabayan", "Kapangan", "Kibungan", "La Trinidad", "Mankayan", "Sablan", "Tuba", "Tublay",
            "IFUGAO:", "Aguinaldo", "Alfonso Lista", "Asipulo", "Banaue", "Hingyon", "Hungduan", "Kiangan", "Lagawe", "Lamut", "Mayoyao", "Tinoc",
            "KALINGA:", "Balbalan", "Lubuagan", "Pasil", "Pinukpuk", "Rizal", "Tabuk City", "Tanudan", "Tinglayan",
            "MOUNTAIN PROVINCE:","Barlig", "Bauko", "Besao", "Bontoc", "Natonin", "Paracelis", "Sabangan", "Sadanga", "Sagada", "Tadian"],
            
            NCR: ["Caloocan", "Las Pinas", "Makati", "Malabon", "Mandaluyong", "Manila", "Marikina", "Muntinlupa", " Navotas", "Paranaque", "Pasay", "Pasig", "Pareros", "Quezon City", "San Juan", "Taguig", "Valenzuela"],
            
            BARMM: ["MAGUINDANAO:", "Barira", "Buldon", "Datu Abdullah Sangki", "Datu Anggal Midtimbang", "Datu Blah T. Sinsuat", "Datu Hoffer Ampatuan", "Datu Montawal", "Datu Odin Sinsuat", "Datu Paglas", "Datu Piang", "Datu Salibo", "Datu Saudi-Ampatuan", "Datu Unsay", "Gen. S. K. Pendatun", "Guindulungan", "Kabuntalan", "Mamasapano", "Mangudadatu", "Matanog", "Northern Kabuntalan", "Pagalungan", "Paglat", "Pandag", "Parang", "Rajah Buayan", "Shariff Aguak", "Shariff Saydona Mustapha", "Sultan Kudarat", "Sultan Mastura", "Sultan sa Barongis", "Sultan Sumagka", "Talayan", "South Upi", "Upi",
            "LANAO DEL SUR:", "Bacolod-Kalawi", "Balabagan", "Balindong", "Bayang", "Binidayan", "Buadiposo-Buntong", "Bubong", "Butig", "Calanogas", "Ditsaan-Ramain", "Ganassi", "Kapai", "Lumba-Bayabao", "Lumbaca-Unayan", "Lumbatan", "Lumbayanague", "Madalum", "Madamba", "Maguing", "Malabang", "Marantao", "Marawi", "Marogong", "Masiu", "Mulondo", "Pagayawan", "Piagapo", "Poona Bayabao", "Pualas", "Saguiaran", "Sultan Dumalondong", "Tagoloan II", "Tamparan", "Tubaran", "Tugaya", "Wao",
            "BASILAN:", "Akbar", "Al-Barka", "Barira", "Basilan", "Hadji Mohammad Ajul", "Hadji Muhtamad", "Isabela City", "Lamitan", "Lantawan", "Maluso", "Sumisip", "Tabuan-Lasa", "Tipo-Tipo", "Tuburan", "Ungkaya Pukan",
            "SULU:", "Hadji Panglima Tahil", "Indanan", "Jolo", "Kalingalan Caluang", "Lugus", "Luuk", "Maimbung", "Old Panamao", "Pandami", "Panglima Estino", "Pangutaran", "Parang", "Pata", "Patikul", "Siasi", "Talipao", "Tapul",
            "TAWI-TAWI:","Bongao", "Candiis", "Languyan", "Mapun", "Panglima Sugala", "Sapa-Sapa", "Sibutu", "Simunul", "Sitangkai", "South Ubian", "Tandubas", "Turtle Islands"]
        };

        // Update city options based on selected region
        $("#region").on("change", function() {
            var selectedRegion = $(this).val();
            var citySelect = $("#city");
            citySelect.empty();
            citySelect.append('<option value="">Select City</option>');
            if (selectedRegion !== "") {
                var regionCities = cities[selectedRegion];
                $.each(regionCities, function(index, city) {
                    citySelect.append('<option value="' + city + '">' + city + '</option>');
                });
            }
        });
</script>
    
<script>

        function restrictAlphabets(e){
            var x = e.which || e.keycode;
            if((x >= 48 & x <= 57))
                return true;
            else
                return false;
        }

        </script>
    
      
        
<?php require 'layouts/Footer.php';?>