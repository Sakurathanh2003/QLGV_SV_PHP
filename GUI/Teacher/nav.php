<style>
.content nav {
	height: 50px;
	background: white;
	padding: 0 24px;
	grid-gap: 24px;
	position: sticky;
	top: 0;
	left: 0;
    display: flex;
	align-items: center;
    justify-content: space-between;
}

.content nav .profile {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.content nav .profile p {
    padding-right: 10px;
    color: black;
}

.content nav .profile img {
	width: 36px;
	height: 36px;
	object-fit: cover;
	border-radius: 50%;
}  
</style>
<nav>
    <h1></h1>            
    <a href="" class="profile" style="text-decoration: none; display: flex; color: black; align-items: center;">
        <p style="padding-right: 10px;">
            <?php
                echo "Hi, ".$_SESSION["name"];
            ?>
        </p>
        <img src="../../resources/image/avt.jpg" alt="" style="size: 20px">
    </a>
</nav>