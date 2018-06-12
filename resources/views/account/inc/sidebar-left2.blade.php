<aside>
	<div class="inner-box">
		<div class="user-panel-sidebar">
            
                <div class="collapse-box">
                    <h5 class="collapse-title no-border">
                        {{ t('All Locations') }}&nbsp;
                        <a href="#MyClassified" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                    </h5>
                    <div class="panel-collapse collapse in" id="MyClassified">
                        <ul class="acc-list">
                            <li> 
                                <ul>                             

                                        @foreach($cities as $city)         
                                            <a href="" title="">
                                                 <h6>{{ $city->name }}</h6>
                                            </a>
                                       @endforeach
    
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.collapse-box  -->
                
               
                    <div class="collapse-box">
                        <h5 class="collapse-title">
                            {{ t('Occupation') }}&nbsp;
                            <a href="#MyAds" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MyAds">
                            <ul class="acc-list">
                               
                                    <li>
                                       @foreach($occupations as $occupation)         
                                            <a href="" title="">
                                                 <h6>{{ $occupation->name }}</h6>
                                            </a>
                                       @endforeach                           
                            
                                    </li>
                              
                            </ul>
                        </div>
                    </div>
                    <!-- /.collapse-box  -->


                     <div class="collapse-box">
                        <h5 class="collapse-title">
                            {{ t('Experience') }}&nbsp;
                            <a href="#MyExp" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MyExp">
                            <ul class="acc-list">
                               
                                    <li>
                                       @foreach($educations as $education)         
                                            <a href="" title="">
                                                 <h6>{{ $education->level }}</h6>
                                            </a>
                                       @endforeach
                            
                                    </li>
                                    
                              
                            </ul>
                        </div>
                    </div>
                    <!-- /.collapse-box  -->

                    <div class="collapse-box">
                        <h5 class="collapse-title">
                            {{ t('Skills') }}&nbsp;
                            <a href="#MySkills" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a>
                        </h5>
                        <div class="panel-collapse collapse in" id="MySkills">
                            <ul class="acc-list">
                               
                                    <li>
                                       @foreach($educations as $education)         
                                            <a href="" title="">
                                                 <h6>{{ $education->level }}</h6>
                                            </a>
                                       @endforeach
                            
                                    </li>
                                    
                              
                            </ul>
                        </div>
                    </div>
                

		</div>
	</div>
	<!-- /.inner-box  -->
</aside>