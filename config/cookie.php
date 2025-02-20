<?php

function setUserCookie ($name, $value){
  $userCookie = setcookie($name, $value, 0 , "/");
  if(isset($userCookie)){
    return true;
  } else {
    return false;
  }
}

