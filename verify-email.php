<?php
	include 'database/config.php';

	if(isset($_GET['email']) && isset($_GET['verifycode']))
	{
		$email = $_GET['email'];
		$verifycode = $_GET['verifycode'];
		$query = "SELECT * FROM registration WHERE email='$email' and verifycode='$verifycode'";
		$result = mysqli_query($conn, $query);
		if($result)
		{
			if(mysqli_num_rows($result)==1)
			{
				$result_fetch = mysqli_fetch_assoc($result);
				if($result_fetch['verified']==0)
				{
					$update = "UPDATE registration set verified = '1' WHERE email='$email'";
					if(mysqli_query($conn, $update))
					{
						echo "<script>alert('Your account has been verified.')</script>";
						?>
						<META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/capstone2/index.php">
						<?php
					}
				}
				else
				{
					echo "<script>alert('This account is invalid or already verified.')</script>";
					?>
					<META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/capstone2/index.php">
					<?php
				}
			}
		}
		else
		{
			echo "<script>alert('Server down.')</script>";
		}
	}



?>