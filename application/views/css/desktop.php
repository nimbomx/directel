<?php
header('Content-Type: text/css');
if (1 > 2):
?><style><?php endif; ?>

    ::selection{ background-color: #000; color: white; }
    ::moz-selection{ background-color: #000; color: white; }
    ::webkit-selection{ background-color: #000; color: white; }


    .animateAll{
        transition:all .2s linear; 
        -o-transition:all .2s linear; 
        -moz-transition:all .2s linear; 
        -webkit-transition:all .2s linear;
    }
    html,body{
        padding: 0px;
        margin: 0px;
        height: 100%;
    }

    h1{
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
        font-size: 27px;
        color: rgb( 124,124,124 );
    }