<?php

function publicPath($path = '')
{
  return realpath(__DIR__ . '/' . $path);
}

function imageUniqueName($infoUploadImage)
{
  $imageName = $infoUploadImage["name"];
  $extensionImage = explode(".", $infoUploadImage["name"] );
  $imageHashed = md5($imageName . time()) . "." . $extensionImage[1];

  $tmpName = $infoUploadImage["tmp_name"];

  $destinationDir = publicPath("../Assets/img");

  $destinationPath = $destinationDir . "/" . $imageHashed;

  if (move_uploaded_file($tmpName, $destinationPath)) {
    return $imageHashed;
  } else {
    return false;
  }
}
