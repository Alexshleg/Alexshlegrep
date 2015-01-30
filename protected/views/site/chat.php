<style>

    #chatbox {
        text-align:left;
        float: left;
        font-size: 11pt;
        margin:0 auto;
        margin-bottom:25px;
        padding:10px;
        background:#fff;
        height:360px;
        min-width: 630px;
        max-width:630px;
        border:1px solid #ACD8F0;
        overflow-y:auto;
        overflow-x:hidden;
    }
    #table {clear: left;max-width:630px;margin-top: -10px;}
    .td1 {width: 100px;text-align: center;}
    .td2_input {width: 300px;}
    .td3 {vertical-align: top;}
    .td4 {text-align: center;   }
    textarea {width: 500px; height: 60px; resize: none;}

</style>

<?=CHtml::form(); ?>
<div id="wrapper">
        <p>Welcome to Chat by MalMart, respected User! Enter your name and message, if you want take part in a conversation.</p>
    <div id="chatbox">
        <table>
            <script>
                function update()
                {
                    $.ajax({
                        url: "AjaxContent.php",
                        cache: false,
                        success: function(html){
                            $("#chatbox").html(html);
                        }
                    });
                }

                $(document).ready(function(){
                    update();
                    setInterval('update()',10000);
                });
            </script>
        </table>
    </div>
    <table id="table">
        <tr>
            <td class="td1"><?=CHtml::label('Name','username');  ?></td>
            <td><?=CHtml::textField('username','',array('class'=>'td2_input'));?></td>
            <td class="td3">
                <?=CHtml::ajaxSubmitButton('Отправить', '', array(
                        'type' => 'POST',
                        'update' => '#chatbox',
                    ),
                    array('type' => 'submit','class'=>'btn'));
                ?>
            </td>
        </tr>
        <tr>
            <td class="td4"><?=CHtml::Label('Message','message');  ?></td>
            <td colspan="2"><?=CHtml::textArea('message','',array('id'=>'message','class'=>'textarea'));?></td>
        </tr>
    </table>
</div>
<?=CHtml::endForm(); ?>
