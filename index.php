<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        #confirmOverlay {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index:100000;
            background-color: #000;
            opacity: 0.5;
        }
        #confirmBox{
            background-color: #fff;
            width:350px;
            position:fixed;
            left:50%;
            top:20%;
            margin:-130px 0 0 -230px;
            border: 1px solid rgba(33, 33, 33, 0.6);
            -moz-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            -webkit-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
        }

        #confirmBox h1,
        #confirmBox p{
            padding: 3px 25px;
            text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.6);
            line-height: 21px;
        }

        #confirmBox h1{
            letter-spacing:0.3px;
            font-size: 21px;
        }
        #confirmButtons{
            padding:3px 0 12px;
            text-align:center;
        }

        #confirmBox .button{
            display:inline-block;
            background: #7b7a7a;
            color:#fff;
            position:relative;
            margin: 2px 15px;
            padding: 5px 15px;
            text-decoration:none;
            border:none;
        }
        #confirmBox .button:hover{background-color:#596d4e}
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