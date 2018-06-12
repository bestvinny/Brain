
					<div class="form-group required <?php echo (isset($errors) and $errors->has('dob')) ? 'has-error' : ''; ?>">
						<label class="col-md-3 control-label">{{ t('Location') }} <sup>*</sup></label>
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-location-2"></i></span>
								<input type="text" id="loc_search" name="location" class="form-control locinput input-rel searchtag-input has-icon"
									   placeholder="{{ t('City, County or Region') }}" value="">
                        </div>
					   </div>
					</div>


					



