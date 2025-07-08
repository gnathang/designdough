<?php

$background_colour = get_sub_field('background_colour');
$before_image = get_sub_field('before_image');
$after_image = get_sub_field('after_image');

?>

<section class="section_before_after_slider" style="background-color:<?= $background_colour; ?>">
    <div class="container">
        <div class="inset">
            <div id="comparison">
                <figure style="background-image: url(<?php echo $before_image['url']; ?>);">
                    <div id="handle"></div>

                    <div style="background-image: url(<?php echo $after_image['url']; ?>);" id="divisor">

                    </div>


                </figure>
                <input class="handle" type="range" min="0" max="100" value="50" id="reveal_slider"
                    oninput="moveDivisor()">
            </div>
            <div class="before_after">
                <h4>Before</h4>
                <h4>After</h4>
            </div>
        </div>
    </div>
</section>

<script>
var divisor = document.getElementById("divisor"),
    handle = document.getElementById("handle"),
    slider = document.getElementById("reveal_slider");

function moveDivisor() {
    handle.style.left = slider.value + "%";
    divisor.style.width = slider.value + "%";
}

window.onload = function() {
    moveDivisor();
};
</script>