<?php 

session_start();

if(isset($_SESSION['role'])) {

	switch ($_SESSION['role']) {
		case 'Admin':
			header('Location: AdminPage.php');
			break;

		case 'Doctor':
			header('Location: DoctorPage(Doctor).php');
			break;

		case 'Nurse':
			header('Location: AppointmentPage.php');
			break;

		case 'Patient':
			header('Location: Default.php');
			break;
	
	}
	

	
}
else {
    header('Location: Default.php');
}


?>







