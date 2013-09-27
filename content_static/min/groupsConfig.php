<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 **/

return array(

    'master-css'        => array(
                                '//css/framework.css',
                                '//css/webyog.css',
                                '//css/colorbox/colorbox.css',
                                '//css/jReject/css/jquery.reject.css'
                           ),

    'master-js'         => array(
                                '//js/webyog.js',
                                '//js/jquery.1.7.js',
                                '//js/jquery.colorbox-min.js',
                                '//js/jquery.watermark.min.js',
                                '//js/jquery.data.js',
                                '//js/jReject/js/jquery.reject.js'
                            )

);
