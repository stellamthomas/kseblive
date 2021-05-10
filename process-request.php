<?php
if(isset($_POST["district"])){
    // Capture selected country
    $country = $_POST["district"];

    // Define country and city array
    $countryArr = array(
                    "Alapuzha" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Ernakulam" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Idukki" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Kannur" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Kasargode" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Kollam" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Kottayam" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Kozhikode" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Malappuram" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Palakkad" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Pathanmthitta" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Thiruvananthapuram" => array("--Select--","Alangad [5737]", "Aluva North [5568]"),
                    "Thrissur" => array("--Select--","Alapuzha North [5501]", "Alapuzha South [5503]", "Alapuzha Town [5502]"),
                    "Wayanad" => array("--Select--","Alangad [5737]", "Aluva North [5568]")
                );

    // Display city dropdown based on country name
    if($country !== 'Select'){
        foreach($countryArr[$country] as $value){
            echo "<option value='.$value.'>". $value . "</option>";
        }
    }
}
?>
