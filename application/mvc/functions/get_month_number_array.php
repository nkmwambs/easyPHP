<?php
function get_month_number_array(){
    $month_array_names = array(
                                                'January',
                                                'February',
                                                'March',
                                                'April',
                                                'May',
                                                'June',
                                                'July',
                                                'August',
                                                'September',
                                                'October',
                                                'November',
                                                'December'
                                                );
$month_array_nums = range(1,12);
$month_array = array_combine($month_array_nums,$month_array_names);
return $month_array;
}
?>