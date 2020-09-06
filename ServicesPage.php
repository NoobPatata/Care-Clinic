<?php $page = 'services'; require("Head(Patient).php"); ?>


    <body>
        <div class="row">
            <div class="col-md-12 text-center bg-custom">
                <h1>Services</h1>
                <hr class="hr-green mt-0">
                <div class="row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img class="servicesimage" src="Graphic/scaling.png">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img class="servicesimage" src="Graphic/teethwhitening.png">
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="col-md-12 text-center bg-custom">
                <div class="row justify-content-md-center">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img class="servicesimage" src="Graphic/crown.png">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img class="servicesimage" src="Graphic/consultation.png">
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-12  bg-custom">
            <div class="row justify-content-md-center">
            <button type="button" class="btn-lg button-l" onclick="window.location.href='MakeAppointmentPage.php'">Make Appointment</button>

            </div>
            <br>
        </div>
    </body>


<?php require("Footer(Patient).php"); ?>






