<?php
// Custom helper class that contains the common function to be used in entire application

namespace App\Helpers;

class Helper
{
	/**
     * Function to get the text for the status defined in the system
     * @param integer
     * @return string
     */
    public static function getStatusText($status = 0)
    {
		$statusText = 'Inactive';
		
		if( $status == '1' )
		{
			$statusText = 'Active';
		}
		else if( $status == '2' )
		{
			$statusText = 'Deleted';
		}

		return $statusText;
    }

    /**
     * Function to trim a given string after certain number of characters with smart wrapping
     * @param string
     * @param integer
     * @param string
     * @return string
     */
    public static function truncateString($string, $length=20, $append = " ...")
	{
		$string = trim($string);

		if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n", $string, 2);
		$string = $string[0] . $append;
		}

		return $string;
	}
}