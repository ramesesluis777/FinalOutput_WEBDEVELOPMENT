<?php
include '../init.php';
$user_id = $_SESSION['user_id'];
$u_id = 1;
$flag = true;
if (isset($_POST['retweetby']) && !empty($_POST['retweetby'])) {
    $tweet_id = $_POST['retweetby'];
    // $user       = UserDBConnector::getData($user_id);
    $users = PostDBConnector::usersRetweeeted($tweet_id);
    $headline = "Retweeted by";

} else if (isset($_POST['likeby']) && !empty($_POST['likeby'])) {
    $tweet_id = $_POST['likeby'];
    // $user       = UserDBConnector::getData($user_id);
    $users = PostDBConnector::usersLiked($tweet_id);
    $headline = "Liked by";

} else if (isset($_POST['follower']) && !empty($_POST['follower'])) {
    $u_id = $_POST['follower'];
    $users = array();
    $headline = "Followers";

} else if (isset($_POST['following']) && !empty($_POST['following'])) {
    $u_id = $_POST['following'];
    $users = array();
    $headline = "Following";

} else {
    $flag = false;
}
if (isset($profileData)) {
    $profile = $profileData->id;
}
if ($flag) {
?>
<div class="retweet-popup">
    <div class="wrap5">
        <div class="retweet-popup-body-wrap popup-users">
            <div class="retweet-popup-heading users">
                <h3> <?php echo $headline; ?> </h3>
                <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
            </div>

            <div class="box-share-users">
                <?php foreach ($users as $user) {
                    $u = UserDBConnector::getData($user->user_id);
                    $user_follow = false;
                    ?>
                    <div class="grid-share grid-users">
                        <a style="position: relative; z-index:999999; color:black"
                           href="<?php echo $u->username; ?>"
                           onclick="window.location = '<?php echo BASE_URL . $u->username; ?>' ">
                            <img
                                    src="resources/images/users/<?php echo $u->img; ?>"
                                    alt=""
                                    class="img-share"
                            />
                        </a>
                        <div>
                            <p>
                                <a onclick="window.location = '<?php echo BASE_URL . $u->username; ?>' "
                                   style="color:black" href="<?php echo $u->username; ?>">
                                    <strong><?php echo $u->name; ?></strong>
                                </a>
                            </p>
                            <p class="username">@<?php echo $u->username; ?>
                            </p>
                        </div>
                        <div>
                            <?php if ($u->id !== $user_id) { ?>
                                <button class="follow-btn follow-btn-m
                      <?= $user_follow ? 'following' : 'follow' ?>"
                                        data-follow="<?php echo $user->user_id; ?>"
                                        data-user="<?php echo $user_id; ?>"
                                        data-profile="<?php echo $u_id; ?>">
                                    <?php if ($user_follow) { ?>
                                        Following
                                    <?php } else { ?>
                                        Follow
                                    <?php } ?>
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                <?php } ?>

            </div>


        </div>
        <?php } ?>
        <!-- Retweet PopUp ends-->
