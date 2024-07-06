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
$styling=dbFetchArray(dbQuery("SELECT * FROM styles"));
if(!isset($_POST['track'])){
header("Location:../track.html");
}
$tracking= $_POST['track'];

$sql = "SELECT * FROM courier WHERE tracking = '$tracking'";

$result = dbQuery($sql);
$no = dbNumRows($result);
if($no == 1){	
				
while($data = dbFetchAssoc($result)) {
	
extract($data);


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track</title>
	<meta name="description" content=""/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="dashboard/img/favicon.png"/>

	<!-- Font Awesome CSS -->
    <link rel="stylesheet" href="dashboard/asset1/css/font-awesome.min.css" type="text/css" media="screen">  
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="dashboard/css/tracking.css" type="text/css" />   
    <link href="deprixa_components/styles/track-order.css" rel="stylesheet" />
	<link href="dashboard/css/style.css" rel="stylesheet" media="all">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="https://cdn.tailwindcss.com"></script>
	
		<!-- Style Status -->
	<style><?php echo $styling['style']; ?></style>
	
</head>

   <!-- Menu -->
<?php include_once "menu2.php"; ?>
    <!-- /Menu -->

<div class="slide"></div>
<main class="slide">
<div class="container">
<div class=" p-4">
    <div class="max-w-7xl mx-auto">
        
        
	<div class="col-md-12">
    <div class="bg-white  p-6 rounded-lg shadow">
	<div style="    display: flex;
    gap: 10px;"> <img  src="track.png"/>
      <h1 class="text-2xl font-semibold text-zinc-800 "> Track: <?=$tracking?></h1></div>
    </div>
	</div>
	<?php 
		$color="red";	
		if ($status=='Approved') {
			$color="green";	
	
		}
		elseif ($status=='In Transit'|| $status=='On route' ) {
			$color="yellow";	
		}
		elseif ($status=='Available'|| $status=='Available for pickup') {
			$color="green";	
		}
		elseif ($status=='Delivered') {
			$color="green";	
			
		}
		

		 ?>
	<div class="col-md-8">
		<div class="bg-white  p-6 mt-6 rounded-lg shadow">
		<h2 class="text-xl font-semibold text-zinc-800 "><span style="color:<?=$color?>"> <?php echo $status; ?></span></h2>
		<p class="text-zinc-600 dark:text-zinc-400"><strong >Estimated Delivery Date: </strong><?php echo $schedule; ?></p>
		<div class="flex items-center mt-4">
			<div class="flex-grow h-2 bg-<?=$color?>-500 rounded"></div>
			
		</div>
		<div class="flex items-center mt-4 justify-between">
			 
			
			
			<div class="flex text-zinc-600 dark:text-zinc-400"><img src="destination.png" class="pr-4"/> <strong>Destination:</strong> <?php echo $paisdestino; ?></div>
			<div class="flex  text-zinc-600 dark:text-zinc-400"> <?php if($status=="Delivered"){ ?><img src="delivered.png"   class="mr-2" style=" width: 25px;" />  <?php } ?> <strong style="color:<?=$color?>"><?=$status?></strong> </div>
			
		</div>
		</div>
		<div class="bg-white  p-6 mt-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold text-zinc-800 ">Latest updates</h2>
      <table class="w-full mt-4">
        <thead>
          <tr class="text-left text-zinc-600 dark:text-zinc-400">
            <th class="py-2">Date & Time</th>
			<th class="py-2">Location</th>
			<th class="py-2">Status</th>
            <th class="py-3">Progress</th>
          </tr>
        </thead>
        <tbody>
		<?php
					require_once('dashboard/database.php');

					//EJECUTAMOS LA CONSULTA DE BUSQUEDA
					$result = dbQuery("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
					$i=0;
					if(dbNumRows($result)>0){
						
						//$row = dbFetchArray($result,MYSQLI_ASSOC);
						//while($i<7 && ++$i){
							
						while($row = dbFetchArray($result,MYSQLI_ASSOC)){
							$hideotherRows= dbNumRows($result)>4 ? "hidden":"";
							
					?>

          <tr class="border-t <?=$hideotherRows?>">
		  
		  
		  <td class="py-2"><?=$row['d'].' '.$row['t']?></td>
            <td class="py-2"><?=$row['pick_time']?></td>
            <td class="py-2"><?=$row['status']?></td>
            <td class="py-2"><?=$row['comments']?></td>			
									
									
									
          </tr>
          <?php 
						}
		  	}else{
				echo '<tr>
							<td colspan="5" >No results found</td>
						</tr>';
			}
			

			 ?>

          
        </tbody>
      </table>
	  <br/>
	  <br/>
	  <?php 
	  //if($i>5) {
	 	if(dbNumRows($result)>5) {
		?>
      <button id="view-more-btn" class="mt-4 text-blue-600 dark:text-blue-400">View more</button>
	  <?php }?>
	  
      <a class="mt-4 ml-4 bg-blue-600 text-white px-4 py-2 rounded" style="text-decoration: none;" href="../track.html">Track another item</a>
    </div>
	</div>

	<div class="col-md-4">
	<div class="bg-white  p-6 mt-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold text-zinc-800 ">Delivery information</h2>
        <p class="text-zinc-600 dark:text-zinc-400"><strong>Phone:</strong> <?php echo $r_phone; ?></p>
	 	<p class="text-zinc-600 dark:text-zinc-400"><strong>Sender:</strong> <?php echo $ship_name; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Recipient:</strong> <?php echo $rev_name; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Pickup Date/Time:</strong> <?php echo $pick_date; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Weight:</strong> <?php echo $weight; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Description:</strong> <?php echo $comments; ?></p>
    </div>
	<div class="bg-white  p-6 mt-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold text-zinc-800 "> Shipment Details</h2>
        <p class="text-zinc-600 dark:text-zinc-400"><strong>Tracking ID:</strong> <?php echo $tracking; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Origin:</strong> <?php echo $pick_time; ?> </p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Tracking ID:</strong> <?php echo $tracking; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Origin:</strong> <?php echo $pick_time; ?> </p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Destination:</strong> <?php echo $paisdestino; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Current status:</strong><span style="color:<?=$color?>"> <?php echo $status; ?></span></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Type:</strong> <?php echo $type; ?></p>
		<p class="text-zinc-600 dark:text-zinc-400"><strong>Shipment Type:</strong> <?php echo $mode; ?></p>
    </div>
	</div>
    




    
      </div>
    </div>

</div>

 <!-- End Deprixa Section -->	
</div> 
</div>

 </main>

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
    const viewMoreBtn = document.getElementById('view-more-btn');
    const hiddenRows = document.querySelectorAll('tbody tr.hidden');
    
    viewMoreBtn.addEventListener('click', () => {
      hiddenRows.forEach(row => {
        row.classList.toggle('hidden');
      });
    });
  </script>

 

<script>
   window.onload=load;
   window.onunload=GUnload;
</script>
<?php 

}//while

}//if
else {
echo '';
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8" />	    
    <title>Track My Parcel  | DEPRIXA</title>
	<meta name="description" content="Courier Deprixa V3.2 "/>
	<meta name="keywords" content="Courier DEPRIXA-Integral Web System" />
	<meta name="author" content="Jaomweb">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" type="image/png" href="dashboard/img/favicon.png"/>
    
    <!-- style -->
    <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	<link rel="stylesheet" href="dashboard/css/tracking.css" type="text/css" />   
	<link href="dashboard/css/style.css" rel="stylesheet" media="all">

</head>

   <!-- Menu -->
<?php  include_once "menu2.php"; ?>
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
						<p><font color="#FF0000"><?php echo $cons; ?></font> check the number or Contact Us.</p>
						<div class="text-center"><a href="https://euroservee.com/">Back To Home</a></div>
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
<script>
    const viewMoreBtn = document.getElementById('view-more-btn');
    const hiddenRows = document.querySelectorAll('tbody tr.hidden');
    
    viewMoreBtn.addEventListener('click', () => {
      hiddenRows.forEach(row => {
        row.classList.toggle('hidden');
      });
    });
  </script>

 
	
</body>
</html>
<?php 
}//else
?>