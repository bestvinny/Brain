



					<div class="form-group required <?php echo (isset($errors) and $errors->has('dob')) ? 'has-error' : ''; ?>">
						<label class="col-md-4 control-label">{{ t('Current City') }} <sup>*</sup></label>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-location-2"></i></span>
								<input type="text" id="loc_search" name="current_city" class="form-control locinput input-rel searchtag-input has-icon"
									   placeholder="{{ t('City, County or Region') }}" value="">
                        </div>
					   </div>
					</div>


