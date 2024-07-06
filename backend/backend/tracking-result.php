<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************

error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('dashboard/funciones.php');

$c_sql = "SELECT * FROM company WHERE id = 1";

$c_result = dbQuery($c_sql);

$c_data = dbFetchAssoc($c_result);
 


$styling = dbFetchArray(dbQuery("SELECT * FROM styles"));
if (!isset($_POST['track'])) {
    header("Location:../track.html");
}
$tracking = $_POST['track'];

$sql = "SELECT * FROM courier WHERE tracking = '$tracking'";

$result = dbQuery($sql);
$no = dbNumRows($result);
if ($no == 1) {

    while ($data = dbFetchAssoc($result)) {

        extract($data);
        $res_status = dbQuery("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time desc LIMIT 1");
                    
        $data_status = dbFetchAssoc($res_status);
        

?>

        <!DOCTYPE html>

        <html>

        <head>
            <meta charset="utf-8" />
            <title>Track</title>
            <meta name="description" content="" />
            <meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
            <meta name="author" content="Jaomweb">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

            <link rel="shortcut icon" type="image/png" href="dashboard/img/favicon.png" />

            <!-- Font Awesome CSS -->
            <link rel="stylesheet" href="dashboard/asset1/css/font-awesome.min.css" type="text/css" media="screen">

            <!-- style -->
            <link href="deprixa_components/content/cssefe4.css" rel="stylesheet" />
            <link rel="stylesheet" href="dashboard/css/tracking.css" type="text/css" />
            <link rel="stylesheet" href="dashboard/css/newtracking.css" type="text/css" />
            <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />
            <link href="dashboard/css/style.css" rel="stylesheet" media="all">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap">
            <!-- Style Status -->
            <style>
                <?php echo $styling['style']; ?>
            </style>

        </head>

        <!-- Menu -->
        <?php include_once "menu2.php"; ?>
        <!-- /Menu -->

        <div class="slide"></div>
        <main class="slide" style="margin-bottom:50px;">


            <div class="trackingcontainer">
                <h1 class="header">Track: <span class="tracking-number"><?=$tracking?></span></h1>
            </div>
            <div class="container">
                <div class="row">
                <div class="col-md-8">
                    <div class="status-info">
                        <span class="status"><?php echo $status; ?></span>
                        <br />

                        <span class="status-date"> <?=strftime("%B %d at %I:%M %p", strtotime($schedule)); ?></span>
                    </div>
                    <br />
                    <br />
                    <div>
                        <p class="update_date"><i> Updated: <?=strftime("%B %d at %I:%M %p", strtotime($data_status['d']." ".$data_status['t']));?> </i></p>
                    </div>

                    <br />
                    <?php 
                        $color=" style='background-color: #8a0000;'";	
                        if ($status=='Approved') {
                            $color=" style='background-color: #098a00;'";	
                    
                        }
                        elseif ($status=='In Transit'|| $status=='On route' ) {
                            $color=" style='background-color: #8a7e00;'";	
                        }
                        elseif ($status=='Available'|| $status=='Available for pickup') {
                            $color=" style='background-color: #098a00;'";	
                        }
                        elseif ($status=='Delivered') {
                            $color=" style='background-color: #098a00;'";	
                            
                        }
                        

                    ?>
                    <div class="progress-bar-main">
                        <div class="progress-container">
                            <div class="progress-bar" <?=$color?> ></div>
                        </div>
                        <div class="progress-end"  <?=$color?>>
                            <div class="circle">

                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="bottominfo">
                        <div class="received-wrapper">
                            <img src="dashboard/css/assets/trackerImages/Received_by_euroserve_post_Grey.svg" class="trackingImg">
                            <p class="received-text">Received by <?php echo  $c_data['cname']; ?></p>
                            <br>
                            <p class="received-date"><?=strftime("%B %d", strtotime($book_date)); ?></p>
                        </div>
                        <div class="delivered-wrapper">
                            <?php if($status=="Delivered"): ?>
                                <img src="dashboard/css/assets/trackerImages/Delivered.svg" class="deliveredIcon">
                            <?php  endif; ?>
                            <p class="delivered-text"><?=$status ?></p>
                            <p class="delivered-date"><?=isset($data_status)?strftime("%B %d", strtotime($data_status['d'])) :""; ?></p>

                        </div>
                    </div>

                    <div class="service-info" style="display:none">
                        <p class="service-text">Your shipment is Carbon-Neutral.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div claas="delivery-info">
                        <h3 class="text-typography-redesigned-light">Delivery information</h3>
                        <div class="marginBottom16">
                            <p class="SenderDetails"><span class="sender">Sender: </span><span class=""><?php echo $ship_name; ?></span></p>
                        </div>
                        <div class="marginBottom16">
                            <p class="SenderDetails"><span class="sender">Recipient:  </span><span class=""> <?php echo $rev_name; ?></span></p>
                        </div>
                        <div class="SenderDetails"><span class="sender">Your shipment is </span>
                            <div class="greenSection"><img src="dashboard/css/assets/trackerImages/carbonNut.svg" alt="Leaf"><span class="carbonText">Carbon-Neutral</span></div>

                        </div>
                        <div>
                            <div id="track_delivery_details"><span>
                                    <a href="javascript:;" id="ServiceInfo" class="arrowDown" aria-expanded="false" aria-label="Service information">Service information</a></span>
                                <div id="ddSection" hidden="">
                                    <div>

                                        <div class="marginBottom16 ">
                                            <p class="serviceInfo"><span style="    font-weight: 500;">Shipping service:&nbsp; </span> <?php echo $type; ?></p>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <div class="marginBottom16">
                                                <p class="serviceInfo"><span style="    font-weight: 500;">Tracking number:&nbsp;</span> <?=$tracking?> </p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="marginBottom16">
                                                <div>
                                                    <p class="serviceInfo"><span style="    font-weight: 500;">Delivery standard: </span> <?=strftime("%B %d ", strtotime($schedule)); ?></p>
                                                    <!-- Reason for delivery standard date change: -->
                                                    <p class="serviceInfo" style="display:block;"><span style="    font-weight: 500;"> Description: </span><?php echo $comments; ?> </p>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="    clear: both;"></div>
                <div class="col-md-12" style="    margin: 25px 0px;">
                <hr style="    border: 1px solid #bcbcbc;">
                </div>
                <div class="col-md-8">
                    <table class="table-result cpc-table--basic" id="trackprogresstable">
                        <caption >
                            <p  class="tbtitle">Latest updates</p>
                        </caption>
                  
                     
                        <thead>
                            
                            <tr>
                                <th><strong>Date</strong></th>
                                <th><strong>Time</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Remark</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
					require_once('dashboard/database.php');

					//EJECUTAMOS LA CONSULTA DE BUSQUEDA
					$result = dbQuery("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
					$i=1;
                    $date="";
					if(dbNumRows($result)>0){							
						while($row = dbFetchArray($result,MYSQLI_ASSOC)){
						$hideotherRows= $i++>4 ? " class='morecolumns' hidden":"";
                        
					?>

                        <tr  <?=$hideotherRows?> style="<?php if($date!=$row['d']){  echo 'border-top: 1px solid #cbcbcb;';}  ?>">
                                <td><?php if($date!=$row['d']){
                                    $date=$row['d'];
                                    echo strftime("%B %d", strtotime($row['d']));;
                                }
                                
                                ?></td>
                                <td ><?=strftime("%I:%M %p", strtotime($row['t'])); ?></td>
                                <td>
                               
                                    <div><?php echo $row['status'] ?></div>
                                    
                                </td>
                                <td>
                                    <div><?php echo $row['comments'] ?></div>
                                    
                                </td>
                            </tr>
                           <?php 
						}
                            }else{
                                echo '<tr style="    border-top: 1px solid #cbcbcb;">
                                            <td colspan="3" >No results found</td>
                                        </tr>';
                            }
                            

                            ?>

                        <tr style="    border-top: 1px solid #cbcbcb;">

                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4"></div>
                </div>
                <div class="row">
                <div class="col-md-12">
                <?php 
                if(dbNumRows($result)>4){							
                ?>
                <div  id="view-more"  class="view-more viewmoreless border"><span  class=""><a  aria-expanded="false" href="javascript:;" id="showMoreLink" aria-label="View more progress table rows">View more<img  alt=""  src="dashboard/css/assets/trackerImages/Down.svg"></a></span></div>
                
                <div  id="view-less" class="view-less viewmoreless" hidden><span  class=""><a  aria-expanded="true" href="javascript:;"  id="showLessLink" aria-label="View less progress table rows">View less<img  alt="" src="dashboard/css/assets/trackerImages/Up.svg"></a></span></div>
                <?php }?>
                </div>
                <div class="col-md-3"><a href="../track.html"  class="trackMoreBtn">Track another item</a></div>
                <div class="col-md-9"></div>
                <!-- End Deprixa Section -->



        </main>

        </div>
        <footer class="slide">
            <section class="footer">
                <div class="mobEmail">
                    <form class="email-signup" name="email-signup">
                        <p>Top offers and updates delivered direct to your inbox.</p>
                        <input type="email" class="form-control" placeholder="Email Newsletter" id="email-signup-address" tabindex="-1" />
                        <input type="button" class="btn btn-primary btn-md" value="Sign up" id="email-signup-btn" tabindex="-1" />
                    </form><!--email-signup-->
                </div>
                <div class="mpd-social">
                    <a href="#" class="fb" target="_blank" tabindex="-1"></a>
                    <a href="#" class="twit" target="_blank" tabindex="-1"></a>
                    <a href="#" class="linked" target="_blank" tabindex="-1"></a>
                    <a href="#" class="gplus" target="_blank" tabindex="-1"></a>
                </div><!--social-->

                <div class="footer-divide cf"></div>




                </div>

            </section>

            <div class="fw footer-dark">
                <section class="footer footer-baseline">
                    <p class="footer-text mob-me">&copy; Copyright 2019 the on sit group</p>

                </section>
                <a href="#" id="back-top"></a>
            </div>
        </footer>
        </div>


        <script src="deprixa_components/bundles/jquery"></script>
        <script src="deprixa_components/bundles/bootstrap"></script>
        <script src="deprixa_components/Scripts/tracking.js"></script>

        </body>

        </html>
    



        <script>
            window.onload = load;
            window.onunload = GUnload;
        </script>
    <?php

    } //while

} //if
else {
    echo '';
    ?>

    <!doctype html>
    <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
    <html>

    <head>
        <meta charset="utf-8" />
        <title>Track My Parcel | DEPRIXA</title>
        <meta name="description" content="Courier Deprixa V3.2 " />
        <meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
        <meta name="author" content="Jaomweb">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <link rel="shortcut icon" type="image/png" href="dashboard/img/favicon.png" />

        <!-- style -->
        <link href="deprixa_components/content/cssefe4.css" rel="stylesheet" />
        <link rel="stylesheet" href="dashboard/css/tracking.css" type="text/css" />
        <link href="dashboard/css/style.css" rel="stylesheet" media="all">

    </head>

    <!-- Menu -->
    <?php include_once "menu2.php"; ?>
    <!-- /Menu -->

    <div class="slide">

    </div>
    <main class="slide">
        <div class="fw">
            <section class="title">
                <header>
                    <h1><img src="dashboard/img/tracking-search.png" />Shipment Tracking</h1>
                </header>
                <div class="media-left">

                </div>
            </section>
        </div>
        <div class="container">
            <div class="page-content">

                <div class="text-center">
                    <h1><img src="dashboard/img/no_courier.png" /></h1>
                    <h3>Tracking number not found,</h3>
                    <p>
                        <font color="#FF0000"><?php echo $cons; ?></font> check the number or Contact Us.
                    </p>
                    <div class="text-center"><a href="https://panoceancargos.com/">Back To Home</a></div>
                </div>
            </div>
        </div>
        </div>
        <!-- End Content -->

        <footer class="slide">
            <section class="footer">
                <div class="mobEmail">
                    <form class="email-signup" name="email-signup">
                        <p>Top offers and updates delivered direct to your inbox.</p>
                        <input type="email" class="form-control" placeholder="Email Newsletter" id="email-signup-address" tabindex="-1" />
                        <input type="button" class="btn btn-primary btn-md" value="Sign up" id="email-signup-btn" tabindex="-1" />
                    </form><!--email-signup-->
                </div>
                <div class="mpd-social">
                    <a href="#" class="fb" target="_blank" tabindex="-1"></a>
                    <a href="#" class="twit" target="_blank" tabindex="-1"></a>
                    <a href="#" class="linked" target="_blank" tabindex="-1"></a>
                    <a href="#" class="gplus" target="_blank" tabindex="-1"></a>
                </div><!--social-->

                <div class="footer-divide cf"></div>




                </div>

            </section>

            <div class="fw footer-dark">
                <section class="footer footer-baseline">
                    <p class="footer-text mob-me">&copy; </p>

                </section>
                <a href="#" id="back-top"></a>
            </div>
        </footer>
        </div>
        



        </body>

    </html>
<?php
} //else
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var toggleButton = document.getElementById("ServiceInfo");
        var myDiv = document.getElementById("ddSection");

        toggleButton.addEventListener("click", function() {
            if (myDiv.hasAttribute("hidden")) {
                myDiv.removeAttribute("hidden");
            } else {
                myDiv.setAttribute("hidden", ""); // Add empty string for hidden
            }
        });

    });

    document.addEventListener("DOMContentLoaded", function() {
    var viewMore = document.querySelector("#view-more");
    var viewLess = document.querySelector("#view-less");
    var moreColumns = document.querySelectorAll(".morecolumns");

    viewMore.addEventListener("click", function() {
        viewMore.setAttribute("hidden", "true");
        viewLess.removeAttribute("hidden");
        moreColumns.forEach(function(column) {
            column.removeAttribute("hidden");
        });
    });

    viewLess.addEventListener("click", function() {
        viewLess.setAttribute("hidden", "true");
        viewMore.removeAttribute("hidden");
        moreColumns.forEach(function(column) {
            column.setAttribute("hidden", "true");
        });
    });
});
</script>