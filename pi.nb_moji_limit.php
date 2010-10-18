<?php

// NB Moji Limit
// Copyright Nicolas Bottari
// -----------------------------------------------------
//
// Description
// -----------
// Limits the number of multibyte characters
//
// More info: http://nicolasbottari.com/expressionengine/nb_moji_limit/
//

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
  'pi_name' => 'NB Moji limit',
  'pi_version' =>'0.1',
  'pi_author' =>'Nicolas Bottari',
  'pi_author_url' => 'http://nicolasbottari.com/expressionengine_cms/nb_moji_limit',
  'pi_description' => 'Limits the number of multibyte characters',
  'pi_usage' => Nb_moji_limit::usage()
  );


class Nb_moji_limit
{

var $return_data = "";

  function Nb_moji_limit()
  {
  
    $this->EE =& get_instance();
	
	// ----------
	// Parameters
	// ----------
	
	$enc = ($this->EE->TMPL->fetch_param('encoding') !== FALSE) ? $this->EE->TMPL->fetch_param('encoding') : "UTF-8";
	$tail = ($this->EE->TMPL->fetch_param('tail') !== FALSE) ? $this->EE->TMPL->fetch_param('tail') : "...";
	$limit = ($this->EE->TMPL->fetch_param('limit') !== FALSE) ? $this->EE->TMPL->fetch_param('limit') : "50";

	// -----------
	// Return code
	// -----------
	$str = html_entity_decode($this->EE->TMPL->tagdata, ENT_QUOTES, $enc);

	if(mb_strlen($str, $enc) > $limit)
	{
	$this->return_data = mb_substr($str, 1, $limit, $enc);
	$this->return_data .= $tail;
	} else {
	$this->return_data = $str;
	}
	
	return $this->return_data;
	
	}
  
// ----------------------------------------
  //  Plugin Usage
  // ----------------------------------------

  // This function describes how the plugin is used.
  //  Make sure and use output buffering

  function usage()
  {
  ob_start(); 
  ?>
-----------
   Usage
-----------

{exp:nb_moji_limit limit="10" encoding="SJIS" tail="---"}

---------------------
     Parameters
---------------------

limit="10"
Limits the number of multibyte characters (eg. 10 kana/kanji characters). Default is 50 characters.

encoding="SJIS"
Sets the character encoding. Default is UTF-8.

tail="---"
Adds characters at the end of the truncated string. Default is "..." (non-multibyte). Set to tail="" to add nothing to the end of the string.

  <?php
  $buffer = ob_get_contents();
	
  ob_end_clean(); 

  return $buffer;
  }
  // END
  
}
?>