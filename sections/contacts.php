<div class="container">
<ul class="people">


    <?php for ($i=0; $i < 5 ; $i++) { ?>

        <li class="person">

            <div class="profile_picture">
                <div class="image_from_background" style="background-color: #f1f1f1;"></div>
            </div>
            <div class="profile_details">
                <h2>Person Name <?php echo $i; ?></h2>
                <p>Phone: 12345 <br />
                    Email: email@website.com</p>
                </div>

        </li>
        <?php };   ?>
    </ul>
</div>
