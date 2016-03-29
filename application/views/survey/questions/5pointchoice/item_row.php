<?php
/**
 * 5 point choice Html : item row
 *
 * @var $ia
 * @var $fp
 * @var $checkedState
 * @var $checkconditionFunction
 */
?>
<!-- 5 point choice item -->
<div class="col-xs-12 col-sm-2 col-md-1 answer-item radio-item">
    <input
        class="radio"
        type="radio"
        name="<?php echo $ia[1]; ?>"
        id="answer<?php echo $ia[1].$fp; ?>"
        value="<?php echo $fp;?>"
        <?php echo $checkedState; ?>
        onclick="<?php echo $checkconditionFunction; ?>(this.value, this.name, this.type)"
    />
    <label for="answer<?php echo $ia[1].$fp; ?>" class="answertext radio-label">
        <?php echo $fp; ?>
    </label>
</div>
