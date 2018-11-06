<!DOCTYPE html>
<html lang="ko">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>폐교과서 수거</title>
  <link rel="stylesheet" href="./assets/stylesheets/index.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>
  <body>
<form name="contactform" method="post" action="<?php if(empty($content)): ?>insert.php<?php else: ?>update.php<?php endif ?>">
	<div class="textbook_section">
		<h1>폐교과서 수거를 신청<?php if(!empty($content)): ?>을 수정<?php endif ?>합니다</h1>
		<ul>
			<li>
				<label for="area_name">1. 지역명</label>
				<input type="text" name="area_name" id="area_name" size="30" maxlength="50" required="required"  placeholder="예시 : 경기도 의정부"<?php if(!empty($content)): ?> value="<?php echo $content['area_name'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="school_name">2. 학교명 / 기관명</label>
				<input type="text" name="school_name" id="school_name" size="30" maxlength="50" required="required"  placeholder="예시 : 경기마을교육공동체사회적협동조합"<?php if(!empty($content)): ?> value="<?php echo $content['school_name'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="manager">3. 전체 학생수/ 명 (학교가 아닌 기관은 생략)</label>
				<input type="number" name="student" id="student" min="0" step="1" placeholder="예시 : 500" <?php if(!empty($content)): ?> value="<?php echo $content['student'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="manager">4. 주소</label>
				<input type="text" name="address" id="address" size="30" maxlength="50" required="required" placeholder="예시 : 경기도 의정부시 호국로 1287"<?php if(!empty($content)): ?> value="<?php echo $content['address'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="manager">5. 담당자 성함/근무부서</label>
				<input type="text" name="manager" id="manager" size="30" maxlength="50" required="required" placeholder="예시 : 김몽실/행정실"<?php if(!empty($content)): ?> value="<?php echo $content['manager'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="phone">6. 담당자 연락처(교무실/행정실/휴대폰)</label>
				<input type="text" name="phone" id="phone" size="30" maxlength="50" required="required" placeholder="예시 : 031-123-1234 / 031-123-1234 / 010-123-1234"<?php if(!empty($content)): ?> value="<?php echo $content['phone'] ?>"<?php endif ?>>
				<!--<span class="phonetype">사무실 :</span>
					<input type="text" name="phone1" id="phone1" size="30" maxlength="50" style="width:91%; margin-bottom:5px;" required="required" placeholder="예시 : 031-847-7100" >
					<br>
					<span class="phonetype">휴대폰 :</span>
					<input type="text" name="phone2" id="phone2" size="30" maxlength="50" style="width:91%;" required="required" placeholder="예시 : 010-000-0000" >--> 
			</li>
			<li>
				<!-- <input type="hidden" name="email" id="email" size="30" maxlength="50" required="required" value="gvbecj@naver.com"> -->
			</li>
			<li>
				<label for="desired_date">7. 수거 희망 날짜 (하루 30건으로 제한 합니다. 30건이 초과되면 접수가 되지 않으므로 다른 날짜로 선택해주세요.)</label>
				<input type="text" name="desired_date" id="datepicker" required="required" placeholder="2018년 7월 25일"<?php if(!empty($content)): ?> value="<?php echo $content['date'] ?>"<?php endif ?>>
			</li>
			<li>
				<label for="vehicle">8. 차량진입 가능여부</label>
				<div class="vehicle-wrap">
					<?php foreach($vehicle_list as $index=>$value): ?>
					<input type="radio" name="vehicle" id="vehicle<?php echo $index ?>" value="<?php echo $value['id'] ?>"<?php if(!empty($content)): ?><?php if($content['vehicle_id']==$value['id']): ?> checked<?php endif ?><?php else: ?> checked<?php endif ?>>
					<label for="vehicle<?php echo $index ?>" class="vehicle-choice" style="margin-right:20px;"><?php echo $value['title'] ?></label>
					<?php endforeach ?>
				</div>
            </li>
			<li>
				<label for="content">9. 기타 주문 사항 <font color=red>(마대자루 신청시 사전에 연락드리고 발송합니다.)</font></label>
				<textarea name="content" id="content"  cols="50" rows="5" placeholder=""><?php if(!empty($content)): ?><?php echo $content['content'] ?><?php endif ?></textarea>
            </li>
			<?php if(empty($content)): ?>            
			<li> <label>* 개인 정보 활용 동의 <span style="font-size:12px; margin-top:5px; color:#888;">(업무연락 외 개인 정보를 사용하지 않습니다. <font color=red> 개인 정보 활용 동의</font>는 <font color=red><strong>예</strong></font>로 선택하셔야 접수가능합니다.)</span>
				</label>
				<div class="agree-wrap">
					<input type="radio" name="agree" id="agree0" value="예" required="required">
					<label for="agree0" class="radio-agree" style="margin-right:20px;">예</label>
					<input type="radio" name="agree" id="agree1" value="아니오" required="required" checked>
					<label for="agree1" class="radio-agree">아니오</label>
				</div>
			</li>
			<input type="submit" id="submit_button" value="입력하기" disabled class="btn_submit">
			<?php else: ?>
			<input type="submit" id="submit_button" value="수정하기" class="btn_submit">
			<?php endif ?>
		</ul>
	</div>
