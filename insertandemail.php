<?php
session_start();

$_SESSION['firstname'] = $_POST["firstname"];
$_SESSION['lastname'] = $_POST["lastname"];
$_SESSION['email'] = $_POST["email"];
$_SESSION['phone'] = $_POST["phone"];
$_SESSION['addressline1'] = $_POST["addressline1"];

$_SESSION['postcode'] = $_POST["postcode"];
$_SESSION['city'] = $_POST["city"];
$_SESSION['state'] = $_POST["state"];
$_SESSION['country'] = $_POST["country"];

if(isset($_POST["addressline2"]))
{
$_SESSION['addressline2'] = $_POST["addressline2"];
}else{

$_SESSION['addressline2'] = "";
}
if(isset($_POST["specialrequirements"]))
{
$_SESSION['special_requirement'] = $_POST["specialrequirements"];
}else{

$_SESSION['special_requirement'] = "";
}

include './auth.php';
mysqli_query($con, "INSERT INTO booking (booking_id, total_adult, total_children, checkin_date, checkout_date, special_requirement, payment_status, total_amount, deposit, first_name, last_name, email, telephone_no, add_line1, add_line2, city, state, postcode, country) 
VALUES (NULL, '".$_SESSION['adults']."' , '".$_SESSION['childrens']."', '".$_SESSION['checkin_db']."', '".$_SESSION['checkout_db']."', '".$_SESSION['special_requirement']."', 'В процес', '".$_SESSION['total_amount']."', '".$_SESSION['deposit']."', '".$_SESSION['firstname']."', '".$_SESSION['lastname']."', '".$_SESSION['email']."', '".$_SESSION['phone']."', '".$_SESSION['addressline1']."', '".$_SESSION['addressline2']."', '".$_SESSION['city']."', '".$_SESSION['state']."', '".$_SESSION['postcode']."', '".$_SESSION['country']."')");
echo mysqli_error($con);
$_SESSION['booking_id'] = mysqli_insert_id($con);
$count = 0;
foreach ($_SESSION['room_id'] as &$value0  ) {

mysqli_query($con, "INSERT INTO `roombook` (`booking_id`, `room_id`, `totalroombook`, `id`) VALUES ('".$_SESSION['booking_id']."', '".$value0."', '".$_SESSION['roomqty'][$count]."', NULL);");
$count = $count+1;
} ;

$to      = $_SESSION['email'];
$subject = "Потвърждение на резервацията";
$message ="<html><body>";

$message .="<table class=\"body-wrap\">\n";

$message .="	<tr>\n";
$message .="		<td></td>\n";
$message .="		<td class=\"container\" width=\"600\">\n";
$message .="			<div class=\"content\">\n";
$message .="				<table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
$message .="					<tr>\n";
$message .="						<td class=\"content-wrap aligncenter\">\n";
$message .="							<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
$message .="								<tr>\n";
$message .="									<td class=\"content-block\">\n";
$message .="										<h1>Стаята е запазена!</h1>\n";
$message .="									</td>\n";
$message .="								</tr>\n";
$message .="								<tr>\n";
$message .="									<td class=\"content-block\">\n";
$message .="										<h2>Благодарим ви, че се доверявате на нас!</h2>\n";
$message .="									</td>\n";
$message .="								</tr>\n";
$message .="								<tr>\n";
$message .="									<td class=\"content-block\">\n";
$message .="										<table class=\"invoice\">\n";
$message .="											<tr>\n";
$message .="												<td>Драги ".$_SESSION['firstname']." ".$_SESSION['lastname']."<br><br><b>Резервация №".$_SESSION['booking_id']."</b><br><b>".$_SESSION['total_night']."</b> брой нощувки от <b>".$_SESSION['checkin_date']."</b> до <b>".$_SESSION['checkout_date']."</b><br>брой гости<b> ".$_SESSION['adults']."</b> Възрастни и <b>".$_SESSION['childrens']."</b>Деца<br><br><b>Вашите данни</b><br>".$_SESSION['addressline1'].", ".$_SESSION['addressline2']."<br>".$_SESSION['postcode']." ".$_SESSION['city'].", <br>".$_SESSION['state'].", ".$_SESSION['country']."<br>Телефон <b>".$_SESSION['phone']."</b><br>Имейл <b>".$_SESSION['email']."</b><br><br><br></td>\n";
$message .="											</tr>\n";
$message .="											<tr>\n";
$message .="												<td>\n";
$message .="													<table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\">\n";

$count = 0;
foreach ($_SESSION['room_id'] as &$value0  ) {
$message .="														<tr>\n";
$message .="															<td style=\"width:200px;\"><b>".$_SESSION['roomqty'][$count]." ".$_SESSION['roomname'][$count]."</b></td>\n";
$message .="															<td  style=\"width:200px;\"> <b>BGN".$_SESSION['ind_rate'][$count]."</b></td>\n";
$message .="														</tr>\n";
$count = $count+1;
} ;

$message .="														<tr>\n";
$message .="															<td style=\"width:200px;\">Общо</td>\n";
$message .="															<td  style=\"width:200px;\"> <b>BGN".$_SESSION['total_amount']."</b></td>\n";
$message .="														</tr>\n";
$message .="														<tr>\n";
$message .="															<td style=\"width:200px;\">Необходим е 15% депозит</td>\n";
$message .="															<td  style=\"width:200px;\"><b>BGN".$_SESSION['deposit']."</b></td>\n";
$message .="														</tr>\n";;
$message .="														\n";
$message .="													</table>\n";

$message .="													<br><b>";
$message .="                     <form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_top\">\n";
$message .="					<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\n";
$message .="					<input type=\"hidden\" name=\"hosted_button_id\" value=\"3FWZ42DLC5BJ2\">\n";
$message .="					<input type=\"hidden\" name=\"lc\" value=\"MY\">\n";
$message .="					<input type=\"hidden\" name=\"item_name\" value=\"15% Депозит за резервация №".$_SESSION['booking_id']."; \">\n";
$message .="					<input type=\"hidden\" name=\"amount\" value=\"".$_SESSION['deposit']."\">\n";
$message .="					<input type=\"hidden\" name=\"currency_code\" value=\"BGN\">\n";
$message .="					<input type=\"hidden\" name=\"button_subtype\" value=\"services\">\n";
$message .="					<input type=\"hidden\" name=\"no_note\" value=\"0\">\n";
$message .="					<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest\">\n";
$message .="					<input type=\"hidden\" name=\"custom\" value=\"".$_SESSION['booking_id']."\">\n";
$message .="					<br><button class=\"button small \" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\" style=\"background-color:#2ecc70;border:0px solid #18ab29; display:inline-block; color:#ffffff; font-size:15px; padding:5px 5px;\">Платете депозита чрез PayPal</button>\n";
$message .="					<img alt=\"\" border=\"0\" src=\"https://www.paypalobjects.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\n";
$message .="					</form>";
$message .="					<br>Условия:</b>\n";

$message .="															<br>\n";
$message .="															<b>1. Моля платете 15% депозит, за да потвърдим вашата резервация.</b><br>\n";
$message .="															2. Не гарантираме вашата резервация без платен депозит.<br>\n";
$message .="															3. Уверете се, че датата на настаняване е правилна<br>\n";
$message .="															4. Управителят на хотела има право на отмени резервацията.\n";
$message .="															<br>\n";
$message .="															\n";
$message .="												</td>\n";
$message .="											</tr>\n";
$message .="										</table>\n";
$message .="									</td>\n";
$message .="								</tr>\n";
$message .="								<tr>\n";
$message .="								</tr>\n";
$message .="								<tr>\n";
$message .="									<td>\n";
$message .="										<br><br>Адрес на хотела 8200 България №1, Поморие\n";
$message .="									</td>\n";
$message .="								</tr>\n";
$message .="							</table>\n";
$message .="						</td>\n";
$message .="					</tr>\n";
$message .="				</table>\n";
$message .="				<div class=\"footer\">\n";
$message .="					<table width=\"100%\">\n";
$message .="						<tr>\n";
$message .="							<td><br>За въпроси моля обърнете се към имейл адрес <a href=\"mailto:\">info@sunhotel.bg или ни позвънете на 0000000</a></td>\n";
$message .="						</tr>\n";
$message .="					</table>\n";
$message .="				</div></div>\n";
$message .="		</td>\n";
$message .="		<td></td>\n";
$message .="	</tr>\n";
$message .="</table>";

$message .="</body></html>";
$headers  ="От: admin@sunhotel.bg";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);

header("location: reservationcomplete.php");

?>