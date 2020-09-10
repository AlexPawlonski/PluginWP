<?php

$contact_phone = $this->get_contact_list();

?>

<h2>CEFii Contact</h2>

<?php _e('List of people to call back: ', 'cefii-contact')?>

<?php
if($contact_phone != null){
    ?>
    <table>
        <thead>
            <tr>
                <th><?php _e('Name', 'cefii-contact')?></th>
                <th><?php _e('Phone', 'cefii-contact')?></th>
                <th><?php _e('Remove', 'cefii-contact')?></th>
            </tr> 
        </thead>
        <tbody>
            <?php
                foreach($contact_phone as $value){
                    ?><tr id ="contact-<?php echo $value->id?>">
                        <input hidden class="idphone" value="<?php echo $value->id?>">
                        <td>
                            <?php echo $value->name?>
                        </td>
                        <td>
                            <?php echo $value->phone?>
                        </td>
                        <td>
                           <span data-id="<?php echo $value->id; ?>" class="delete dashicons dashicons-trash"></span>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <div id="result"></div>
    <?php
}else{
    _e('you don\'t have anyone to call back.', 'cefii-contact');
}

?>