<?php
/**
* Multiple short texts question, item input text Html

* @var $question $ansrow['question']
* @var $alert
* @var $extraclass
* @var $sDisplayStyle
* @var $myfname
* @var $tiwidth
* @var $prefix
* @var $suffix
* @var $kpclass
* @var $maxlength
* @var $dispVal
* @var $checkconditionFunction     $checkconditionFunction.'(this.value, this.name, this.type);"
*/
?>
<!--item_inputtext -->
<div class="question-item answer-item text-item <?php echo $extraclass;?>" <?php echo $sDisplayStyle;?> >
    <?php if($alert):?>
        <!--  color code missing mandatory questions red -->
        <div class="alert alert-danger errormandatory" role="alert">
            <?php echo $question; ?>
        </div>
    <?php endif;?>

    <div class="form-group row">
        <label class='control-label col-xs-12 col-sm-<?php echo $sLabelWidth; ?>' for="answer<?php echo$myfname;?>">
            <?php echo $question; ?>
        </label>
        <div class="col-xs-12 col-sm-<?php echo $sInputContainerWidth; ?>">
            <?php echo $prefix; ?>
            <input
                class="text <?php echo $kpclass; ?> form-control"
                type="text"
                size="<?php echo $tiwidth; ?>"
                name="<?php echo $myfname; ?>"
                id="answer<?php echo $myfname; ?>"
                value="<?php echo $dispVal; ?>"
                onkeyup="<?php echo $checkconditionFunction; ?>"
                <?php echo $maxlength; ?>
                />
            <?php echo $suffix; ?>
        </div>
    </div>
</div>
