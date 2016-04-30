@extends('app')

@section('content')
	<div id="contact-form">
		<form method="post" action="index.php">
			<fieldset>
				<legend>Contact Us</legend>
				Your name:
				<br>
				<input type="text" class="form-name" name="name" value="<?php if(isset($name)) { echo htmlspecialchars($name); } ?>">
				<br><br>

				Your email address:
				<br>
				<input type="email" class="form-email" name="email" value="<?php if(isset($email)) { echo htmlspecialchars($email); } ?>">
				<br><br>

				How can we help?
				<br>
				<textarea class="form-text" name="text"><?php if(isset($text)) { echo htmlspecialchars($text); } ?></textarea>
				<br><br>

				<input type="submit" class="form-submit" value="Send+">
				<input type="text" name="goonybot" class="goonybot" placeholder="Do not fill out :).">
			</fieldset>	
		</form>
	</div>
@stop