<? header('Content-Type: text/css');if(1>2):?><style><?endif;?>
    
    ::selection{ background-color: #79083a; color: #ddd; }
    ::moz-selection{ background-color: #79083a; color: #ddd; }
    ::webkit-selection{ background-color: #79083a; color: #ddd;  }
    
    ::-webkit-input-placeholder { font-family: 'Roboto Slab',  serif; font-size: 13px; color:#757578; }
    ::-moz-placeholder { color:#ddd; } /* firefox 19+ */
    :-ms-input-placeholder { color:#ddd; } /* ie */
    input:-moz-placeholder { color:#ddd; }
    

  
::-webkit-scrollbar              { width: 12px; background: #666;  z-index: 100; }
/*::-webkit-scrollbar-button       { width: 20px; background: #000; }*/
::-webkit-scrollbar-track        {  background: #353535; border-left:1px solid #222;}
::-webkit-scrollbar-track-piece  { /* 4 */ }
::-webkit-scrollbar-thumb        { border-radius: 2px; background: #282828; border-left:1px solid #222;}
::-webkit-scrollbar-corner       { display: none;}
::-webkit-resizer                { /* 7 */ }

::-webkit-scrollbar-thumb:hover        { background: #79083a; } 



    .animateAll{
        transition:all .2s linear; 
        -o-transition:all .2s linear; 
        -moz-transition:all .2s linear; 
        -webkit-transition:all .2s linear;
    }
    #labels{
        position: fixed;
        top: 35px;
        left: 0px;
        right: 0px;
        height: 24px;
        padding-top: 5px;
        border-bottom: 1px solid #000;
        background: #79083a;
        z-index: 1000;
    }
    #labels a{
        color: #fff;
        margin: 3px 10px;
        font-family: 'Roboto Condensed', sans-serif;
        cursor: pointer;
    }
    #content{
        position: fixed;
        top: 65px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        background: #474747;
        z-index: 1000;
    }

    #content .leftBar{
        font-family: 'Roboto', sans-serif;
        color: #ddd;
        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        width: 200px;
    }
    #content .leftBar h1{
        font-family: 'Roboto Condensed', sans-serif;
        color: #eee;
        text-shadow: none;
        font-size: 28px;
    }
    #content .leftBar .item{
        padding: 1px 20px;
        margin: 0;
        cursor: pointer;
        font-size: 14px;
        
    }
    #contentCanvas{
        background: #282828;
        font-family: 'Roboto', sans-serif;
        color: #ddd;
        position: absolute;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left: 200px;
        
    }

    #optionsCanvas{
        position: absolute;
       overflow: auto;
       top: 0px;
        left: 0px;
        bottom: 0px;
        width: 100%;
    }
    #optionsCanvas table{
        height: auto;
    }
    #formCanvas{
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        background: #474747;
        width: 0px;
        z-index: 1001;
    }
    #formCanvas .scrollable{
        overflow: auto;
    }
    .canvas h1{
        font-family: 'Roboto', sans-serif;
        font-weight: normal;
        text-shadow: none;
        font-size: 20px;
    }
    .canvas .highBar{
        background: #353535; color: #bbb4cf;
        padding: 30px;
        font-size: 12px;
    }
    .canvas .highBar h1{
        color: #bbb4cf;
        font-size: 25px;
        margin: 0;
        padding: 0;
        line-height: 25px;
    }
    .canvas button{
        font-weight: normal;
    }
    
    body{
        font-family: 'Roboto', sans-serif;
        color: #ddd;
        margin: 0;
        font-weight: 400;
    }

    a {
	color: #8d4766;
        font-family: 'Roboto Slab', serif;
	background-color: transparent;
	font-weight: normal;
        text-decoration: none;
    }
    a:hover{
        text-decoration: underline;
    }
    a img{
        border: 0;
    }

    table{
        border: 0;
        padding: 0;
        margin: 0;
        border-collapse: collapse;
        width: 100%;
        height: 100%;
    }

    

    #redBar a{
        color: #ddd;
        font-size: 12px;
        margin: 0px 10px;
    }
    #bottomBar a{
        font-size: 13px;
        margin: 0px 10px;
    }
    
    #undesarrollode{
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-size: 11px;
    }
    button{
        background: #535358;
        border: none;
        border-radius: 5px;
        color: #ddd;
        font-family: 'Roboto Condensed', sans-serif;
        min-width: 100px;
        min-height: 30px;
        box-shadow: 1px 1px 3px rgba(0,0,0,.4);
        font-size: 14px;
        cursor: pointer;
        padding: 0px 15px;
    }
    button:hover{
        background: #666;
    }
    form{
        text-align: right;
        width: 520px;
        margin: auto;
        font-size: 12px;
    }
    input, textarea{
        background: transparent;
        border: 1px solid #757578;
        padding: 8px 15px;
        color: #ddd;
        outline: none;
        border-radius: 5px;
        font-size: 14px;
        width: 300px;
        font-family: 'Roboto', sans-serif;
         vertical-align:auto ;
    }
    label{
        padding: 0px 15px;
    }
    textarea{
       vertical-align:top ;
    }
    input:focus, textarea:focus{
        border: 1px solid #ddd;

    }
    input[type='checkbox']{
        background: transparent;
        display: inline; width: 15px; height: 15px; padding: 0; border: 0; vertical-align: -2px;
    }

    
    
    

        


        
        
        #fog{
            background: #000;
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            bottom: 0px;
            display: none;
            z-index: 1000;
        }
        #prompt{
            z-index: 1001;
            display: none;
            position: fixed;
            top: 45%;
            left: 50%;
            width: 400px;
            height: 200px;
            margin-top: -100px;
            margin-left: -200px;
            background: #3d3d42;
            box-shadow: 2px 2px 10px #000;
        }
        #prompt .header{
            position: absolute;
            top: 0px;
            width: 100%;
        }
        #prompt .title{
            font-family: 'Roboto', sans-serif;
            color: #ddd;
            text-align: center;
            margin-top: 10px;
            font-size: 16px;
        }
         #prompt .content{
             font-family: 'Roboto', sans-serif;
             padding: 20px;
            color: #ddd;
            font-size: 14px;
        }
        #prompt .close{
            position: absolute;
            top: 0px;
            right: 8px;
            cursor: pointer;
            padding: 5px;
            font-size: 15px;
        }
        #prompt .close:hover{
            color: #000;
        }
        #prompt b{
            font-weight: 500;
            font-size: 15px;
            color: #eee;
        }