</form>
<script>
$(window).load(function(){
    <?php
	
	$count_index=count($list);
	if(count($list)) {
		echo 'var $myBadDates	= new Array(';
		foreach($list as $index=>$value) {
			$date=new DateTime($value['date']);
			echo '"'.$date->format('m/d/Y').'"';

			if(($index+1)<$count_index) {
				echo ',';
			}
		}
		echo ')';
	} else {
		echo 'var $myBadDates=new Array();';
	}

	?>


    $("#datepicker").datepicker({
 		//dateFormat : "yy-m-d",
 		dateFormat : "mm/dd/yy",
		beforeShowDay : checkBadDates

	});


function checkBadDates(mydate){
var $return=true;
var $returnclass ="available";
$checkdate = $.datepicker.formatDate('mm/dd/yy', mydate);
for(var i = 0; i < $myBadDates.length; i++)
{
if($myBadDates[i] == $checkdate)
{
$return = false;
$returnclass= "unavailable";
}
}
return [$return,$returnclass];
}
	

    var agt = navigator.userAgent.toLowerCase();
    var content = $('#comments');
    var placeholderText ='';
 
    //표준브라우저와 익스 하위브라우저분기
    if (agt.indexOf("msie 7.0") != -1||agt.indexOf("msie 8.0") != -1) {
        placeholderText = "예시 1) 본교는 폐교과서를 운동장에 모아 둘테니 수거해주세요.<BR>예시 2) 본교는 폐교과서를 집게차에 직접 버리겠습니다.";
        insertHtml();
    }else{
        placeholderText = "예시 1) 본교는 폐교과서를 운동장에 모아 둘테니 수거해주세요.\n예시 2) 본교는 폐교과서를 집게차에 직접 버리겠습니다.";
        insertValue();
    }
    
    //하위버전 
    function insertHtml(){
        content.html( placeholderText );
        var value = content.html();
        $('#comments').bind('focusin', function() {
             if(value == placeholderText ) {
                content.html('');
                value = content.html();
            }
        }).bind('focusout', function() {
            value = content.html();
            if(value == '') {
                content.html(placeholderText);
                value = content.html();
            }
        }); 
    }
    
      //상위버전 
    function insertValue(){
        content.val( placeholderText );
        var value = content.val();
        
        $('#comments').bind('focusin', function() {
            if(value == placeholderText ) {
                content.val('');
                value = content.val();
            }
        }).bind('focusout', function() {
            value = content.val();
            if(value == '') {
                content.val(placeholderText);
                value = content.val();
            }
        });
      }
});
<?php if(empty($content)): ?>
  $(function() {
    $( "input[name=agree]" ).click(function(){
		if($(this).val() == "아니오"){
			$("#submit_button").attr("disabled",false);
		}
		if($(this).val() == "예"){
			$("#submit_button").attr("disabled",false);
		}else{
			$("#submit_button").attr("disabled",true);
			
		}
	})
	
  });
<?php endif ?>
  </script>
</body>
</html>