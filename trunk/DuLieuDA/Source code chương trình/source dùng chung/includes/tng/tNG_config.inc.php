<?php
// Array definitions
  $tNG_login_config = array();
  $tNG_login_config_session = array();
  $tNG_login_config_redirect_success  = array();
  $tNG_login_config_redirect_failed  = array();
  $tNG_login_config_redirect_success = array();
  $tNG_login_config_redirect_failed = array();

// Start Variable definitions
  $tNG_debug_mode = "DEVELOPMENT";
  $tNG_debug_log_type = "";
  $tNG_debug_email_to = "you@yoursite.com";
  $tNG_debug_email_subject = "[BUG] The site went down";
  $tNG_debug_email_from = "webserver@yoursite.com";
  $tNG_email_host = "mail.thietkewebdep24h.com";
  $tNG_email_user = "testmail@thietkewebdep24h.com";
  $tNG_email_port = "25";
  $tNG_email_password = "testmail";
  $tNG_email_defaultFrom = "hspq07@gmail.com";
  $tNG_login_config["connection"] = "ketnoi";
  $tNG_login_config["table"] = "member";
  $tNG_login_config["pk_field"] = "id_member";
  $tNG_login_config["pk_type"] = "NUMERIC_TYPE";
  $tNG_login_config["email_field"] = "member_email";
  $tNG_login_config["user_field"] = "member_user";
  $tNG_login_config["password_field"] = "member_password";
  $tNG_login_config["level_field"] = "member_accesslevel";
  $tNG_login_config["level_type"] = "NUMERIC_TYPE";
  $tNG_login_config["randomkey_field"] = "member_randomkey";
  $tNG_login_config["activation_field"] = "member_active";
  $tNG_login_config["password_encrypt"] = "true";
  $tNG_login_config["autologin_expires"] = "30";
  $tNG_login_config["redirect_failed"] = "login_error.php";
  $tNG_login_config["redirect_success"] = "login_success.php";
  $tNG_login_config["login_page"] = "login_success.php";
  $tNG_login_config["max_tries"] = "5";
  $tNG_login_config["max_tries_field"] = "member_loginnumber";
  $tNG_login_config["max_tries_disableinterval"] = "10";
  $tNG_login_config["max_tries_disabledate_field"] = "member_loginnumber";
  $tNG_login_config["registration_date_field"] = "";
  $tNG_login_config["expiration_interval_field"] = "";
  $tNG_login_config["expiration_interval_default"] = "";
  $tNG_login_config["logger_pk"] = "id_loguser";
  $tNG_login_config["logger_table"] = "loguser";
  $tNG_login_config["logger_user_id"] = "id_member";
  $tNG_login_config["logger_ip"] = "iploguser";
  $tNG_login_config["logger_datein"] = "datetimeout";
  $tNG_login_config["logger_datelastactivity"] = "datetimein";
  $tNG_login_config["logger_session"] = "sessionloguser";
  $tNG_login_config_redirect_success["1"] = "login_success.php";
  $tNG_login_config_redirect_failed["1"] = "login_error.php";
  $tNG_login_config_redirect_success["2"] = "login_success.php";
  $tNG_login_config_redirect_failed["2"] = "login_error.php";
  $tNG_login_config_session["kt_login_id"] = "id_member";
  $tNG_login_config_session["kt_login_user"] = "member_user";
  $tNG_login_config_session["kt_login_level"] = "member_accesslevel";
// End Variable definitions
?>