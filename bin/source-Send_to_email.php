<?php
//this file is designed to be used as an include that is part of a loop.
//available variables for use are: $thenumber
//last edited Sept 24, 2012 by lgaetz

//configuration / display parameters
//The description cannot contain "a" tags, but can contain limited HTML. Some HTML (like the a tags) will break the UI.
$source_desc = "This source will send the number and the Caller ID to any 10-digit SMS phone number using an already-installed Google Voice accout.<br>The message will be sent as a Call notification<br>This datasource should be one of the last data sources on your list.<br>This data source requires Superfecta Module version 2.2.3 or higher.";
$source_param = array();

$source_param['email']['desc'] = 'Specify email address';
$source_param['email']['type'] = 'text';
$source_param['email']['default'] = '';
$source_param['Default_CNAM']['desc'] = 'Text to push if no CNAM is found. Leave blank to prevent Superfecta from sending anything if no CNAM is found.';
$source_param['Default_CNAM']['type'] = 'text';
$source_param['Default_CNAM']['default'] = '';


if($usage_mode == 'post processing')
{

	$cnam = "";

	if ($first_caller_id != "")
        {
        	$cnam = $first_caller_id;
        }
        else if ($run_param['Default_CNAM'] != "")
        {
		$cnam = $run_param['Default_CNAM'];
        }

	if (($run_param['email'] !='') && ($cnam != ''))
	{
		$subject = '"Incoming call: '.$cnam.' '.$thenumber.'"';
		shell_exec('mail -s '.$subject.' '.$run_param['email'].' < /dev/null');

		if($debug)
		{
			print 'Send to '.$run_param['email'].': '.$subject.'<br><br>';
		}
	}
}