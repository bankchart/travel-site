<div class='image-scope'>
    <img class='image-hide' alt='this is a image.'
        src='<?php echo Yii::app()->baseUrl; ?>/images/test/beach-vacation-people-sand.jpg' />
    <div class='loading-mask'></div>
</div>
<div style='border: 1px solid #000; padding: 20px;'>
    <form method='get' action='<?php echo Yii::app()->request->baseUrl; ?>/test/inputfiltertest'>
        <input type='text' name='myvar' />
        <button type='submit'>submit</button>
    </form>
</div>
