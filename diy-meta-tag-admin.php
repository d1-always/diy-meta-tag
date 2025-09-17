<?php
/*
Plugin Name: DIY Meta Tag
Plugin URI: https://wordpress.org/plugins/diy-meta-tag/
Description: Admin functionalities for DIY Meta Tag plugin.
Author: sandy, lshfyy
Version: 1.0.1
Author URI: https://profiles.wordpress.org/lshfyy/profile/edit/group/1/
Text Domain: diy-meta-tag
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_action('add_meta_boxes', 'diymt_add_meta_box');
function diymt_add_meta_box() {
    add_meta_box(
        'diymt_meta_box',
        __('Meta Tag Manager', 'diy-meta-tag'),
        'diymt_meta_box_callback',
        ['post', 'page'],
        'side'
    );
}

function diymt_meta_box_callback($post) {
    wp_nonce_field('diymt_save_meta_box_data', 'diymt_meta_box_nonce');
    $meta_tags = get_post_meta($post->ID, 'diymt_data', true);
    if (is_serialized($meta_tags)) {
        $meta_tags = unserialize($meta_tags);
    }

    // 确保必需的meta tags存在并排序
    $default_tags = [
        ['type' => 'name', 'key' => 'cluster', 'value' => ''],
        ['type' => 'name', 'key' => 'keyword', 'value' => '']
    ];

    if (empty($meta_tags)) {
        $meta_tags = $default_tags;
    } else {
        $cluster_tag = null;
        $keyword_tag = null;
        foreach ($meta_tags as $tag) {
            if ($tag['key'] === 'cluster') {
                $cluster_tag = $tag;
            }
            if ($tag['key'] === 'keyword') {
                $keyword_tag = $tag;
            }
        }

        $filtered_tags = array_filter($meta_tags, function($tag) {
            return !in_array($tag['key'], ['cluster', 'keyword']);
        });

        $required_tags = [
            $cluster_tag ?? $default_tags[0],
            $keyword_tag ?? $default_tags[1]
        ];
        
        $meta_tags = array_merge($required_tags, $filtered_tags);
    }
    ?>
    <div id="diymt_meta_tags">
        <?php foreach ($meta_tags as $index => $tag) : ?>
            <?php if($tag['key'] === 'cluster' || $tag['key'] === 'keyword'): ?>
            <div class="diymt_meta_tag">
                <label for="diymt_meta_tags_<?php echo $index; ?>_value"><?php echo esc_attr($tag['key']); ?></label>
                <input type="hidden" name="diymt_meta_tags[<?php echo $index; ?>][type]" value="<?php echo esc_attr($tag['type']); ?>" />
                <input type="hidden" name="diymt_meta_tags[<?php echo $index; ?>][key]" value="<?php echo esc_attr($tag['key']); ?>" />
                <input type="text" 
                    id="diymt_meta_tags_<?php echo $index; ?>_value"
                    name="diymt_meta_tags[<?php echo $index; ?>][value]" 
                    value="<?php echo esc_attr($tag['value']); ?>" 
                    placeholder="Value" />
            </div>
            <?php else: ?>
            <div class="diymt_meta_tag">
                <select name="diymt_meta_tags[<?php echo $index; ?>][type]">
                    <option value="name" <?php selected($tag['type'], 'name'); ?>>Name</option>
                    <option value="property" <?php selected($tag['type'], 'property'); ?>>Property</option>
                </select>
                <input type="text" name="diymt_meta_tags[<?php echo $index; ?>][key]" value="<?php echo esc_attr($tag['key']); ?>" placeholder="Key" />
                <input type="text" name="diymt_meta_tags[<?php echo $index; ?>][value]" value="<?php echo esc_attr($tag['value']); ?>" placeholder="Value" />
                <button type="button" class="remove-meta-tag">Remove</button>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-meta-tag">Add Meta Tag</button>
    <script>
        document.getElementById('add-meta-tag').addEventListener('click', function() {
            var container = document.getElementById('diymt_meta_tags');
            var index = container.children.length;
            var div = document.createElement('div');
            div.className = 'diymt_meta_tag';
            div.innerHTML = `
                <select name="diymt_meta_tags[${index}][type]">
                    <option value="name">Name</option>
                    <option value="property">Property</option>
                </select>
                <input type="text" name="diymt_meta_tags[${index}][key]" placeholder="Key" />
                <input type="text" name="diymt_meta_tags[${index}][value]" placeholder="Value" />
                <button type="button" class="remove-meta-tag">Remove</button>
            `;
            container.appendChild(div);
            div.querySelector('.remove-meta-tag').addEventListener('click', function() {
                div.remove();
            });
        });
        document.querySelectorAll('.remove-meta-tag').forEach(function(button) {
            button.addEventListener('click', function() {
                button.parentElement.remove();
            });
        });
    </script>
    <style>
        .diymt_meta_tag {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f7f7f7;
            border-radius: 5px;
        }
        .diymt_meta_tag label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .diymt_meta_tag input,
        .diymt_meta_tag select {
            width: calc(100% - 10px);
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .remove-meta-tag {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .remove-meta-tag:hover {
            background-color: #ff1a1a;
        }
    </style>
    <?php
}

add_action('save_post', 'diymt_save_meta_box_data');
function diymt_save_meta_box_data($post_id) {
    if (!isset($_POST['diymt_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['diymt_meta_box_nonce'], 'diymt_save_meta_box_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (!isset($_POST['diymt_meta_tags'])) {
        return;
    }
    $meta_tags = array_map(function($tag) {
        return [
            'type' => sanitize_text_field($tag['type']),
            'key' => sanitize_text_field($tag['key']),
            'value' => sanitize_text_field($tag['value']),
        ];
    }, $_POST['diymt_meta_tags']);
    update_post_meta($post_id, 'diymt_data', serialize($meta_tags));
}