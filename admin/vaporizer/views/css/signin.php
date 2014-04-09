<? header('Content-Type: text/css');if(1>2):?><style><?endif;?>
    
    ::selection{ background-color: #999; color: #ddd; }
    ::moz-selection{ background-color: #999; color: #ddd; }
    ::webkit-selection{ background-color: #999; color: #ddd;  }
    
    ::-webkit-input-placeholder { font-family: 'Roboto', sans-serif; font-size: 13px; color:#b7bac7; }
    ::-moz-placeholder { color:#b7bac7; } /* firefox 19+ */
    :-ms-input-placeholder { color:#b7bac7; } /* ie */
    input:-moz-placeholder { color:#b7bac7; }
    
    ::-webkit-scrollbar              { width: 12px; height: 12px; background: #666;  z-index: 100; }
/*::-webkit-scrollbar-button       { width: 20px; background: #000; }*/
::-webkit-scrollbar-track        {  background: #ddd; box-shadow: inset 0 0 5px rgba(0,0,0,.1); }
::-webkit-scrollbar-track-piece  { /* 4 */ }
::-webkit-scrollbar-thumb        {border-radius: 2px; background: #b7bac7; box-shadow: 0 0 10px rgba(0,0,0,.2);}
::-webkit-scrollbar-corner       { /*display: none;*/}
::-webkit-resizer                { /* 7 */ }

::-webkit-scrollbar-thumb:hover        { background: #9da1b4; box-shadow: 0 0 10px rgba(0,0,0,.6);} 

    .animateAll{
        transition:all .2s linear; 
        -o-transition:all .2s linear; 
        -moz-transition:all .2s linear; 
        -webkit-transition:all .2s linear;
    }
    html{
        height: 100%;
    }
    body{
        height: 100%;
        font-family: 'Open Sans', sans-serif;
        color: #9da1b4;
        margin: 0;
        font-weight: 300;
        
        background: center center no-repeat;
        background-size: cover;
        background-attachment: fixed;
        
    }
    #firstfog{
        background: #000;
        position: fixed;
        top: 0px;
        left:0px;
        right: 0px;
        bottom: 0px;
        z-index: -1;
    }

    #formContainer{
        position: fixed;
        top:20%;
        left: 0px;
        right: 0px;
        bottom:0px;
        text-align: center; 
        color: #fff; font-family: 'Roboto', sans-serif;
        font-weight: 300; font-size: 16px;

    }
    #formCanvas{
        display: none;
        width: 400px;
        margin: auto; 
        background: #111; 
        border-radius: 8px; 
        box-shadow: 0px 1px 30px rgba(0,0,0,.8);
        padding: 20px;
    }
    table{
        border-collapse: collapse;
        width: 100%;
        padding: 0;
        margin: 0;
    }
    a {
	color: #666;
        font-family: 'Roboto', sans-serif;
	font-size: 12px;
        background-color: transparent;
	font-weight: normal;
        text-decoration: none;
        transition:all .2s linear; 
        -o-transition:all .2s linear; 
        -moz-transition:all .2s linear; 
        -webkit-transition:all .2s linear;
    }
    a:hover{
        color: #fff;
    }
    a img{
        border: 0;
    }






    input{
        background: #fff;
        border: 1px solid #ccc;
        padding: 4px 15px;
        color: #9da1b4;
        outline: none;
        border-radius: 2px;
        font-size: 14px;
        width: 360px;
        margin-top: 10px;
        height: 30px;
    }
    
    input:hover{
        border: 1px solid #bbb;
    }
    input:focus{
        border: 1px solid #999;
    }
    input[type='checkbox']{
        margin-top: 0;
        background: transparent;
        border: 1px solid #ccc;
        display: inline; width: 15px; height: 15px; padding: 0; border: 0; vertical-align: -2px;
    }

    
    #firma{
        position: fixed; right: 10px; bottom: 5px; font-size: 14px;
        display: none;
    }
    

   

#formCanvas button{
    border: none;
    font-family: 'Roboto', sans-serif;
    background: #fff;
    color: #111;
    font-size: 11px;
    border-radius: 50px;
    height: 35px;
    padding: 10px;
    cursor: pointer;
    outline: none;
}
#formCanvas button:hover, #formCanvas button:focus{
    background: #ccc;
    color: #000;
}
#formCanvas .title{
    font-size: 14px;
    text-align: left;
    margin-bottom: 20px;
}
#formCanvas img{
    vertical-align: -2px;
    margin-right: 10px;
    height: 18px;
}
#formCanvas .stayLogged{
    vertical-align: top;
    padding-top: 20px;
    padding-bottom: 20px;
    font-weight: 400;
    font-size: 14px;
    text-align: left;
    line-height: 14px;
}
#formCanvas .stayLogged small{
    font-weight: normal;
    color: #666;
    font-size: 11px;
    
}
#formCanvas .right{
    line-height: 14px;
    padding-top: 20px;
    text-align: right;
    vertical-align: top;
}
#formCanvas .rightBottom{
    line-height: 14px;
    padding-top: 0px;
    text-align: right;
    vertical-align: top;
}