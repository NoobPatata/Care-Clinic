<?php $page = 'home'; require("Head(Patient).php"); ?>
    <body>
        <div class="row">
            <div class="col-md-12">
                <div id="slideshow" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#slideshow" data-slide-to="0" class="active"></li>
                      <li data-target="#slideshow" data-slide-to="1"></li>
                      <li data-target="#slideshow" data-slide-to="2"></li>
                    </ul>
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="Graphic/a.jpg" alt="Los Angeles" width="1100" height="500">
                      </div>
                      <div class="carousel-item">
                        <img src="Graphic/b.jpg" alt="Chicago" width="1100" height="500">
                      </div>
                      <div class="carousel-item">
                        <img src="Graphic/c.jpg" alt="New York" width="1100" height="500">
                      </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#slideshow" data-slide="prev">
                      <span class="material-icons" style="font-size:40px;color:#2F4F4F">keyboard_arrow_left</span>
                    </a>
                    <a class="carousel-control-next" href="#slideshow" data-slide="next">
                        <span class="material-icons" style="font-size:40px;color:#2F4F4F">keyboard_arrow_right</span>
                    </a>
                </div>
                <br><br>
            </div>

            <div class="col-md-12">
                <div class="backgroundimage">
                    <img id="titleimage" src="Graphic/whychooseus.jpg">
                </div>
                <div class="title">
                    Why Choose Us?
                </div>
                <br>
            </div>
            <div class="col-md-12 text-center">
                <h4>Care Clinic is a patient driven clinic where patient always come first.
                    We provide the best healthcare service possible to all our patient.
                </h4>
                <br><br>
            </div>   
            
            <div class="col-md-12 text-center bg-custom">
                <h1>Testimonial</h1>
                <hr class="hr-green mt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-green mb-3">
                            <div class="card-body bg-green">
                                <h5 class="card-title">Maria</h5>
                                <hr class="hr-white mt-0">
                                <p class="card-text">"Genuinely professional & warm doctors. 
                                    You will not get this experience from other places."
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-green mb-3">
                            <div class="card-body bg-green">
                                <h5 class="card-title">Jacob</h5>
                                <hr class="hr-white mt-0">
                                <p class="card-text">"Dr Alan is a very wonderful person and very knowledgeable in his work.
                                    In addition, there is no long wait, staff are friendly and always a satisfactory visit.
                                    I would recommend any one to go to this clinic."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-12 buffer"></div>
        </div>
    </body>
<?php require("Footer(Patient).php"); ?>






