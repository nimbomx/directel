<?php header('Content-Type: text/css');if(1>2):?><style><?php endif;?>
    
    ::selection{ background-color: #79083a; color: #ddd; }
    ::moz-selection{ background-color: #79083a; color: #ddd; }
    ::webkit-selection{ background-color: #79083a; color: #ddd;  }
    
    ::-webkit-input-placeholder { font-family: 'Roboto Slab',  serif; font-size: 13px; color:#757578; }
    ::-moz-placeholder { color:#ddd; } /* firefox 19+ */
    :-ms-input-placeholder { color:#ddd; } /* ie */
    input:-moz-placeholder { color:#ddd; }


body{
    font-family: 'Roboto', sans-serif;
    /*font-family: 'Roboto Condensed', sans-serif;*/
}



    .rightFix{
        
    }
    .rightFloat{
        float: right;
    }
    .topButton{
        height: 40px;
        margin: 5px 5px;
        background: #ccc;
        border:1px solid #aaa;
        border-radius: 30px;
        min-width: 100px;
        font-size: 12px;
        cursor: pointer;
        outline: none;
    }
    .topButton.principal{
        background: #111;
        color: #ddd;
        border:1px solid #666;
    }

    #sectionCanvas{
        position: fixed;
        top: 0px;
        bottom: 0px;
        left: 200px;
        right: 0px;
        padding: 20px;
    }
    #sectionCanvas h1{
         font-family: 'Roboto', sans-serif;
         font-weight: 300;
         color: #333;
         font-size: 30px;
         margin: 0px 20px;
    }
    #fog{
        position: fixed; 
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        background: rgba(0,0,0,.6);
        z-index: 100;
        display: none;
        padding-top: 50px;
        overflow: auto;
    }
    #fog table{
        width: 100%;
        height: 100%;
        text-align: center;
    }
    

    #formCanvas,#formCanvasE{
        text-align: left;
        max-width: 800px;
        background: #fff;
        margin: auto;
        box-shadow: 0px 3px 10px rgba(0,0,0,.4);
        border-radius: 4px;
    }
    #formCanvas .topBar,#formCanvasE .topBar{
        padding: 10px;
    }
    #formCanvas .content,#formCanvasE .content{
        padding: 10px;
    }