<?php
/**
 * Multiple short texts question, item text area Html
 * @var $extraclass
 * @var $sDisplayStyle
 * @var $prefix
 * @var $myfname
 * @var $labelText                  $ansrow['question']
 * @var $prefix
 * @var $kpclass
 * @var $rows                       $drows.' '.$maxlength
 * @var $checkconditionFunction     $checkconditionFunction.'(this.value, this.name, this.type)'
 * @var $dispVal
 * @var $suffix
 */
?>
<!-- Multiple short texts question, item text area Html -->
<!-- question attribute "display_rows" is set -> we need a textarea to be able to show several rows -->
<div class="question-item answer-item text-item <?php echo $extraclass;?>" <?php echo $sDisplayStyle;?>>
    <div  class="form-group row">
        <label class='control-label col-xs-12 col-sm-<?php echo $sLabelWidth; ?>' for="answer<?php echo $myfname; ?>">
            <?php echo $labelText;?>
        </label>
        <div class="col-xs-12 col-sm-<?php echo $sInputContainerWidth; ?>">
            <?php echo $prefix;?>
            <textarea
                class="form-control  textarea <?php echo $kpclass;?>"
                name="<?php echo $myfname;?>"
                id="answer<?php echo $myfname;?>"
                rows="<?php echo $rows;?>"
                <?php echo $maxlength;?>
                onkeyup="<?php echo $checkconditionFunction; ?>"
            >
                <?php echo $dispVal;?>
            </textarea>
            <?php echo $suffix;?>
        </div>
    </div>
</div>
