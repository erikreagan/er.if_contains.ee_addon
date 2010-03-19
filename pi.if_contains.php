<?php

error_reporting(E_ALL);

/**
 * If Contains
 * 
 * This file must be placed in the
 * system/plugins/ folder in your ExpressionEngine installation.
 *
 * @package IfContains
 * @version 1.0
 * @author Erik Reagan http://erikreagan.com
 * @copyright Copyright (c) 2010 Erik Reagan
 * @see http://erikreagan.com/projects/if-contains/
 */

$plugin_info       = array(
   'pi_name'        => 'If Contains',
   'pi_version'     => '1.0',
   'pi_author'      => 'Erik Reagan',
   'pi_author_url'  => 'http://erikreagan.com',
   'pi_description' => 'Simple plugin that returns true or false on if a string contains a substring',
   'pi_usage'       => If_contains::usage()
   );

class If_contains
{

   var $return_data  = "";

   function If_contains()
   {
      global $TMPL;

      $needle = $TMPL->fetch_param('needle');
      $haystack = $TMPL->fetch_param('haystack');
      $true_false = preg_split("/{if_contains:else}/",$TMPL->tagdata);
      
      $this->return_data = (strpos($haystack,$needle) !== FALSE) ? $true_false[0] : $true_false[1];

   }

   /**
    * Plugin Usage
    */

   // This function describes how the plugin is used.
   //  Make sure and use output buffering

   function usage()
   {
      ob_start(); 
?>

You can use this plugin to only display something if the string is found OR you can
optionally supply data for if the string is not found

Returning TRUE only
=====================
{exp:if_contains needle="homepage" haystack="{page_body}"}

This shows up only if "homepage" is found in "{page_body}"

{/exp:if_contains}


Both TRUE and FALSE options
=====================
{exp:if_contains needle="homepage" haystack="{page_body}"}

This shows up if "homepage" IS found in "{page_body}"

{if_contains:else}

This shows up if "homepage" IS NOT found in "{page_body}"

{/exp:if_contains}



Notes
=====================
If your haystack contains single or double quotes this may cause an error. If you only have double
quotes then you will want to wrap the haystack in single quotes and vise versa. For example

{exp:if_contains needle="Hi" haystack="John said, "Hi, how are you?""}

true....

{/exp:if_contains}

This will not work because the quotation of what John said actually cuts off the haystack variable. To get
around this you could change it to this:

{exp:if_contains needle="Hi" haystack='John said, "Hi, how are you?"'}

true....

{/exp:if_contains}

<?php
      $buffer         = ob_get_contents();

      ob_end_clean(); 

      return $buffer;
   }
   // END

}


/* End of file pi.if_contains.php */
/* Location: ./system/plugins/pi.er_if_contains.php */