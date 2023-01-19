<div id="aggregate" class="top_bar">
    <p>Aggregate<a class="show_search down">&nbsp;</a></p>
    <?php
    if (!isset($this_is_report)) {
        echo '<form method="post">';
    }
    echo '<ul>';
    echo '<li>';
    ?>
    <select name="aggregate_function[]">
        <option value="">---Select---</option>
        <option value="Group By">Group By</option>
        <option value="Max">Max()</option>
        <option value="Min">Min()</option>
        <option value="Sum">Sum()</option>
        <option value="Count">Count()</option>
        <option value="Avg">Average ()</option>

    </select>
    <?php
    echo '<select name="aggregate_filed[]">';
    echo '<option value="">---Select---</option>';
    if (isset($header_info)) {
        foreach ($header_info as $key => $value) {
            if (isset($this_is_report)) {
                echo '<option Value="' . $value . '">' . preg_replace('/(_)/', ' ', $key) . '</option>';
            } else {
                echo '<option>' . $key . '</option>';
            }
        }
    }
    echo '</select>';
    ?>
    <a class="ui-state-default ui-corner-all add_more" href="#">
        <span class="ui-icon ui-icon-circle-plus"></span><span>Add More</span>
    </a>
    <?php
    echo '</li>';

    echo '</ul>';
    echo '<input name="Aggregate" type=submit value="Generate Aggrigate"/>';

    if (!isset($this_is_report)) {
        echo '</form>';
    }
    ?>
</div>