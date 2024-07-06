
		  <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier/update_status.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title"><?php echo $actualizarestadoenvio; ?></h3> 
						</div> 
						<div class="modal-body">
							<div class="row"  style="display:none">  
								<div class="col-md-2"> 
									<div class="form-group">
									<label for="UCid" class="control-label"><?php echo $ids; ?></label> 									
										<input type="text" class="form-control" id="UCid" name="cid" value="" readonly > 
									</div> 
								</div> 
								<div class="col-md-4"> 
									<div class="form-group"> 
										<label for="UCcons_no" class="control-label"><?php echo $tracking; ?></label> 
										<input type="text" class="form-control" id="UCcons_no" name="cons_no" value="" readonly> 
									</div> 
								</div>
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-6" class="control-label"><?php echo $Usuario; ?></label> 
										<input type="text" class="form-control" id="field-6" name="user" value="<?php echo $_SESSION['user_name'] ;?>" readonly> 
									</div> 
								</div> 								
							</div>
							<div class="row"  style="display:none">  								
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="UCrev_name" class="control-label"><?php echo $destina; ?></label> 
										<input type="text" class="form-control" id="UCrev_name" name="rev_name" value="" readonly> 
									</div> 
								</div>
								<input type="hidden" class="form-control" id="UCr_phone" name="r_phone" value="">
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="UCemail" class="control-label"><?php echo $EMAIL; ?></label> 
										<input type="text" class="form-control" id="UCemail" name="email" value="" readonly> 
									</div> 
								</div> 								
							</div> 
							<div class="row"> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-1" class="control-label"><?php echo $NUEVAUBICACION; ?></label> 

										<select name="pick_time"  class="form-control">
										<?php
											$sql=dbQuery("SELECT country_id,country_name FROM countries ORDER BY country_name");
											while($row=dbFetchArray($sql)){
												echo '<option value="'.$row["country_name"].'">'.$row["country_name"].'</option>';
											}
										?>
									</select>
									</div> 
								</div> 
								<div class="col-md-6"> 
									<div class="form-group"> <?php echo $L_CITYADDRESS; ?></label> 
										<input type="text" class="form-control" id="field-6" name="citaddress" placeholder="<?php echo $L_CITYADDRESS_COMMENTS; ?>" > 
									</div> 
								</div>
							</div>
							<div class="row"> 
								<div class="col-md-6"> 
									<div class="form-group"> 
										<label for="field-2" class="control-label"><?php echo $NUEVOESTADO; ?></label> 
										<select name="status" class="form-control" >
												<?php
														$sql=dbQuery("SELECT servicemode FROM service_mode  GROUP BY servicemode");
														while($row=dbFetchArray($sql)){
														if($cliente==$row['servicemode']){
														echo '<option value="'.$row['servicemode'].'" selected>'.$row['servicemode'].'</option>';
														}else{
														echo '<option value="'.$row['servicemode'].'">'.$row['servicemode'].'</option>';
													 }
													}
												?>
											</select>
									</div> 
								</div> 
							</div> 
							<div class="row"> 
								<div class="col-md-12"> 
									<div class="form-group"> 
										<label for="field-3" class="control-label"><?php echo $COMENTARIOS; ?></label> 
										<textarea class="form-control" name="comments" id="comments"  placeholder="<?php echo $cometario_estado; ?>" required></textarea> 
									</div> 
								</div> 
							</div> 
							
							 <div class="row"> 
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Date</label> 
                    <input type="date" class="form-control" id="field-6" name="d"  > 
                  </div> 
                </div> 
        
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Time</label> 
                    <input type="time" class="form-control" id="field-6" name="t"  > 
                  </div> 
                </div> 
                <hr>
                
                 
                 <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label" style="color:red">Choose only if you want to schedule this update at a later date and time</label> 
                    <input style="color:red" type="date" class="form-control" id="field-6" name="future_date"  > 
                  </div> 
                </div> 
                
                 <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label style="color:red" for="field-3" class="control-label">Time</label> 
                    <input style="color:red" type="time" class="form-control" id="field-6" > 
                  </div> 
                </div> 

 </div> 

						</div> 
						<div class="modal-footer"> 
							<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $cerrar; ?></button> 
							<input name="submit" type="submit" class="btn btn-info" value="<?php echo $ACTUALIZARESTADO; ?>">
						</div>
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			

			<script>

				function UpdateStatusModal(id){
					fetch('modal-status/ajax_fetch_data_courier.php?cid=' + id)
						.then(response => response.json())
						.then(data => {

							document.getElementById('UCid').value= data.cid;
							document.getElementById('UCcons_no').value= data.cons_no;
							document.getElementById('UCrev_name').value= data.rev_name;
							document.getElementById('UCr_phone').value= data.r_phone;
							document.getElementById('UCemail').value= data.email;
						})
						.catch(error => {
							console.error('Error:', error);
						});
					
				}
				
			</script>