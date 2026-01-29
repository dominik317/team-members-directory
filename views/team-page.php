<?php get_header(); ?>

<div class="team-members-page">
    <div class="team-members-container">
        <h1 class="team-members-title">Our Team</h1>

        <?php if ($query->have_posts()): ?>
            <div class="team-members-grid">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <?php
                    $post_id = get_the_ID();
                    $full_name = get_field('full_name', $post_id);
                    $role_title = get_field('role_title', $post_id);
                    $email = get_field('email', $post_id);
                    $photo = get_field('photo', $post_id);
                    $bio = get_field('bio', $post_id);
                    
                    include __DIR__ . '/team-member-card.php';
                    ?>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="team-members-empty">No team members found.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>