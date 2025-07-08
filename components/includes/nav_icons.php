<?php 
 $hamburger = get_field('hamburger', 'option');
?>

<?php if ($hamburger == 'one') { ?>

<div class="hamburger_wrap">
    <div class="hamburger icon" id="hamburger-1">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>
</div>

<?php } if ($hamburger == 'two') { ?>

<div class="hamburger icon" id="hamburger-2">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'three')  { ?>

<div class="hamburger icon" id="hamburger-3">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'four') { ?>

<div class="hamburger icon" id="hamburger-4">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'five') { ?>

<!-- doesn't work with scale? -->
<div class="hamburger icon" id="hamburger-5">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'six') { ?>

<div class="hamburger icon" id="hamburger-6">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'seven') { ?>

<div class="hamburger icon" id="hamburger-7">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'eight') { ?>


<div class="hamburger icon" id="hamburger-8">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'nine') { ?>

<div class="hamburger icon" id="hamburger-9">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'ten') { ?>

<div class="hamburger icon" id="hamburger-10">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } if ($hamburger == 'eleven') { ?>


<div class="hamburger icon" id="hamburger-11">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } else if ($hamburger == 'twelve') { ?>

<div class="hamburger icon" id="hamburger-12">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
</div>

<?php } ?>