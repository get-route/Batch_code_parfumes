<?php
require_once './Admin/db-install.php';
?>
            <div class="col-lg-12">
                <form class="index-form-post" action="../archive-search.php" method="get">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group form-search-post">
                                <input class="form-control serch-value" name="search-name" type="text" placeholder="Найти нужную тему..." required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-search-button">
                                <button type="submit" name="search" class="btn serch-value-button ">Найти</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

