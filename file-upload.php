<?php


require_once('includes/classes/Database.php');
require_once('includes/classes/College.php');

//Open csv file
$csv_file = fopen('ambassadors-pooja-akhil.csv', 'r');

$current_row = 0;

session_start();
$_SESSION['data'] = array();
$result_array = array();

$correct_records = 0;

while (($data = fgetcsv($csv_file, 1000, ",")) !== FALSE) 
{
    
    if($current_row!=0) {

        $college_name = Database::escaped_string($data[0]); //Work on it
        $name = $data[2];
        $number = $data[3];
        $email = $data[4];
        $financial_year = $data[5];
        $owner = $data[6];




        $college_id = College::find('name', $college_name);


       ?><p>Row : <?php echo $current_row; ?></p><?php

        if(!$college_id) {
            ?>
            <p>College '<?php echo $college_name; ?>'  has no entry in database. Please correct it</p>
            <?php
           
            $colleges = College::all();
            ?><select class="setCollege"><?php
            foreach($colleges as $college){
                ?><option value="<?php echo $college['id']; ?>"><?php echo $college['name']; ?></option><?php

            }
            ?></select>
            <button>SAVE</button>
            <button>CREATE NEW COLLEGE</button>
            <?php
            // die("<br>Fix above problem");
        break;  

        }else {


            $correct_records++;


            $college_id = $college_id[0]['id'];
            $record = array();
            $record['name'] = $name;
            $record['email'] = $email;
            $record['number'] = $number;
            $record['financial_year'] = $financial_year;
            $record['owner'] = $owner;
            $record['college_id'] = $college_id;
            // $result_array[] = $record;

            $_SESSION['data'][] = $record;



            echo "Record inserted in array";


        }


        



        // $is_inserted = Ambassador::save(array(
        //     "name"=>$name,
        //     "email"=>$email,
        //     "number"=>$number,
        //     "year_of_graduation"=>$year_of_graduation,
        //     "financial_year"=>$financial_year,
        //     "postal_address"=>$postal_address,
        //     "status"=>$status,
        //     "college_id"=>$college_id
        // ));

    }
    ?><br><?php

    $current_row++;

    
    
}

fclose($csv_file);



echo "<br>======================================================================================================================================";
echo "Number of correct records: ".$correct_records;

echo "<br>";
echo "Result<br>";

print_r($_SESSION['data']);




?>



<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $('.setCollege').each(function(){

            $(this).on('change',function(){
                var new_value = $(this).val();
                // console.log("Hey i am solving that issue");
                console.log(new_value);
            });


        });

    });


</script>