<?php
$servername = "localhost";
$username = "gloobers_rudy";
$password = "JJp~L_c$d5T=";
$dbname = "gloobers_staging22";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
echo $conn;exit;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "Select * from gbl_booking where arrive_at_date = CURDATE() and booking_status='completed'";
$result=$conn->query($sql);

if($result->num_rows > 0){
	 while($row = $result->fetch_assoc()) {
		if($row["advisor_id"] !=0){
			
			$Check_Credits = "Select * from gbl_credit_user where uid =".$row["advisor_id"];
			$Check_Credits_result=$conn->query($Check_Credits);
			$Credits_row = $Check_Credits_result->fetch_assoc();
			if($Check_Credits_result->num_rows > 0){
				$booking_credits=50;
				$credits=($Credits_row['credits'] + $booking_credits);
				$credits_assign=($Credits_row['credits_assigned']-$booking_credits);
				$credits_earned=($Credits_row['credits_earned'] + $booking_credits);
				$Update_Credits = "update gbl_credit_user set credits='".$credits."',credits_assigned='".$credits_assign."',credits_earned='".$credits_earned."' where uid =".$row["advisor_id"];
				$Update_Credits_result=$conn->query($Update_Credits);
			}else{
				$booking_credits=50;
				$credits=($Credits_row['credits'] + $booking_credits);
				$credits_assign=$booking_credits;
				$credits_earned=($Credits_row['credits_earned'] + $booking_credits);
				$insert_Credits = "INSERT INTO gbl_credit_user (uid,credits,credits_assigned,credits_earned) VALUES ('".$row["advisor_id"]."','".$credits."','".$credits_assign."','".$credits_earned."')";
				$insert_Credits_result=$conn->query($insert_Credits);
			}
		}
		if($row["ruid"] !=0){
			
			$Check_Credits = "Select * from gbl_credit_user where uid =".$row["ruid"];
			$Check_Credits_result=$conn->query($Check_Credits);
			$Credits_row = $Check_Credits_result->fetch_assoc();
			if($Check_Credits_result->num_rows > 0){
				$recommend_booking_credits=50;
				$credits=($Credits_row['credits'] + $recommend_booking_credits);
				$credits_assign=($Credits_row['credits_assigned']-$recommend_booking_credits);
				$credits_earned=($Credits_row['credits_earned'] + $recommend_booking_credits);
				$recommend_Update_Credits = "update gbl_credit_user set credits='".$credits."',credits_assigned='".$credits_assign."',credits_earned='".$credits_earned."' where uid =".$row["ruid"];
				$recommend_Update_Credits_result=$conn->query($recommend_Update_Credits);
			}else{
				$recommend_booking_credits=50;
				$credits=($Credits_row['credits'] + $recommend_booking_credits);
				$credits_assign=$recommend_booking_credits;
				$credits_earned=($Credits_row['credits_earned'] + $recommend_booking_credits);
				$recommend_insert_Credits = "INSERT INTO gbl_credit_user (uid,credits,credits_assigned,credits_earned) VALUES ('".$row["ruid"]."','".$credits."','".$credits_assign."','".$credits_earned."')";
				$recommend_insert_Credits_result=$conn->query($recommend_insert_Credits);
			}
		}
	}

}
echo "Connected successfully";
exit;
?>