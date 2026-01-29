
<div class="team-member-card">
    <?php if ($photo): ?>
        <div class="team-member-photo">
            <img src="<?php echo esc_url($photo['url']); ?>" 
                 alt="<?php echo esc_attr($full_name); ?>"
                 width="<?php echo esc_attr($photo['width']); ?>"
                 height="<?php echo esc_attr($photo['height']); ?>">
        </div>
    <?php endif; ?>

    <div class="team-member-info">
        <h3 class="team-member-name"><?php echo esc_html($full_name); ?></h3>
        
        <?php if ($role_title): ?>
            <p class="team-member-role"><?php echo esc_html($role_title); ?></p>
        <?php endif; ?>

        <?php if ($bio): ?>
            <div class="team-member-bio"><?php echo wp_kses_post($bio); ?></div>
        <?php endif; ?>

        <?php if ($email): ?>
            <p class="team-member-email">
                <a href="mailto:<?php echo esc_attr($email); ?>">
                    <?php echo esc_html($email); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>