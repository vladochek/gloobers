<?php
//echo $revenue_by_month;
drupal_add_js(drupal_get_path('module', 'services').'/js/fusioncharts.js'); 
drupal_add_js(drupal_get_path('module', 'services').'/js/fusioncharts.charts.js'); 
drupal_add_js(drupal_get_path('module', 'services').'/js/fusioncharts.theme.fint.js'); 
?>

<div class="revenue-month">
<div id="chart-container">FusionCharts will render here</div>

<div id='controllers'>
    <label><input name='chart-type' id='line' type='radio' value='line' /> Line chart</label>    
    <label><input name='chart-type' id='bar' type='radio' value='bar2d' /> Bar chart</label>   
    <label><input name='chart-type' id='column' type='radio' value='column2d' checked='true' /> Column chart</label>
    
</div>

</div>
<style>
body,.revenue-month{
    font-family: 'Helvetica Neue', Arial;
    font-size: 14px;
    font-weight: normal;
}
.revenue-month input[type=text] {
    max-width: 50px;
}
.revenue-month #controllers {
    position: inherit;
    width: 500px;
    padding: 0 140px;
}

.revenue-month #controllers label{
    padding: 0 5px;
}

</style>