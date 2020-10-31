<div class='sgn-contact-form flex justify-center '>
<form
	id="contact-form"
	name="contact_form"
	method="post"
	action-xhr="<?php echo get_theme_file_uri(); ?>/form-handler.php"
	target="_top"
	on="submit:contact-form.clear"
>
	<?php wp_nonce_field("my-nonce-key", "my-form"); ?>
	<div class="inputWithIcon">
		<input type="text" name="your_name" placeholder="お名前 (必須)" required="">
		<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
	</div>
	<div class="inputWithIcon">
		<input type="email" placeholder="メールアドレス (必須)" name="your_email" required="">
		<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
	</div>
	<input type="text" name="your_subject" placeholder="タイトル">
  <textarea name="your_message" placeholder="お問い合せの内容を入力してください"></textarea>
  <input type="submit" name="submit" value='送信'>
	<div submit-success="">
			<template type="amp-mustache">
					 <p>{{output_message}}</p>
			</template>
	</div>
	<div submit-error="">
			<template type="amp-mustache">
					 <p>There was an error</p>
			</template>
	</div>
</form>
</div>
