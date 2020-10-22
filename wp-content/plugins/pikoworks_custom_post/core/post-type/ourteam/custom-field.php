<div class="outteam_meta_control">
    <p style="float:right">
        <a href="#" class="dodelete-ourteam button"><?php esc_attr_e('Remove All', 'pikoworks_custom_post'); ?></a>
    </p>
    <div style="clear: both;margin-bottom: 15px;" ></div>
    <?php while($mb->have_fields_and_multi('ourteam',array('length' => 2))): ?>
        <?php $mb->the_group_open(); ?>
        <a href="#" class="dodelete button"><?php esc_attr_e('Remove', 'pikoworks_custom_post'); ?></a>
        <?php $mb->the_field('socialName'); ?>
        <label><?php esc_html_e('Name', 'pikoworks_custom_post'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('socialLink'); ?>
        <label><?php esc_html_e('Link', 'pikoworks_custom_post'); ?></label>
        <input class="form-control" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>

        <?php $mb->the_field('socialIcon'); ?>
        <label><?php esc_html_e('Icon', 'pikoworks_custom_post'); ?></label>
        <input class="form-control input-icon" type="text" name="<?php esc_attr($mb->the_name()); ?>" value="<?php esc_attr($mb->the_value()); ?>"/>
        <i><?php esc_html_e('Use front awesome icon Class: Example: fa fa-facebook or fa fa-twitter etc', 'pikoworks_custom_post'); ?></i>
        <span><?php esc_html_e('Get front Awesome Class:', 'pikoworks_custom_post') ;?> <a href="http://fontawesome.io/icons/" target="_blank"><?php esc_attr_e('Click', 'pikoworks_custom_post'); ?></a></span>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-ourteam button"><?php esc_html_e('Add Social', 'pikoworks_custom_post'); ?></a>
    </p>
</div>
<style>
    .outteam_meta_control .description { display:none; }
    .outteam_meta_control label{ display:block; font-weight:bold; margin:6px; margin-bottom:0; margin-top:12px; }
    .outteam_meta_control label span { display:inline; font-weight:normal; }
    .outteam_meta_control span{ color:#999; display:block; }
    .outteam_meta_control textarea, .outteam_meta_control input[type='text']{ margin-bottom:3px; width:99%; }
    .outteam_meta_control h4{ color:#999; font-size:1em; margin:15px 6px; text-transform:uppercase; }
    .wpa_group.wpa_group-ourteam { border: 1px solid #ccc; padding: 10px; margin: 0 15px 15px 0; background: #fff; width: 20%; float: left;}
</style>
<script type="text/javascript">
    jQuery(function(){
        "use strict";
        jQuery('#wpa_loop-ourteam').sortable();
    });
</script>