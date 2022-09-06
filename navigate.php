<?php
require_once './Admin/db-install.php';
require_once './Admin/db.php';
require_once './Admin/function.php';
db_cat();
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="navbar-brand logo brands" href="/">MyⓅarfumes</a>
        </div>
		
        <div class="col-lg-12 text-center">
          <noindex>  <p class="logo-paragraph">"Бесплатно проверьте свой парфюм и косметику по батч коду"</p>
        </div></noindex>
		
        <div class="col-lg-12 text-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-center w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php INDEX?>/brands">Бренды</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php INDEX?>/#faq">Вопросы</a>
					</li>
                </ul>
        </div>
        </div>
    </div>
</nav>
