
		  <div id="update_price" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">				
					<div class="modal-content">
					<form action="settings/add_courier/update_amount.php" method="post" name="frmShipment" id="frmShipment">
						<div class="modal-header"> 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
							<h3 class="modal-title">Edit Amount Details</h3> 
						</div> 
						<div class="modal-body">
							
							
						
					<input type="hidden" class="form-control" id="UPcid" name="cid" > 		
						
							 <div class="row"> 
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Total Amount</label> 
                    <input type="text" class="form-control" id="UPt_price" name="t_price"   > 
                  </div> 
                </div> 
        
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Advanced Amount</label> 
                    <input type="text" class="form-control" id="UPa_price" name="a_price"  > 
                  </div> 
                </div> 
                
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Pending Amount</label> 
                    <input type="text" class="form-control" id="UPp_price" name="p_price"  > 
                  </div> 
                </div> 
                
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label for="field-3" class="control-label">Select Payment Mode</label> 
                 
                    
                    <select name="payment_mode" class="control-label">                       
                      <option class="control-label" value="Bank transfer (cash payment)">Bank transfer (cash payment)</option>
                      <option class="control-label" value="Bitcoin">Bitcoin </option>
                      <option class="control-label" value="PayPal">PayPal</option>
                      <option class="control-label" value="Credit card">Credit card</option>
                    </select>
                  </div> 
                </div> 

 </div> 

						</div> 
						<div class="modal-footer"> 
							<button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $cerrar; ?></button> 
							<input name="submit" type="submit" class="btn btn-info" value="Update">
						</div>
					</form>	
					</div>				
				</div>
			</div><!-- /.modal -->
			

      <script>

        function UpdatePriceModal(id){
					fetch('modal-status/ajax_fetch_data_updateprice.php?cid=' + id)
						.then(response => response.json())
						.then(data => {

							document.getElementById('UPcid').value= data.cid;
              
							document.getElementById('UPt_price').value= data.shipping_subtotal;
							document.getElementById('UPa_price').value= data.advance_price;
							document.getElementById('UPp_price').value= data.pending_price;
							
						})
						.catch(error => {
							console.error('Error:', error);
						});
					
				}
      </script>