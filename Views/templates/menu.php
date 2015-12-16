<div class="off-canvas position-left reveal-for-large" id="my-info" data-off-canvas data-position="left">
    <div class="row column">
        <br>
        <h3>Games</h3>
        <a href="<?php echo BASE_URL; ?>">
            <img class="thumbnail" src="<?php echo BASE_URL . "/img/peng01.gif" ?>">
        </a>

        <?php if (isset($_SESSION["User"]) && !empty($_SESSION["User"])) { ?>

            <div class="row column">
                <h5>Hello, {Username} !</h5>
                <a href="#" class="small">Se déconnecter</a>
            </div>
        <?php } else { ?>
            <div class="row column">
                <form>
                    <div class="row">
                        <div class="large-12 columns">
                            <input type="text" placeholder="Username"/>
                            <input type="text" placeholder="Password"/>
                            <a href="#" class="success button expanded">Connexion</a>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>