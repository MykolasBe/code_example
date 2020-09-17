<form <?php print html_attr(($data['attr'] ?? []) + ['method' => 'POST']); ?>>
    <?php if (isset($data['error'])) : ?>
        <p class="form-error"><?php print $data['error']; ?></p>
    <?php endif; ?>
    <?php foreach ($data['fields'] ?? [] as $field_id => $field): ?>
        <label>
            <span><?php print $field['label'] ?? ''; ?></span>
            <?php if (in_array($field['type'] ?? [], ['text', 'password', 'email', 'number', 'hidden'])): ?>
                <input <?php print input_attr($field_id, $field); ?>>
            <?php elseif (in_array($field['type'] ?? [], ['select'])): ?>
                <select <?php print select_attr($field_id, $field); ?>>
                    <?php foreach ($field['options'] as $option_id => $option): ?>
                        <option value="<?php print $option_id; ?>"
                            <?php print ($field['value'] == $option_id) ? 'selected' : ''; ?>>
                            <?php print $option; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php elseif (in_array($field['type'] ?? [], ['textarea'])): ?>
                <textarea <?php print textarea_attr($field_id, $field); ?>><?php
                    print $field['value'] ?? ''; ?></textarea>
            <?php elseif (in_array($field['type'] ?? [], ['radio'])): ?>
                <?php foreach ($field['options'] as $option_id => $radio):?>
                <label
                    <span><?php print $radio; ?></span>
                    <input
                        <?php print radio_attr($field_id, $option_id,$field);?>
                        <?php print ($option_id == $field['value']) ? 'checked' : '';?>>
                </label>
                <?php endforeach;?>
            <?php elseif (in_array($field['type'] ?? [], ['color'])): ?>
                <input <?php print html_attr(($field['extra']['attr'] ?? []) +
                [
                    'name' => $field_id,
                    'type' => $field['type'],
                    'value' => '#ff0000'
                ]); ?>>
            <?php endif; ?>
            <?php if (isset($field['error'])): ?>
                <span style="color: red"><?php print $field['error']; ?></span>
            <?php endif; ?>
        </label>
    <?php endforeach; ?>
    <?php foreach ($data['buttons'] ?? [] as $button_id => $button): ?>
        <button <?php print button_attr($button_id, $button); ?>>
            <?php print $button['text']; ?>
        </button>
    <?php endforeach; ?>
</form>