<?php  
$request = 'icons.json';
$response = file_get_contents( $request );
$icons  = json_decode( $response, JSON_PRETTY_PRINT );
?>
<div class="add_i">
    <h3>Choose an icon <a class="close-login" href="#"><i class="fa fa-times"></i></a></h3>
    <h3 class="center">
        <input type="text" placeholder="Search for icon..." class="regular-text iconSearch">
    </h3>
    <div class="icons_set">
        <?php   
            foreach($icons['items'] as $ico){
                print '<a href="#" data-icon="'.$ico.'"><i class="fa fa-'.$ico.'"></i>';
            };
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="use_icon"><a class="button button-primary" href="#">Use this</a></div>
</div>