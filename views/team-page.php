<?php 
use TeamMembersDirectory\Controllers\TeamMemberController;

get_header(); 
?>

<div class="team-members-page">
    <div class="team-members-container">
        <h1 class="team-members-title">Our Team</h1>

        <?php echo TeamMemberController::renderGrid($query); ?>
    </div>
</div>

<?php get_footer(); ?>