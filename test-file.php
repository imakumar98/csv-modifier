<?php

require_once('includes/classes/Database.php');
require_once('includes/classes/College.php');



session_start();

$ambassadors = $_SESSION['data'];


$i = 0;


foreach($ambassadors as $ambassador) {

    $college_name = $ambassador[0];

    $college_name = Database::escaped_string(trim($college_name));

    if(!empty($college_name)){

        $college_id = College::find('name', $college_name);

        $college_id = $college_id[0]['id'];

        if($college_id) {


            $name = ucfirst(Database::escaped_string($ambassador[2]));
            $email = Database::escaped_string($ambassador[4]);
            $number = Database::escaped_string($ambassador[3]);
            $college_id = $college_id;
            $lead_owner = Database::escaped_string($ambassador[6]);
            $financial_year = Database::escaped_string($ambassador[5]);

            
            echo "INSERT INTO ambassador (name, email, number, college_id, lead_owner, financial_year) VALUES ('$name', '$email', '$number', '$college_id', '$lead_owner', '$financial_year');"."<br>";

        }else {

            ?>
            <h3>Row Number: <?php echo $i+1; ?></h3>
            <p>College '<?php echo $college_name; ?>'  has no entry in database. Please correct it, name is : <?php echo $ambassador[2]; ?></p>
            <?php
            
            $colleges = College::college_by_name();
            ?><select class="setCollege" data-college-name="<?php echo $college_name; ?>" data-ambassador-index="<?php echo  $i; ?>"><?php
            foreach($colleges as $college){
                ?><option value="<?php echo $college['name']; ?>"><?php echo $college['name']; ?></option><?php

            }
            ?></select>
            <!-- <button>SAVE</button> -->
            <br>
            <p>CREATE NEW COLLEGE</p>
            
            <div class="create-new-college">
                <input type="text" name="college_name"/>
                <button type="button" class="add-college-button" data-ambassador-index="<?php echo $i; ?>">SAVE</button>
            </div>
            <br><br>
            <p>=======================================================================================================================================================</p>
            <?php

        }


    }

    



    $i++;

    



}








?>



<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $('.setCollege').each(function(){

            $(this).on('change',function(){
                var new_college_name = $(this).val();
                var index = $(this).attr('data-ambassador-index');
                
                $.ajax({
                    url:'test2.php',
                    type: 'POST',
                    data: 'college_name=' + new_college_name + '&index=' + index,
                    success: function(response) {
                        console.log(response);
                        window.location.href = 'test-file.php';
                    }
                });
            });


        });

        $('.add-college-button').each(function(){

            $(this).on('click',function(){
                var new_college_name = $(this).prev().val();


                var index = $(this).attr('data-ambassador-index');


                console.log(new_college_name);

                console.log(index);
                
                $.ajax({
                    url:'test3.php',
                    type: 'POST',
                    data: 'college_name=' + new_college_name + '&index=' + index +'&addCollege='+true,
                    success: function(response) {
                        // console.log(response);
                        window.location.href = 'test-file.php';
                    }
                });
            });


            });

    });


</script>