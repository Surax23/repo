<?php
	$this->load->view('header');
?>
<div class='games'>
<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>
		
		<p>
            Логин:<br />
            <?php echo form_input($username);?>
		</p>

      
            <?php // echo lang('create_user_company_label', 'company');?>
            <?php // echo form_input($company);?>
      

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>
	  
	  <p>
			Анти-спам: 44+33=? <br />
            <?php echo form_input($answer);?>
      </p>

      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>
	
<?php echo form_close();?>
</div>
<?php
	$this->load->view('footer');
?>