<div class="container">
		<?php $tdu = get_template_directory_uri(); ?>


    <ul class="people city">
        <li class="person">
            <div class="profile_picture">
                <div class="image_from_background" style="background-image: url('<?php echo $tdu; ?>/img/countries/switzerland.svg');"></div>
            </div>
            <div class="profile_details">
                <h2>Lausanne</h2>
                <p>        Place Pepinet 1, 1003 Lausanne - Switzerland <br />
                    TEL : +41 21 310 31 31. FAX : +41 21 310 31 00 <br />
                    <a href="mailto:reception@ifchor.ch">reception@ifchor.ch</a></p>
                </div>

            </li>

        </ul>





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
