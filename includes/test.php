<!-- create table users(
	user_ID int primary key AUTO_INCREMENT,
    user_name varchar(100) not null,
    user_email varchar(100) not null unique,
    user_password varchar(300) not null,
    user_role varchar(20) default 'user',
    user_auth_token varchar(300),
    user_account_created date default CURRENT_DATE 
)    -->

<div>
    <form method="POST">
    <input type="checkbox" name="re-btn" id="re">
    <label for="re">Remember me</label>
    <input type="submit" value="login" name="login-btn">
    </form>
</div>

<?php

    if(isset($_POST['login-btn'])){
        if(isset($_POST['re-btn'])){
            echo 'checked';
        }
        else{
            echo 'unchecked';
        }
    }


?>