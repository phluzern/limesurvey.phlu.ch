<?php
/**
 * @var $label
 * @var $ld
 * @var $myfname
 * @var $ld
 * @var $CHECKED
 * @var $checkconditionFunction
 */
?>

<td data-title='<?php echo $label;?>' class="answer-cell-3 answer_cell_00<?php echo $ld;?> answer-item radio-item">
    <label for="answer<?php echo $myfname;?>-<?php echo $ld; ?>">
        <input
            class="radio"
            type="radio"
            name="<?php echo $myfname;?>"
            value="<?php echo $ld; ?>"
            id="answer<?php echo $myfname;?>-<?php echo $ld; ?>"
            <?php echo $CHECKED; ?>
            onclick="<?php echo $checkconditionFunction; ?>(this.value, this.name, this.type)"
        />
    </label>
</td>
