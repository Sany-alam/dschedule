<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li>
            <div class="text-center border-bottom">
                <div class="mx-auto my-3" style="width:80px;height:80px;background-image:url('assets/images/avatars/Deafult-Profile-Pitcher.png');background-size:cover;background-position:center;">
                    <img id="dr-image" alt="" src="<?php echo $_SESSION['doctor']['image'] ?>" class="" style="width:80px;height:80px;">
                </div>
                <div class="pull-left info">
                    <p id="dr-name"><?php echo $_SESSION['doctor']['name'] ?></p>
                    <p id="dr-email"><?php echo $_SESSION['doctor']['email'] ?></p>
                </div>
            </div>
            </li>
            <li class="nav-item">
                <a class="" href="index.php">
                    <span class="icon-holder">
                        <i class="anticon anticon-schedule"></i>
                    </span>
                    <span class="title">Appoinments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="profile.php">
                    <span class="icon-holder">
                        <i class="anticon anticon-profile"></i>
                    </span>
                    <span class="title">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="schedule.php">
                    <span class="icon-holder">
                        <i class="anticon anticon-profile"></i>
                    </span>
                    <span class="title">Schedule</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="logout.php">
                    <span class="icon-holder">
                        <i class="anticon anticon-logout"></i>
                    </span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>