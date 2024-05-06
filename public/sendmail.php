<?php
echo '<meta charset="utf-8">';

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
       !isset($_POST['comment']) ||
       !isset($_POST['agree'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $area_name = $_POST['area_name']; // required
    $school_name = $_POST['school_name']; // required
    $student = $_POST['student']; // not required
    $address = $_POST['address']; // required
	$manager = $_POST['manager']; // required
    $phone = $_POST['phone']; // required
	$email_from = 'gvbecj@naver.com'; // $_POST['email']; // required
    $desired_date = $_POST['desired_date']; // required
    $vehicle = $_POST['vehicle']; // required
    $comment = $_POST['comment']; // not required
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
	$email_message .= "기타주문사항 : ".clean_string($comment)."\n\n";
    $email_message .= "개인정보활용동의 : ".clean_string($agree)."\n\n";
	
	
    // create email headers
    $headers = 'From: '.$email_from;
    // 제목이 깨질경우 아래 캐릭터셋 적용

	$school_name2 = '=?UTF-8?B?'.base64_encode($school_name).'?=';

    @mail("wagle007@daum.net","(".$school_name2.") ".$email_subject,$email_message, $headers);
	sleep(1);
	@mail("hlee9669@gmail.com","(".$school_name2.") ".$email_subject,$email_message,$headers);
	//sleep(1);
	//@mail("eflight2stock@gmail.com","(".$_POST['school_name'].") ".$email_subject,$email_message,$headers);
	
	