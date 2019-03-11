<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
        #confirmOverlay{
            width:100%;
            height:100%;
            position:fixed;
            top:0;
            left:0;
            background:url('ie.png');
            background: -moz-linear-gradient(rgba(11,11,11,0.1), rgba(11,11,11,0.6)) repeat-x rgba(11,11,11,0.2);
            background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(11,11,11,0.1)), to(rgba(11,11,11,0.6))) repeat-x rgba(11,11,11,0.2);
            z-index:100000;
        }

        #confirmBox{
            background:url('body_bg.jpg') repeat-x left bottom #e5e5e5;
            width:460px;
            position:fixed;
            left:50%;
            top:50%;
            margin:-130px 0 0 -230px;
            border: 1px solid rgba(33, 33, 33, 0.6);

            -moz-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            -webkit-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
        }

        #confirmBox h1,
        #confirmBox p{
            font:26px/1 'Cuprum','Lucida Sans Unicode', 'Lucida Grande', sans-serif;
            background:url('header_bg.jpg') repeat-x left bottom #f5f5f5;
            padding: 18px 25px;
            text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.6);
            color:#666;
        }

        #confirmBox h1{
            letter-spacing:0.3px;
            color:#888;
        }

        #confirmBox p{
            background:none;
            font-size:16px;
            line-height:1.4;
            padding-top: 35px;
        }

        #confirmButtons{
            padding:15px 0 25px;
            text-align:center;
        }

        #confirmBox .button{
            display:inline-block;
            background:url('buttons.png') no-repeat;
            color:white;
            position:relative;
            height: 33px;

            font:17px/33px 'Cuprum','Lucida Sans Unicode', 'Lucida Grande', sans-serif;

            margin-right: 15px;
            padding: 0 35px 0 40px;
            text-decoration:none;
            border:none;
        }

        #confirmBox .button:last-child{ margin-right:0;}

        #confirmBox .button span{
            position:absolute;
            top:0;
            right:-5px;
            background:url('buttons.png') no-repeat;
            width:5px;
            height:33px
        }

        #confirmBox .blue{              background-position:left top;text-shadow:1px 1px 0 #5889a2;}
        #confirmBox .blue span{         background-position:-195px 0;}
        #confirmBox .blue:hover{        background-position:left bottom;}
        #confirmBox .blue:hover span{   background-position:-195px bottom;}

        #confirmBox .gray{              background-position:-200px top;text-shadow:1px 1px 0 #707070;}
        #confirmBox .gray span{         background-position:-395px 0;}
        #confirmBox .gray:hover{        background-position:-200px bottom;}
        #confirmBox .gray:hover span{   background-position:-395px bottom;}
    </style>
</head>
<body>

<button id="btn">click me</button>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btn').click(function(){
            var elem = $(this).closest('.item');
            $.confirm({
                'title'     : 'Delete Confirmation',
                'message'   : 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
                'buttons'   : {
                    'FLDJSLGJ'   : {
                        'class' : 'blue',
                        'action': function(){
                            alert('gdlsajgd');
                        }
                    },
                    'No'    : {
                        'class' : 'gray',
                        'action': function(){}  // Nothing to do in this case. You can as well omit the action property.
                    }
                }
            });
        });
    });

    (function($){
        $.confirm = function(params){
            if($('#confirmOverlay').length){
                return false;
            }
            var buttonHTML = '';
            $.each(params.buttons,function(name,obj){
                // Generating the markup for the buttons:
                buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';
                if(!obj.action){
                    obj.action = function(){};
                }
            });

            var markup = [
                '<div id="confirmOverlay">',
                '<div id="confirmBox">',
                '<h1>',params.title,'</h1>',
                '<p>',params.message,'</p>',
                '<div id="confirmButtons">',
                buttonHTML,
                '</div></div></div>'
            ].join('');

            $(markup).hide().appendTo('body').fadeIn();

            var buttons = $('#confirmBox .button'),
                i = 0;

            $.each(params.buttons,function(name,obj){
                buttons.eq(i++).click(function(){

                    // Calling the action attribute when a
                    // click occurs, and hiding the confirm.

                    obj.action();
                    $.confirm.hide();
                    return false;
                });
            });
        }
        $.confirm.hide = function(){
            $('#confirmOverlay').fadeOut(function(){
                $(this).remove();
            });
        }
    })(jQuery);
</script>
</body>
</html>