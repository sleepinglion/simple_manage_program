
<?php

try {

    include 'database.php';

    $pdo = new PDO('mysql:host=localhost;dbname='.$config['db'],$config['user'], $config['password']);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dateObj=new DateTime($_POST['desired_date']);
    $desired_date=$dateObj->format('Y-m-d');
	$current_time=date("Y-m-d H:i:s");

    $stmt_insert=$pdo->prepare('INSERT INTO check_date(area_name,school_name,student,address,manager,phone,email,date,vehicle,comments,agree,reg_time) VALUES(:area_name,:school_name,:student,:address,:manager,:phone,:email,:date,:vehicle,:comments,:agree,:reg_time)');
	$stmt_insert->bindParam(':area_name',$_POST['area_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':school_name',$_POST['school_name'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':student',$_POST['student'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':address',$_POST['address'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':manager',$_POST['manager'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':phone',$_POST['phone'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $stmt_insert->bindParam(':date',$desired_date,PDO::PARAM_STR);
	$stmt_insert->bindParam(':vehicle',$_POST['vehicle'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':comments',$_POST['comments'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':agree',$_POST['agree'],PDO::PARAM_STR);
	$stmt_insert->bindParam(':reg_time',$current_time,PDO::PARAM_STR);
    $stmt_insert->execute();


    echo '<meta charset="utf-8">';

    if(isset($_POST['email'])) {     
    
//	$email_to = "wagle007@daum.net";
	$email_subject = "2018년 하절기 폐교과서 수거 메일입니다.";
	$email_subject = '=?UTF-8?B?'.base64_encode($email_subject).'?=';
    
     
    function died($error) {
        // your error code can go here
        
		echo "<script> alert('메일발송을 실패하였습니다.'$error);";
		echo "history.go(-1);";
		echo "</script>";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['area_name']) ||
       !isset($_POST['school_name']) ||
       !isset($_POST['student']) ||
	   !isset($_POST['address']) ||
	   !isset($_POST['manager']) ||
       !isset($_POST['phone']) ||
       !isset($_POST['email']) ||
	   !isset($_POST['desired_date']) ||
       !isset($_POST['vehicle']) ||
       !isset($_POST['comments']) ||
       !isset($_POST['agree'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $area_name = $_POST['area_name']; // required
    $school_name = $_POST['school_name']; // required
    $student = $_POST['student']; // not required
    $address = $_POST['address']; // required
	$manager = $_POST['manager']; // required
    $phone = $_POST['phone']; // required
	$email_from = $_POST['email']; // required
    $desired_date = $_POST['desired_date']; // required
    $vehicle = $_POST['vehicle']; // required
    $comments = $_POST['comments']; // not required
	$agree = $_POST['agree']; // required
	 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "지역명 : ".clean_string($area_name)."\n\n";
    $email_message .= "학교명/기관명 : ".clean_string($school_name)."\n\n";
	$email_message .= "전체 학생수 : ".clean_string($student)."\n\n";
	$email_message .= "주소 : ".clean_string($address)."\n\n";
    $email_message .= "담당자성함/근무부서 : ".clean_string($manager)."\n\n";
    $email_message .= "담당자연락처 : ".clean_string($phone)."\n\n";
	$email_message .= "이메일 : ".clean_string($email_from)."\n\n";
    $email_message .= "수거희망날짜 : ".clean_string($desired_date)."\n\n";
    $email_message .= "차량진입가능여부 : ".clean_string($vehicle)."\n\n";
	$email_message .= "기타주문사항 : ".clean_string($comments)."\n\n";
    $email_message .= "개인정보활용동의 : ".clean_string($agree)."\n\n";
	
	
    // create email headers
    $headers = 'From: '.$email_from;
    // 제목이 깨질경우 아래 캐릭터셋 적용

	$school_name2 = '=?UTF-8?B?'.base64_encode($school_name).'?=';

    @mail("wagle007@daum.net","(".$school_name2.") ".$email_subject,$email_message, $headers);
	sleep(1);
	//@mail("hlee9669@gmail.com","(".$school_name2.") ".$email_subject,$email_message,$headers);
	//sleep(1);
	@mail("eflight2stock@gmail.com","(".$school_name2.") ".$email_subject,$email_message,$headers);
	
	
    ?>
<script>
alert ("접수되었습니다");
location.href='http://waglewagle.org/theme/jewelry/skin/content/textbook/textbook_form_new.php';
</script>
    
<?php
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

