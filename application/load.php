<?php
class Load 
{
   function view( $file_name, $data = null ) 
   {
      include 'view/' . $file_name;
   }
}
