<?php

class ReplaceToken{

	public function replacePlaceholderCode(){
		//$this->CI = & get_instance();
       $ci = & get_instance();
       $contents = $ci->output->get_output();
       $contents = str_replace("Please Sign In",'Sign In', $contents);
       echo $contents;
       return;




	}

	





}