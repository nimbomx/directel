<? header('Content-Type: text/css');if(1>2):?><style><?endif;?>
    
    ::selection{ background-color: #79083a; color: #ddd; }
    ::moz-selection{ background-color: #79083a; color: #ddd; }
    ::webkit-selection{ background-color: #79083a; color: #ddd;  }
    
    ::-webkit-input-placeholder { font-family: 'Roboto Slab',  serif; font-size: 13px; color:#757578; }
    ::-moz-placeholder { color:#ddd; } /* firefox 19+ */
    :-ms-input-placeholder { color:#ddd; } /* ie */
    input:-moz-placeholder { color:#ddd; }

    body {
        margin: 0px;
        font-family: 'Roboto', sans-serif;
        color: #ddd;
    }
    #header{
        height:30px;
        background: #282828;
        padding: 5px 10px 0px 10px;
        position: relative;
    }
      
    
.version{
    color: #aaa;
    font-size: 10px;
    position: absolute;
    bottom: 0px;
    right: 10px;
}
	a {
		color: #15C;
		background-color: transparent;
		font-weight: normal;
                text-decoration: none;
	}
        a:hover{
            text-decoration: underline;
        }

	h1 {
		color: #444;
		background-color: transparent;
		font-size: 35px;
		font-weight: 400;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
                text-shadow: 0 0 4px #ddd;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
        .button{
        color: #fff;
        height: 30px;
        min-width: 70px;
        margin-right: 20px;
        border-radius: 4px;
        background: #333;
        border: 1px solid #666;
        cursor: pointer;
        
    }
    .button:hover{
        background: #111;
    }
    button.red{
        background: #990000;
        cursor: pointer;
    }
    

    
        #header .title{
            color: #ddd;
            font-size: 18px;
        }
        #header .tools{
            font-size: 13px; ;
            position: absolute; top: 1px; right: 10px;
        }
        #header .tools a{color:#ddd; text-decoration: none;}
        #header .tools a:hover{text-decoration: underline;}
        
        #perfilBtn{padding: 2px 8px; margin-right: 20px;
        }
        
        #toolBar{
            position: absolute; top: 50px;
            left: 0px;
            overflow: hidden;
            box-shadow: 2px 2px 10px #000;
        }
        #toolBar div{ text-align: center; padding: 8px; background: #fff; 
             cursor: pointer;
        }
        #toolBar div img{display: block; }
        #toolBar div.selected{
            position: relative;
            background: #eee;
            border-left: 4px solid #3b8c96;
            box-shadow: 0px 0px 10px #666;
            cursor: default;
            z-index: 3;
            padding: 8px 4px 8px 8px;
        }
	#body{
            position: fixed;
            z-index: 2;
            top: 50px;
            left: 40px;
            right: 10px;
            bottom: 10px;
            overflow: auto;
            padding: 15px;
            background: #eee;
            box-shadow: 2px 2px 10px #000;
	}
        #body .title{
            color: #333;
            font-size: 20px;
        }
	#body .active{
            position: absolute;
            top: 30px;
            left: 20px;
            right: 20px;
            bottom: 25px;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
                overflow: auto;
        }
        #body .active .listBtns{
            position: absolute;
            width: 2px;
            top: 0px;
            bottom: 0px;
            width: 20%;
            left: 0px;
            background: #eee;
            overflow: auto;

        }
        
         #body .active .listBtns div{
             height: 20px;
            padding: 5px;
            font-family: 'Open Sans', Arial, sans-serif;
            color: #666;
            cursor: default;
            font-size: 14px;
        }
        
        #body .active .listBtns div:hover{
            color: #eee;
            background: #333;
        }
         #body .active .listBtns div.selected{
            color: #fff;
            background: #333;
             border-left: 4px solid #3b8c96;
             padding-left: 10px;
        }
        #body .active .separador{
            position: absolute;
            width: 10px;
            top: 0px;
            bottom: 0px;
            left: 20%;
            /*cursor: e-resize;*/
            z-index: 3;
               
        }

        #body .controlls{
            position: absolute;
            height: 40px;
            left: 20px;
            right: 20px;
            bottom: 10px;
        }

	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}

        #undesarrollode{
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 11px;
        }

        /*FORMS*/
        #columnaPrincipal{
            position: absolute; top: 0px; left: 0px; right: 0%; bottom: 0px; overflow: auto;
        }

        /*ITEMS*/
        
        .item{
        
        padding: 3px 20px;
        margin: 0px -30px;
        position: relative;
        height: 20px;
        clear: both;
    }
    .item.subsec{
        
        padding: 3px 50px;
        margin: 0px -30px;
        position: relative;
        height: 20px;
        clear: both;
    }
    .item:hover{
        color:#fff;
        background: #333;
    }
    .item .activeN{
        cursor: pointer;
        float: left;
        padding: 0 20px;
    }
    .item .tools{
        color: #aaa;
        cursor: pointer;
        float: left;
        right: 50px;
        margin-left: 20px;
        padding: 0 10px;
        opacity: 0;
    -webkit-transition: opacity .3s ease-in;
    -moz-transition: opacity .3s ease-in;
    -o-transition: opacity .3s ease-in;
    -ms-transition: opacity .3s ease-in;
    transition: opacity .3s ease-in;
    }
    
    
    .item:hover .tools{
        opacity: 1;
    }

