<?php
/**
Contains Debug Class.
PHP version 5
@category Folder_Class
@package Histou
@author Philip Griesbacher <griesbacher@consol.de>
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@link https://github.com/Griesbacher/histou
**/
require_once 'histou/row.php';
/**
Debug Class.
PHP version 5
@category Folder_Class
@package Histou
@author Philip Griesbacher <griesbacher@consol.de>
@license http://opensource.org/licenses/gpl-license.php GNU Public License
@link https://github.com/Griesbacher/histou
**/
class Debug
{
    private static $_enabled = false;
    private static $_log = array();
    private static $_booleanArray = array(false => 'false', true => 'true');


    /**
    Returns if debug is enabled or not.
    @return boolean
    **/
    public static function isEnable()
    {
        return static::$_enabled;
    }

    /**
    Enables the debug output.
    @return null
    **/
    public static function enable()
    {
        static::$_enabled = true;
    }

    /**
    Adds a line to the output.
    @param string $line line to add to log.
    @return null
    **/
    public static function add($line)
    {
        array_push(static::$_log, $line."\n");
    }

    /**
    Returns the log in markdownformat.
    @return string
    **/
    public static function getLogAsMarkdown()
    {
        $output = '';
        foreach (static::$_log as $line) {
            $output .= sprintf(
                "####%s",
                substr(str_replace("\n", "\n####", $line), 0, -4)
            );
        }
        return $output;
    }

    /**
    Creates a new Markdown row.
    @param string $message contains the body.
    @param string $header  could contain the headline.
    @return object
    **/
    public static function genMarkdownRow($message, $header = '')
    {
        $panel = new TextPanel('');
        $panel->setMode(TextPanel::MARKDOWN);
        $panel->setContent($message);
        $row = new Row($header);
        $row->addPanel($panel);
        return $row;
    }

    /**
    Creates a new Markdown dashboard.
    @param string $message contains the body.
    @return object
    **/
    public static function errorMarkdownDashboard($message)
    {
        $dashboard = new Dashboard('Error');
        $dashboard->addRow(
            static::genMarkdownRow($message, 'ERROR')
        );
        return $dashboard;
    }

    /**
    Prints a boolean as string.
    @param boolean $bool boolean to print
    @return string
    **/
    public static function printBoolean($bool)
    {
        return static::$_booleanArray[$bool];
    }
}