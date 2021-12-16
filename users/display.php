<?php
    $result="";
    function resultdisplay($date, $content,$status,$id){

        $dateholder = strtotime($date);
        $dateformat =date('F j, Y ', $dateholder);
        $day = date('l', $dateholder);
        $result = '
        
        <div class="display-rec container col-xl-6 col-md-8 col-11 mt-5" id="list'.$id.'">
                <div class="d-flex flex-row">
                    <div class="">
                        <h3 class="my-0">'.$day.'</h3>
                        <h2><span id="date">'.$dateformat.'</span></h2>
                    </div>
                    <div class="dropdown dropstart ms-auto">
                        <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../public/img/menu.png" alt="log-illus" class="ms-auto">
                        </button>
                        <ul class="dropdown-menu  p-0" aria-labelledby="dropdownMenuButton1">
                            <li class="p-0">
                                <a class="dropdown-item"  href="./editDiary.php?token='.$id.'">
                                Modify
                                </a>
                                <a class="dropdown-item"  id="'.$id.'" onclick="myClick(this.id)">
                                Delete
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <div class="my-1">
                    <p>'.$content.'</p>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between  mb-4" >
                    <div class="react_div d-flex flex-row justify-content-center col-lg-6 col-md-8 col-12 p-0">
                        <div class="'.$status.'1 react-btn btn  col-3 p-0" >
                            <div class=" lbl col-12 d-flex flex-row adivgn-items-center">
                                <img src="../public/img/heart.png" alt="log-illus" class="mx-auto">
                            </div>
                        </div>
                        <div class="'.$status.'2 react-btn btn col-3 p-0" >
                            <div class=" lbl col-12 d-flex flex-row adivgn-items-center">
                                <img src="../public/img/happy.png" alt="log-illus" class="mx-auto">
                            </div>
                        </div>
                        <div class="'.$status.'3 react-btn btn col-3 p-0" id="3" >
                            <div class="lbl col-12 d-flex flex-row adivgn-items-center">
                                <img src="../public/img/sad.png" alt="log-illus" class="mx-auto">
                            </div>
                        </div>
                        <div class="'.$status.'4 react-btn btn col-3 p-0" id="4" >
                            <div class=" lbl col-12 d-flex flex-row adivgn-items-center">
                                <img src="../public/img/neutral.png" alt="log-illus" class="mx-auto">
                            </div>
                        </div>
                        
                    </div>     
    
                </div>
        </div>';

    return $result;

    }


    function noresult(){
        $result ='
        <div class="result_message container mx-auto mt-5">
            <h1 class="text-center">Oops! No results found</h1>
            <a href="/DAYiary/users/createDiary.php">
                <h2 class="text-center">Want someting more to look back? Write more</h2>
            </a>
            <a href="/DAYiary/users/">
                <h3 class="text-center">back to start</h3>
            </a>
            <div class="col-4 mx-auto">
            <img src="../public/img/dayiary_noresult.png" alt="log-illus" class="illus col-12">
            </div>
            
        </div>
        
        ';
        return $result;
    }

    function noentry(){
        $result ='
        <div class="result_message container mx-auto mt-5">
            <h1 class="text-center">Time to create some memories</h1>
            
            <h2 class="text-center"><a href="/DAYiary/users/createDiary.php">write your first diary entry</a></h2>
            
            <div class="col-lg-4 col-6 mx-auto">
                <img src="../public/img/dayiary_noentry.png" alt="log-illus" class="illus col-12">
            </div>
            
            
        </div>
        
        ';
        return $result;
    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" >
       function myClick(value){
        if (confirm("Are you sure you want to delete this Member?")) {
            $.ajax({
                type: "GET",
                url: "deleteDiary.php" ,
                data: { token: value },
                success : function() { 
                        jQuery('#list'+value).fadeOut();
                }
            });
        }
          
       }

  
                
          
 </script>


