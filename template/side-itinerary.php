<?php
    $postId = $_GET["postId"];
    $destinations = $dbh->getPostItinerary($postId);
    //var_dump($destinations);
?>

<div class="container-fluid d-none d-md-block">
        <div class="row">
            <!-- timeline -->
            <div class="col mt-5 itinerary">
                <div class="outerDiv" id="outerDiv">
                    <div id="middleDiv" class="middleDiv">
                        <div id="innerDiv" class="innerDiv">
                            <!--<div id="square" class="square" style="left:50%;"></div>-->
                            <div class="" style="max-height:60%; position:inherit;">
                                <ul class="">
                                    <?php
                                        foreach($destinations as $place){
                                            echo '
                                            <li class="dot">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-9 pe-0">
                                                            <p class="mb-1">'.$place["description"].'</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
