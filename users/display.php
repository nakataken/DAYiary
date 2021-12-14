<?php
    $res="";
    function resultdisplay($date, $content,$status,$id){

        $dateholder = strtotime($date);
        $dateformat =date('F j, Y ', $dateholder);
        $day = date('l', $dateholder);
        $result = '
        <div class="display-rec container col-lg-6 col-md-8 col-12 mt-5">
                <div class="d-flex flex-row ">
                    <div class="">
                        <h3 class="my-0">'.$day.'</h3>
                        <h2><span id="date">'.$dateformat.'</span></h2>
                    </div>
                </div>
                <div class="mb-1">
                    <p>'.$content.'</p>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between" >
                    <ul class="d-flex flex-row justify-content-center col-md-4 col-sm-6 col-12 p-0">
                        <li class="'.$status.'1 react-btn btn  col-3 p-0" >
                            <label class="  col-12 d-flex flex-row align-items-center">
                                <img src="../public/img/heart.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="'.$status.'2 react-btn btn col-3 p-0" >
                            <label class="happy col-12 d-flex flex-row align-items-center">
                                <img src="../public/img/happy.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="'.$status.'3 react-btn btn col-3 p-0" id="3" >
                            <label class="col-12 d-flex flex-row align-items-center">
                                <img src="../public/img/sad.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        <li class="'.$status.'4 react-btn btn col-3 p-0" id="4" >
                            <label class="col-12 d-flex flex-row align-items-center">
                                <img src="../public/img/neutral.png" alt="log-illus" class="mx-auto">
                            </label>
                        </li>
                        
                    </ul>     
                    <div class="modify ms-auto">
                        <a href="./editDiary.php?token='.$id.'"><img src="../public/img/edit.png" alt="log-illus" class="my-auto me-2"></a>
                        <a href="./deleteDiary.php?token='.$id.'"><img src="../public/img/delete.png" alt="log-illus" class="my-auto"></a>
                    </div>
                </div>
        </div>';

    return $result;

    }
?>