<div id="search_bar" class="top_bar">
    <p>Filter<a class="show_search down">&nbsp;</a></p>
    <?php
    echo '<ul>';
    echo '<li>';
    echo '<select name="filed_name[]">';
    echo '<option value="">---Select---</option>';
    if (isset($header_info)) {
        foreach ($header_info as $key => $value) {
            if (isset($this_is_report)) {
                echo '<option Value="' . $value . '">' . preg_replace('/(_)/', ' ', $key) . '</option>';
            } else {
                echo '<option  Value="' . $key . '">' . preg_replace('/(_)/', ' ', $key) . '</option>';
            }
        }
    }
    echo '</select>';
    ?>
    <select name="operator[]">
        <option value="">---Select---</option>
        <option value="Like">Contain</option>
        <option value="=">Equals To</option>
        <option value="!=">Not Equals To</option>
        <option value=">">Grater Than From</option>
        <option value=">=">Grater Than or Equals To</option>
        <option value="<">Less Than From</option>
        <option value="<=">Less Than or Equals To</option>

    </select>
    <input type="text" name="value[]">
    <a class="ui-state-default ui-corner-all add_more" href="#">
        <span class="ui-icon ui-icon-circle-plus"></span><span>Add More</span>
    </a>
    <?php
    echo '</li>';

    echo '</ul>';
    echo '<input type=submit value="Search"/>';
    ?>
</div>